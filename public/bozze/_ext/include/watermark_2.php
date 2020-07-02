<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$file = $_GET['f'];
//$file = "../../file/tb_slider/1/files/K840CM.jpg";
$tp = explode(".",$file);
$nr = count($tp) - 1;
$extension = $tp[$nr];

// Load the stamp and the photo to apply the watermark to
$stamp = imagecreatefrompng('../img/watermark.png');



if($extension=="png") {
	$im = imagecreatefrompng($file);
} elseif($extension=="gif") {
	$im = imagecreatefromgif($file);
} else {
	$im = imagecreatefromjpeg($file);
}

// Set the margins for the stamp and get the height/width of the stamp image
$marge_right = $_GET['r'];
//$marge_bottom = $_GET['b'];
$marge_bottom = 200;
//$marge_bottom = 1000;

if(isset($_GET['fb'])){
	$marge_bottom = $_GET['fb'];
}

$sx = imagesx($stamp);
$sy = imagesy($stamp);

// Copy the stamp image onto our photo using the margin offsets and the photo 
// width to calculate positioning of the stamp. 
imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

// Output and free memory
if($extension=="png") {
	header('Content-type: image/png');
	imagepng($im);
} elseif($extension=="gif") {
	header('Content-type: image/png');
	imagegif($im);
} else {
	header('Content-type: image/jpg');
	imagejpeg($im);
}

imagedestroy($im);
?>