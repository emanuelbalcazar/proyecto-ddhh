<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
*/

Route::get('/', function () {
    return view('index');
});

Route::get('additional_information/document_types', 'AdditionalInformationController@documentTypes');
Route::get('additional_information/contact_types', 'AdditionalInformationController@contactTypes');
Route::get('additional_information/contextures', 'AdditionalInformationController@contextures');
Route::get('additional_information/hair_colors', 'AdditionalInformationController@hairColors');
Route::get('additional_information/skin_colors', 'AdditionalInformationController@skinColors');
Route::get('additional_information/case_status', 'AdditionalInformationController@caseStatus');
Route::get('additional_information/case_types', 'AdditionalInformationController@caseTypes');
Route::get('additional_information/eye_colors', 'AdditionalInformationController@eyeColors');
Route::get('additional_information/provinces', 'AdditionalInformationController@provinces');
Route::get('additional_information/countries', 'AdditionalInformationController@countries');
Route::get('additional_information/surnames', 'AdditionalInformationController@surnames');
Route::get('additional_information/kinships', 'AdditionalInformationController@kinships');
Route::get('additional_information/genders', 'AdditionalInformationController@genders');
Route::get('additional_information/towns', 'AdditionalInformationController@towns');
Route::get('additional_information/names', 'AdditionalInformationController@names');

Route::get('persons/names_by_id', 'PersonController@getNamesById');
Route::get('persons/matching', 'PersonController@matching');
Route::post('persons/store', 'PersonController@store');
Route::post('alerts/accept', 'AlertController@accept');
Route::post('alerts/reject', 'AlertController@reject');

Route::resource('persons', 'PersonController');
Route::resource('alerts', 'AlertController');
