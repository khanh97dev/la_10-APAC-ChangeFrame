<?php

use Intervention\Image\ImageManagerStatic as Image;

function isColumnEmpty($image, $columnIndex)
{
    for ($y = 0; $y < $image->height(); $y++) {
        $pixelColor = $image->pickColor($columnIndex, $y, 'array');
        if ($pixelColor[0] !== 255 || $pixelColor[1] !== 255 || $pixelColor[2] !== 255) {
            return false;
        }
    }
    return true;
}

function isRowEmpty($image, $rowIndex)
{
    for ($x = 0; $x < $image->width(); $x++) {
        $pixelColor = $image->pickColor($x, $rowIndex, 'array');
        if ($pixelColor[0] !== 255 || $pixelColor[1] !== 255 || $pixelColor[2] !== 255) {
            return false;
        }
    }
    return true;
}

// Load the two images you want to merge
$image = Image::make(storage_path('app/public/images/products/s-l300 (11)_rm.jpg'));

// Get the dimensions of the image
$width = $image->width();
$height = $image->height();

// Calculate the coordinates for cropping
$left = 0; // left coordinate of the cropping area
$top = 0; // top coordinate of the cropping area
$right = $width; // right coordinate of the cropping area
$bottom = $height; // bottom coordinate of the cropping area

// Perform the cropping operation
$image->crop($right - $left, $bottom - $top, $left, $top);

// Save the cropped image
// $image->save('path/to/cropped_image.jpg');
$image->save(public_path('images/cropped.jpg'));
