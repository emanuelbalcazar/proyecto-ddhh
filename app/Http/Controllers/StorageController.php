<?php

namespace App\Http\Controllers;

use Webpatser\Uuid\Uuid;
use App\Http\Controllers\Controller;

class StorageController extends Controller {

    protected $name_photo;

    public function __construct($photo_encoded) {

        if ($photo_encoded == null) {  // Si no viene datos, sale.
            return;
        }

        $this->name_photo = Uuid::generate().'.png'; // nombre Uuid + extension (siempre es .png)
        $path = public_path().'/img'; // Se almacenan en la carpeta "img" dentro de public.
        $base64_decoded = explode(',', $photo_encoded);
        $plainText = base64_decode($base64_decoded[1]);
        file_put_contents("$path/$this->name_photo", $plainText);
    }

    public function getNamePhoto() {
        return $this->name_photo;
    }

}
