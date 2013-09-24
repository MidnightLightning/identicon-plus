<?php
$colors = array(
	array(0, 100, 90),
	array(45, 100, 90),
	array(60, 100, 90),
	array(135, 100, 90),
	array(180, 100, 90),
	array(210, 100, 90),
	array(275, 100, 90),
	array(300, 100, 90),

	array(0, 100, 50),
	array(45, 100, 50),
	array(60, 100, 50),
	array(135, 100, 50),
	array(180, 100, 50),
	array(210, 100, 50),
	array(275, 100, 50),
	array(300, 100, 50),

	array(0, 100, 25),
	array(45, 100, 25),
	array(60, 100, 25),
	array(135, 100, 25),
	array(180, 100, 25),
	array(210, 100, 25),
	array(275, 100, 25),
	array(300, 100, 25),
);
			
function hslToRgb( $h, $s, $l ){
    $r = 0;
	$g = 0;
	$b = 0;
	
	$s = $s/100;
	$l = $l/100;

	$c = ( 1 - abs( 2 * $l - 1 ) ) * $s;
	$x = $c * ( 1 - abs( fmod( ( $h / 60 ), 2 ) - 1 ) );
	$m = $l - ( $c / 2 );

	if ( $h < 60 ) {
		$r = $c;
		$g = $x;
		$b = 0;
	} else if ( $h < 120 ) {
		$r = $x;
		$g = $c;
		$b = 0;			
	} else if ( $h < 180 ) {
		$r = 0;
		$g = $c;
		$b = $x;					
	} else if ( $h < 240 ) {
		$r = 0;
		$g = $x;
		$b = $c;
	} else if ( $h < 300 ) {
		$r = $x;
		$g = 0;
		$b = $c;
	} else {
		$r = $c;
		$g = 0;
		$b = $x;
	}

	$r = ( $r + $m ) * 255;
	$g = ( $g + $m ) * 255;
	$b = ( $b + $m  ) * 255;

    return array( floor( $r ), floor( $g ), floor( $b ) );
}

