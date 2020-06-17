<?php 
// Create a 200 x 200 image
$canvas = imagecreatetruecolor(500, 500);


// Allocate a color for the polygon
$col_poly = imagecolorallocate($canvas, 255, 255, 255);


// Draw the polygon
imageline($canvas, 240, 100, 85, 410, $col_poly);

// Draw the polygon
imageline($canvas, 105, 440, 405, 440, $col_poly);

// Draw the polygon
imageline($canvas, 260, 100, 415, 415, $col_poly);



// Draw the polygon
imagepolygon($canvas, array(
    250, 50,
    215, 100,
    285, 100
),
3,
$col_poly);


// Draw the polygon
imagepolygon($canvas, array(
    50, 450,
    75, 400,
    110, 450
),
3,
$col_poly);

// Draw the polygon
imagepolygon($canvas, array(
    450, 450,
    425, 400,
    400, 450
),
3,
$col_poly);

// Output and free from memory
header('Content-Type: image/jpeg');

imagejpeg($canvas);
imagedestroy($canvas);
