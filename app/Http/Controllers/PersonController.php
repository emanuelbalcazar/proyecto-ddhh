<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Services\PersonService;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Wrappers\PersonCaseWrapper;
use App\Http\Controllers\Wrappers\ContactDataWrapper;
use App\Http\Controllers\Wrappers\FamilyMemberWrapper;

class PersonController extends GenericController {

  protected $personService;

  /**
  * Constructor
  * @param PersonService Servicio de personas
  */
  public function __construct(PersonService $personService) {
    $this->personService = $personService;
  }

  /** Campos por los que se puede filtrar */
  public function getValidFilterableFields() {
    return [
      'id', 'personNames', 'personSurnames', 'townName',
      'gender', 'documentNumber', 'personBirthdateYear',
      'personBirthdateMonth', 'personBirthdateDay'
    ];
  }

  /** Servicio */
  public function getService() {
    return $this->personService;
  }

  /** Guardar una persona. */
  public function store(Request $request) {

    $messages = [
      'required' => 'El :attribute no puede estar vacio.',
      'date' => 'La :attribute no es una fecha valida.',
      'integer' => 'El :attribute no es un número valido.',
      'max' => 'El :attribute debe tener :max caracteres como maximo',
    ];

    $fieldsTranslate = [
      'status' => 'estado del caso',
      'type' => 'tipo de caso',
      'date' => 'fecha del caso',
      'contact_data.0.value' => 'valor del contacto',
      'contact_data.0.contact_data_type_id' => 'tipo de contacto',
    ];

    $validator = Validator::make($request->all(), [
      'type' => 'required|max:50',
      'status' => 'required|max:50',
      'date' => 'required|date',
      'contact_data.*.value' => 'required|max:250',
      'contact_data.*.contact_data_type_id' => 'required|integer',
    ], $messages);

    if ($validator->fails()) {

      $errors = $validator->errors();
      $errorsJson = array();

      foreach ($errors->messages() as $field => $fieldErrors) {
        $fieldsErrorsJson = array();
        foreach ($fieldErrors as $fieldError) {
          $fieldError =  str_replace($field, $fieldsTranslate[$field], $fieldError);
          $fieldsErrorsJson[] = $fieldError;
        }
        $errorsJson[$fieldsTranslate[$field]] = $fieldsErrorsJson;
      }

      return response()->json($errorsJson, 400);
    }

    try {
      //Adapto los datos JSON a los modelos de Eloquent
      $personCaseWrapper = new PersonCaseWrapper($request);
      $contactDataWrapper = new ContactDataWrapper($request);
      $familyMemberWrapper = new FamilyMemberWrapper($request);

      //Persisto la persona, los datos de contacto y los familiares
      $this->personService->create($personCaseWrapper->personCase(), $contactDataWrapper->contactData(), $familyMemberWrapper->familyMembers());

    } catch (Exception $e) {
      return response()->toJson([
        'message' => 'Hubo un error inesperado al intentar persistir la persona'
      ], 403);
    }

  }

  /** Busca personas similares, agregando el porcentaje de similitud */
  public function matching() {
    $filters = null;
    foreach ($this->getValidFilterableFields() as $field) {
      if (Input::has($field)) {
        $filters ['findBy'.ucfirst($field)] = Input::get($field);
      }
    }
    return $this->getService()->matching($filters);
  }

  public function getNamesById() {
    $id = Input::get('id');
    return $this->getService()->getNamesById($id);
  }

}