/* generate sprite for corners and sides */
function getsprite($shape,$foreground,$background,$rotation) {
	global $spriteZ, $colors;
	$sprite=imagecreatetruecolor($spriteZ,$spriteZ);
	imageantialias($sprite,TRUE);
	$fg = $colors[$foreground+8];
	if ($foreground+8 == $background) $fg[2] = 0;
	$fg = hslToRgb($fg[0], $fg[1], $fg[2]);
	$fg = imagecolorallocate($sprite,$fg[0],$fg[1],$fg[2]);
	if ($background == -1) {
		$bg = imagecolorallocate($sprite, 255,255,255);
	} else {
		$bg = $colors[$background];
		$bg = hslToRgb($bg[0], $bg[1], $bg[2]);
		$bg = imagecolorallocate($sprite,$bg[0],$bg[1],$bg[2]);
	}
	imagefilledrectangle($sprite,0,0,$spriteZ,$spriteZ,$bg);
	switch($shape) {
		case 0: // triangle
			$shape=array(
				0.5,1,
				1,0,
				1,1
			);
			break;
		case 1: // reverse V
			$shape=array(
				0,0,
				0.5,1,
				1,0,
				1,1,
				0,1
			);
			break;
		case 2: // mouse ears
			$shape=array(
				0.5,0,
				1,0,
				1,1,
				0.5,1,
				1,0.5
			);
			break;
		case 3: // ribbon
			$shape=array(
				0,0.5,
				0.5,0,
				1,0.5,
				0.5,1,
				0.5,0.5
			);
			break;
		case 4: // sails
			$shape=array(
				0,0.5,
				1,0,
				1,1,
				0,1,
				1,0.5
			);
			break;
		case 5: // fins
			$shape=array(
				1,0,
				1,1,
				0.5,1,
				1,0.5,
				0.5,0.5
			);
			break;
		case 6: // beak
			$shape=array(
				0,0,
				1,0,
				1,0.5,
				0,0,
				0.5,1,
				0,1
			);
			break;
		case 7: // chevron
			$shape=array(
				0,0,
				0.5,0,
				1,0.5,
				0.5,1,
				0,1,
				0.5,0.5
			);
			break;
		case 8: // fish
			$shape=array(
				0.5,0,
				0.5,0.5,
				1,0.5,
				1,1,
				0.5,1,
				0.5,0.5,
				0,0.5
			);
			break;
		case 9: // kite
			$shape=array(
				0,0,
				1,0,
				0.5,0.5,
				1,0.5,
				0.5,1,
				0.5,0.5,
				0,1
			);
			break;
		case 10: // trough
			$shape=array(
				0,0.5,
				0.5,1,
				1,0.5,
				0.5,0,
				1,0,
				1,1,
				0,1
			);
			break;
		case 11: // rays
			$shape=array(
				0.5,0,
				1,0,
				1,1,
				0.5,1,
				1,0.75,
				0.5,0.5,
				1,0.25
			);
			break;
		case 12: // double rhombus
			$shape=array(
				0,0.5,
				0.5,0,
				0.5,0.5,
				1,0,
				1,0.5,
				0.5,1,
				0.5,0.5,
				0,1
			);
			break;
		case 13: // crown
			$shape=array(
				0,0,
				1,0,
				1,1,
				0,1,
				1,0.5,
				0.5,0.25,
				0.5,0.75,
				0,0.5,
				0.5,0.25
			);
			break;
		case 14: // radioactive
			$shape=array(
				0,0.5,
				0.5,0.5,
				0.5,0,
				1,0,
				0.5,0.5,
				1,0.5,
				0.5,1,
				0.5,0.5,
				0,1
			);
			break;
		default: // tiles
			$shape=array(
				0,0,
				1,0,
				0.5,0.5,
				0.5,0,
				0,0.5,
				1,0.5,
				0.5,1,
				0.5,0.5,
				0,1
			);
			break;
	}
	/* apply ratios */
	for ($i=0;$i<count($shape);$i++)
		$shape[$i]=$shape[$i]*$spriteZ;
	imagefilledpolygon($sprite,$shape,count($shape)/2,$fg);
	/* rotate the sprite */
	for ($i=0;$i<$rotation;$i++)
		$sprite=imagerotate($sprite,90,$bg);
	return $sprite;
}

