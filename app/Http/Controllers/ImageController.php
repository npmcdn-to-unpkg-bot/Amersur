<?php namespace Amersur\Http\Controllers;

class ImageController extends Controller {

    public function adaptiveResize($folder, $width, $height, $image)
    {
        $file = public_path().'/upload/' . $folder . '/' .$image;
        $image = \Image::make($file);
        $image->fit($width, $height);
        return $image->response();
    }

}