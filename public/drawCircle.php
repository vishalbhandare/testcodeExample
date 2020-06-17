<?php
// Create a 200 x 200 image
$canvas = imagecreatetruecolor(400, 300);

$white = imagecolorallocate($canvas, 255, 255, 255);

$col_poly = imagecolorallocate($canvas, 255, 255, 255);

imagepolygon($canvas, array(
    150, 150,
    200, 200,
    250, 150,
    200, 100,
),
4,
$col_poly);

imageellipse($canvas, 200, 150, 150, 150, $white);


imagepolygon($canvas, array(
    150, 65,
    250, 65,
    300, 150,
    250, 235,
    150, 235,
    100, 150,
),
6,
$col_poly);

// Output and free from memory
header('Content-Type: image/jpeg');

imagejpeg($canvas);
imagedestroy($canvas);
?>