/* generate sprite for center block */
function getcenter($shape,$foreground, $background) {
	global $spriteZ, $colors;
	$sprite=imagecreatetruecolor($spriteZ,$spriteZ);
	imageantialias($sprite,TRUE);
	$fg = $colors[$foreground+8];
	if ($foreground+8 == $background) $fg[2] = 0;
	$fg = hslToRgb($fg[0], $fg[1], $fg[2]);
	$fg = imagecolorallocate($sprite,$fg[0],$fg[1],$fg[2]);
	if ($background == -1) {
		$bg = imagecolorallocate($sprite, 255,255,255);
	} else {
		$bg = $colors[$background];
		$bg = hslToRgb($bg[0], $bg[1], $bg[2]);
		$bg = imagecolorallocate($sprite,$bg[0],$bg[1],$bg[2]);
	}
	imagefilledrectangle($sprite,0,0,$spriteZ,$spriteZ,$bg);
	switch($shape) {
		case 0: // thin X
			$shape=array(
				0.1,0,
				0.5,0.4,
				0.9,0,
				1,0,
				1,0.1,
				0.6,0.5,
				1,0.9,
				1,1,
				0.9,1,
				0.5,0.6,
				0.1,1,
				0,1,
				0,0.9,
				0.4,0.5,
				0,0.1,
				0,0
			);
			break;
		case 1: // large box
			$shape=array(
				0.2,0.2,
				0.8,0.2,
				0.8,0.8,
				0.2,0.8
			);
			break;
		case 2: // diamond
			$shape=array(
				0.5,0,
				1,0.5,
				0.5,1,
				0,0.5
			);
			break;
		case 3: // reverse diamond
			$shape=array(
				0,0,
				1,0,
				1,1,
				0,1,
				0,0.5,
				0.5,1,
				1,0.5,
				0.5,0,
				0,0.5
			);
			break;
		case 4: // cross
			$shape=array(
				0.25,0,
				0.75,0,
				0.5,0.5,
				1,0.25,
				1,0.75,
				0.5,0.5,
				0.75,1,
				0.25,1,
				0.5,0.5,
				0,0.75,
				0,0.25,
				0.5,0.5
			);
			break;
		case 5: // morning star
			$shape=array(
				0,0,
				0.5,0.25,
				1,0,
				0.75,0.5,
				1,1,
				0.5,0.75,
				0,1,
				0.25,0.5
			);
			break;
		case 6: // small square
			$shape=array(
				0.33,0.33,
				0.67,0.33,
				0.67,0.67,
				0.33,0.67
			);
			break;
		case 7: // checkerboard
			$shape=array(
				0,0,
				0.33,0,
				0.33,0.33,
				0.67,0.33,
				0.67,0,
				1,0,
				1,0.33,
				0.67,0.33,
				0.67,0.67,
				1,0.67,
				1,1,
				0.67,1,
				0.67,0.67,
				0.33,0.67,
				0.33,1,
				0,1,
				0,0.67,
				0.33,0.67,
				0.33,0.33,
				0,0.33
			);
			break;
		case 8: // Thick X
			$shape = array(
				.3,0,
				0.5,0.2,
				.7,0,
				1,0,
				1,0.3,
				0.8,0.5,
				1,0.7,
				1,1,
				0.7,1,
				0.5,0.8,
				0.3,1,
				0,1,
				0,0.7,
				0.2,0.5,
				0,0.3,
				0,0,
			);
			break;
		case 9: // band
			$shape = array(
				0,0.25,
				1,0.25,
				1,0.75,
				0,0.75,
			);
			break;
		case 10: // small diamond
			$shape = array(
				0.5,0.3,
				0.7,0.5,
				0.5,0.7,
				0.3,0.5,
			);
			break;
		case 11: // morning star on point
			$shape = array(
				0.5,0,
				0.65,0.35,
				1,0.5,
				0.65,0.65,
				0.5,1,
				0.35,0.65,
				0,0.5,
				0.35,0.35,
			);
			break;
		case 12: // triangle
			$shape = array(
				0.5,0,
				1,1,
				0,1,
			);
			break;
		default:
			$shape=array();

	}
	/* apply ratios */
	for ($i=0;$i<count($shape);$i++)
		$shape[$i]=$shape[$i]*$spriteZ;
	if (count($shape)>0)
		imagefilledpolygon($sprite,$shape,count($shape)/2,$fg);
	return $sprite;
}


if (isset($_GET['preview'])) {
	// Show a preview image instead
	$spriteZ=128;
	$preview=imagecreatetruecolor($spriteZ*16,$spriteZ*4);
	imageantialias($preview,TRUE);
	
	$bg = imagecolorallocate($preview, 255,255,255);
	imagefilledrectangle($preview, 0, 0, $spriteZ*16, $spriteZ*4, $bg);
	
	for($i=0; $i<16; $i++) {
		$corner=getsprite($i,$i,-1,0);
		imagecopy($preview,$corner,$spriteZ*$i,$spriteZ,0,0,$spriteZ,$spriteZ);
		
		$center=getcenter($i,$i,-1);
		imagecopy($preview,$center,$spriteZ*$i,$spriteZ*2,0,0,$spriteZ,$spriteZ);
	}
	
	// Resize, to anti-alias
	$outZ = 50;
	$resized=imagecreatetruecolor($outZ*16,$outZ*4);
	imageantialias($resized,TRUE);

	$bg=imagecolorallocate($resized,255,255,255);
	imagefilledrectangle($resized,0,0,$outZ*16,$outZ*4,$bg);

	imagecopyresampled($resized,$preview,0,0,0,0,$outZ*16,$outZ*4,$spriteZ*16,$spriteZ*4);

	imgout($resized);
}

