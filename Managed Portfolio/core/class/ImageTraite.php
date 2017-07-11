<?php

/**
 * Created by CyberSoftCreation
 * User: antoi
 * Date: 29/03/2016
 * Time: 02:31
 */

require __DIR__ . "/imageInterventionInit.php";
use Intervention\Image\ImageManager;

class ImageTraite
{

    public static function resizeAndSave($width,$file,$dest,$height=null)
    {

        $manager = new ImageManager(array('driver' => 'Gd'));

        try {

            $manager->make($file)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($dest);
            return true;
        }
        catch (Exception $e)
        {
            var_dump($e);
            return false;
        }







    }



}