<?php
// Set the content-type
header('Content-Type: image/png');

// Create the image
$im = imagecreatetruecolor(400, 100);

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);

// Fill the background with white
imagefilledrectangle($im, 0, 0, 399, 99, $white);

// The text to draw
$text = 'Hello, I am arial font style!';

// Replace path by your own font path
$font = 'fonts/arial.ttf'; // Replace with the path to your TTF font file

// Add the text
imagettftext($im, 20, 0, 10, 50, $black, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);

// Destroy the image resource to free up memory
imagedestroy($im);
?>