/* parse hash string */

// 4x4 image, divided into 2x2 regions

// 1 2
// 3 4

// Regions 1 and 4 match shapes and shape colors, and regions 2 and 3 match similarly,
// just all rotated around the central point.
// Each region has its own background color, though.

$h = $_GET['hash']; // The hash to parse

$r1csh = hexdec(substr($h,1,1)); // Region 1/4 corner sprite shape
$r1ssh = hexdec(substr($h,2,1)); // Region 1/4 side sprite shape
$r1xsh = hexdec(substr($h,3,1))&7; // Region 1/4 center sprite shape

$r1cco = hexdec(substr($h,4,1)); // Region 1/4 corner sprite color
$r1sco = hexdec(substr($h,5,1)); // Region 1/4 side sprite color
$r1xco = hexdec(substr($h,6,1)); // Region 1/4 center sprite color

$r2csh = hexdec(substr($h,7,1)); // Region 2/3 corner sprite shape
$r2ssh = hexdec(substr($h,8,1)); // Region 2/3 side sprite shape
$r2xsh = hexdec(substr($h,9,1))&7; // Region 2/3 center sprite shape

$r2cco = hexdec(substr($h,10,1)); // Region 2/3 corner sprite color
$r2sco = hexdec(substr($h,11,1)); // Region 2/3 side sprite color
$r2xco = hexdec(substr($h,12,1)); // Region 2/3 center sprite color

$r1cro = hexdec(substr($h,13,1)) & 3; // Region 1/4 corner sprite rotation
$r1sro = (hexdec(substr($h,13,1)) >> 2) & 3; // Region 1/4 side sprite rotation
$r2cro = (hexdec(substr($h,13,1)) >> 4) & 3; // Region 2/3 corner sprite rotation
$r2sro = (hexdec(substr($h,13,1)) >> 6) & 3; // Region 2/3 side sprite rotation

if (isset($_GET['bg'])) {
	$r1bg = hexdec(substr($h,14,1)); // Region 1 background color
	$r2bg = hexdec(substr($h,15,1)); // Region 2 background color
	$r3bg = hexdec(substr($h,16,1)); // Region 3 background color
	$r4bg = hexdec(substr($h,17,1)); // Region 4 background color
} else {
	$r1bg = -1;
	$r2bg = -1;
	$r3bg = -1;
	$r4bg = -1;
}

/* size of each sprite */
$spriteZ=128;

/* start with blank 4x4 identicon */
$identicon=imagecreatetruecolor($spriteZ*4,$spriteZ*4);
imageantialias($identicon,TRUE);

/* assign white as background */
$bg=imagecolorallocate($identicon,255,255,255);
imagefilledrectangle($identicon,0,0,$spriteZ,$spriteZ,$bg);

// Region 1
// generate corner sprite
$corner=getsprite($r1csh,$r1cco,$r1bg,$r1cro);
imagecopy($identicon,$corner,0,0,0,0,$spriteZ,$spriteZ);

// generate side sprites
$side=getsprite($r1ssh,$r1sco,$r1bg,$r1sro);
imagecopy($identicon,$side,$spriteZ,0,0,0,$spriteZ,$spriteZ);
$side=imagerotate($side,90,$bg);
imagecopy($identicon,$side,0,$spriteZ,0,0,$spriteZ,$spriteZ);

// generate center sprite
$center=getcenter($r1xsh,$r1xco,$r1bg);
imagecopy($identicon,$center,$spriteZ,$spriteZ,0,0,$spriteZ,$spriteZ);


