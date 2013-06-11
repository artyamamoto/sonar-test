<?php

/**
 * Ab_Utils_Image class.
 */
class Ab_Utils_Image
{
    /**
     * Resize image.
     *
     * @access public
     * @param  string       $fileName
     * @param  int          $width
     * @param  int          $height
     * @return string
     */
    public static function resize($fileName, $width, $height)
    {
        $image = imagecreatefromstring(file_get_contents($fileName));

        $w = imagesx($image);
        $h = imagesy($image);

        if($width / $w > $height / $h) {
            $width = intval($height / $h * $w);
        } else {
            $height = intval($width / $w * $h);
        }

        // リサイズが不要な場合
        if($w == $width && $h == $height) {
            return;
        }

        $newImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $w, $h);

        $r = imagejpeg($newImage, $fileName, 80);
    }
}

