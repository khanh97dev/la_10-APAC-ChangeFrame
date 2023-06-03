<?php

use Intervention\Image\ImageManagerStatic as Image;
// Load the two images you want to merge
$image1 = Image::make(storage_path('app/public/images/frames/ip_supply.png'));
$image2 = Image::make(storage_path('app/public/images/products/s-l300 (28)_copy.jpg'));

$marginWidth = 15;
$marginHeight = 100;
$x = 0;
$y = $marginHeight - 90;

// Get the dimensions of the second image
$image2Width = $image2->getWidth();
$image2Height = $image2->getHeight();
$image1->resize($image2Width + $marginWidth, $image2Height + $marginHeight);


// Get the dimensions of the first image
$image1Width = $image1->getWidth();
$image1Height = $image1->getHeight();



// Merge the images by placing the second image in the middle of the first image
$image1->insert($image2, 'center', (int) $x, (int) $y);

// Save the merged image
$mergedImagePath = storage_path('app/public/images/excutes/merged_image.jpg');
$image1->save($mergedImagePath);
