<?php
require_once 'core.php';

$_SESSION['randaptcha'] = [
    'description' => $_DESCRIPTION,
    'question'    => $_QUESTION,
    'answer'      => $_ANSWER,
    'result'      => false
];



header("Content-type: image/png");

$font = 'assets/fonts/'. $fonts[$choosenFont] .'.otf';

$br = rand(0, 255);
$bg = rand(0, 255);
$bb = rand(0, 255);

$tr = rand(0, 255);
$tg = rand(0, 255);
$tb = rand(0, 255);

while( abs($br - $tr) <= 60 || abs($bg - $tg) <= 60 || abs($bb - $tb) <= 60 ){

    if(abs($br - $tr) <= 60){
        $tr = rand(0, 255);
    }

    if(abs($bg - $tg) <= 60){
        $tg = rand(0, 255);
    }

    if(abs($bb - $tb) <= 60){
        $tb = rand(0, 255);
    }
}

$captcha = imagecreate( 300, 80 );
$background = imagecolorallocate($captcha, $br, $bg, $bb);
$text_colour = imagecolorallocate($captcha, $tr, $tg, $tb);
imagettftext($captcha, $fontSize, $angle, $textStart, 40, $text_colour, $font, $_QUESTION);
//imagestring( $captcha, 30, 30, 40, "thesitewizard.com", $text_colour );

header( "Content-type: image/png" );
imagepng( $captcha);
imagecolordeallocate( $text_colour );
imagecolordeallocate( $background );
imagedestroy( $captcha );



?>