// Region 2
// generate corner sprite
$corner=getsprite($r2csh,$r2cco,$r2bg,$r2cro);
$corner = imagerotate($corner,-90,$bg);
imagecopy($identicon,$corner,$spriteZ*3,0,0,0,$spriteZ,$spriteZ);

// generate side sprites
$side=getsprite($r2ssh,$r2sco,$r2bg,$r2sro);
imagecopy($identicon,$side,$spriteZ*2,0,0,0,$spriteZ,$spriteZ);
$side=imagerotate($side,-90,$bg);
imagecopy($identicon,$side,$spriteZ*3,$spriteZ,0,0,$spriteZ,$spriteZ);

// generate center sprite
$center=getcenter($r2xsh,$r2xco,$r2bg);
imagecopy($identicon,$center,$spriteZ*2,$spriteZ,0,0,$spriteZ,$spriteZ);


// Region 3
// generate corner sprite
$corner=getsprite($r2csh,$r2cco,$r3bg,$r2cro);
$corner = imagerotate($corner,90,$bg);
imagecopy($identicon,$corner,0,$spriteZ*3,0,0,$spriteZ,$spriteZ);

// generate side sprites
$side=getsprite($r2ssh,$r2sco,$r3bg,$r2sro);
$side=imagerotate($side,90,$bg);
imagecopy($identicon,$side,0,$spriteZ*2,0,0,$spriteZ,$spriteZ);
$side=imagerotate($side,90,$bg);
imagecopy($identicon,$side,$spriteZ,$spriteZ*3,0,0,$spriteZ,$spriteZ);

// generate center sprite
$center=getcenter($r2xsh,$r2xco,$r3bg);
imagecopy($identicon,$center,$spriteZ,$spriteZ*2,0,0,$spriteZ,$spriteZ);


// Region 4
// generate corner sprite
$corner=getsprite($r1csh,$r1cco,$r4bg,$r1cro);
$corner = imagerotate($corner,180,$bg);
imagecopy($identicon,$corner,$spriteZ*3,$spriteZ*3,0,0,$spriteZ,$spriteZ);

// generate side sprites
$side=getsprite($r1ssh,$r1sco,$r4bg,$r1sro);
$side=imagerotate($side,180,$bg);
imagecopy($identicon,$side,$spriteZ*2,$spriteZ*3,0,0,$spriteZ,$spriteZ);
$side=imagerotate($side,90,$bg);
imagecopy($identicon,$side,$spriteZ*3,$spriteZ*2,0,0,$spriteZ,$spriteZ);

// generate center sprite
$center=getcenter($r1xsh,$r1xco,$r4bg);
imagecopy($identicon,$center,$spriteZ*2,$spriteZ*2,0,0,$spriteZ,$spriteZ);


// $identicon=imagerotate($identicon,$angle,$bg);

/* create blank image according to specified dimensions */
$size = (isset($_GET['size']))? $_GET['size'] : 200;
$resized=imagecreatetruecolor($size,$size);
imageantialias($resized,TRUE);

/* assign white as background */
$bg=imagecolorallocate($resized,255,255,255);
imagefilledrectangle($resized,0,0,$size,$size,$bg);

/* resize identicon according to specification */
imagecopyresampled($resized,$identicon,0,0,(imagesx($identicon)-$spriteZ*4)/2,(imagesx($identicon)-$spriteZ*4)/2,$size,$size,$spriteZ*4,$spriteZ*4);

/* make white transparent */
//imagecolortransparent($resized,$bg);

/* and finally, send to standard output */
imgout($resized);


function imgout($im) {
	if (!isset($_GET['debug'])) {
		header("Content-Type: image/png");
		imagepng($im);
	}
	exit;
}

function debug($msg) {
	if (isset($_GET['debug'])) echo $msg."<br />\n";
}