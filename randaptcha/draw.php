<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'core.php';

$_SESSION['randaptcha'] = [
    'description' => $_DESCRIPTION,
    'question'    => $_QUESTION,
    'answer'      => $_ANSWER,
    'result'      => false
];

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

$_SESSION['why'] = [
    "colors" => [
        "textColor" => [$tr, $tg, $tb],
        "backColor" => [$br, $bg, $bb]
    ],
    "textDate" => [
        "fontSize" => $fontSize,
        "angle" => $angle,
        "textStart" => $textStart,
        "font" => $fonts[$choosenFont],
        "question" => $_QUESTION
    ]
];

$captcha = imagecreate( 300, 80 );
$background = imagecolorallocate($captcha, $br, $bg, $bb);
$text_colour = imagecolorallocate($captcha, $tr, $tg, $tb);
imagettftext($captcha, $fontSize, $angle, $textStart, 40, $text_colour, $font, $_QUESTION);

header( "Content-type: image/png" );
imagepng( $captcha);
imagecolordeallocate($captcha, $text_colour );
imagecolordeallocate($captcha, $background );
imagedestroy( $captcha );



?>