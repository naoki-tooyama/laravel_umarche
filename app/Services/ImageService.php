<?php

namespace App\services;
// Use InterventionImage;
Use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


Class ImageService
{
  public static function  upload($imageFile, $folderName){

    $fileName = uniqid(rand().'_');
    $extension = $imageFile->extension();
    $fileNameToStore = $fileName.'.'.$extension;

    //画像のリサイズ
    $manager = new ImageManager(new Driver());
    $resizedImage = $manager->read($imageFile);
    $resizedImage = $resizedImage->resize(1920,1080)->encode();

    Storage::put('public/'.$folderName. '/'.$fileNameToStore, $resizedImage);
    return $fileNameToStore;
  }
}
