<?php

// Create instance of the original image
$image = new Imagick();
$image->readImage("ttt.jpg");

// Create instance of the Watermark image
$watermark = new Imagick();
$watermark->readImage("mylenmu.png");

// The start coordinates where the file should be printed
$x = 80;
$y = 150;

// Draw watermark on the image file with the given coordinates
$image->compositeImage($watermark, Imagick::COMPOSITE_OVER, $x, $y);

// Save image
$image->writeImage("image_watermark." . $image->getImageFormat()); 

//echo $image;

/*
// Open the image to draw a watermark
$image = new Imagick();
$image->readImage("ttt.jpg");

// Open the watermark image
// Important: the image should be obviously transparent with .png format
$watermark = new Imagick();
$watermark->readImage("logo-admin.png");

// The resize factor can depend on the size of your watermark, so heads up with dynamic size watermarks !
$watermarkResizeFactor = 6;

// Retrieve size of the Images to verify how to print the watermark on the image
$img_Width = $image->getImageWidth();
$img_Height = $image->getImageHeight();
$watermark_Width = $watermark->getImageWidth();
$watermark_Height = $watermark->getImageHeight();

// Resize the watermark with the resize factor value
$watermark->scaleImage($watermark_Width / $watermarkResizeFactor, $watermark_Height / $watermarkResizeFactor);

// Update watermark dimensions
$watermark_Width = $watermark->getImageWidth();
$watermark_Height = $watermark->getImageHeight();

// Draw on the bottom right corner of the original image
$x = ($img_Width - $watermark_Width);
$y = ($img_Height - $watermark_Height);

// Draw the watermark on your image
$image->compositeImage($watermark, Imagick::COMPOSITE_OVER, $x, $y);

// From now on depends on you what you want to do with the image
// for example save it in some directory etc.
// In this example we'll Send the img data to the browser as response
// with Plain PHP
header("Content-Type: image/" . $image->getImageFormat());
echo $image;
*/

/*
// Open the image to draw a watermark
$image = new Imagick();
$image->readImage("ttt.jpg");

// Open the watermark image
// Important: the image should be obviously transparent with .png format
$watermark = new Imagick();
$watermark->readImage("watermark.png");

// Retrieve size of the Images to verify how to print the watermark on the image
$img_Width = $image->getImageWidth();
$img_Height = $image->getImageHeight();
$watermark_Width = $watermark->getImageWidth();
$watermark_Height = $watermark->getImageHeight();

// Check if the dimensions of the image are less than the dimensions of the watermark
// In case it is, then proceed to 
if ($img_Height < $watermark_Height || $img_Width < $watermark_Width) {
    // Resize the watermark to be of the same size of the image
    $watermark->scaleImage($img_Width, $img_Height);

    // Update size of the watermark
    $watermark_Width = $watermark->getImageWidth();
    $watermark_Height = $watermark->getImageHeight();
}

// Calculate the position
$x = ($img_Width - $watermark_Width) / 2;
$y = ($img_Height - $watermark_Height) ;

// Draw the watermark on your image
$image->compositeImage($watermark, Imagick::COMPOSITE_OVER, $x, $y);


// From now on depends on you what you want to do with the image
// for example save it in some directory etc.
// In this example we'll Send the img data to the browser as response
// with Plain PHP
header("Content-Type: image/" . $image->getImageFormat());
echo $image;
*/
?>