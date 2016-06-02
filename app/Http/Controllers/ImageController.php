<?php namespace Amersur\Http\Controllers;

class ImageController extends Controller {

    public function adaptiveResize($folder, $width, $height, $image)
    {
        $file = public_path().'/upload/' . $folder . '/' .$image;
        $image = \Image::make($file);
        $image->fit($width, $height);
        return $image->response();
    }


    public function withResize($folder, $width, $image)
    {
        $file = public_path().'/upload/' . $folder . '/' .$image;
        $image = \Image::make($file);
        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        return $image->response();
    }

}