<?php

namespace App;

class PictureManager
{
    public function resizeFile($file) : bool|\GdImage
    {
        header('Content-type: image/jpeg');
        $longerMaxSize = 150;
        list($width, $height) = getimagesize($file);
        $longerMeasure = $width;
        if ($width < $height) {
            $longerMeasure = $height;
        }
        $percent = $longerMaxSize / $longerMeasure;
        if ($longerMeasure === $width) {
            $new_width = $longerMaxSize;
            $new_height = $height * $percent;
        } else {
            $new_width = $width * $percent;
            $new_height = $longerMaxSize;
        }

        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($file);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        return $image_p;
    }
}