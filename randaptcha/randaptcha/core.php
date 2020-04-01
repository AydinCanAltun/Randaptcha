<?php 

session_start();
require_once 'settings.php';

if($_POST){

    $ajax = $_POST["query"];

    if($ajax['operation'] == "get_description"){
        echo isset($_SESSION['randaptcha']['description']) ? $_SESSION['randaptcha']['description'] : "";
    }else if($ajax['operation'] == "verify"){

        $userAnswer = isset($ajax['userAnswer']) ? $ajax['userAnswer'] : NULL;

        if($userAnswer != NULL){
            if($userAnswer == $_SESSION['randaptcha']['answer']){
                $_SESSION['randaptcha']['result'] = true;
                echo "ok";
            }
        }

    }



    exit();
}


$operations = [];
$opr_result;

$choosenFont = rand(0, count($fonts) - 1);
$angle = rand(0, 3);
$fontSize = rand(15, 17);
$textStart = rand(40, 50);
$_DESCRIPTION;
$_QUESTION;
$_ANSWER;

if($RANDOM_TEXT_QUESTION){
    $operations[] = 1;
}

if($MATH_EQUATION_QUESTION){
    $operations[] = 2;
}

if(count($operations) == 0){
    $opr_result = 1;
}else{
    $opr_result = $operations[rand(0, count($operations) - 1)];
}

switch($opr_result){
    case 1:
        $_DESCRIPTION = "Please type this characters.";
        $startAt = rand(0, 24);
        $_QUESTION = substr(md5(rand(0, 999999999)), $startAt, $starAt + 8);
        $_ANSWER = $_QUESTION;
    break;

    case 2:

        $_DESCRIPTION = "Please calculate the mathematic equation.";

        switch($MATH_EQUATION_DIFFICULTY){
            case 1;
                // A . B
                $a = rand(1, 10);
                $b = rand(1, 10);

                $opr = rand(0, 2); // 0 -> Addition, 1 -> Difference, 2 -> Multiple

                if($opr == 0){
                    $_QUESTION = $a . " + " . $b;
                    $_ANSWER = $a + $b;
                }else if($opr == 1){
                    $_QUESTION = "|". $a . " - " . $b . "|";
                    $_ANSWER = abs($a - $b);
                }else if($opr == 2){
                    $_QUESTION = $a . " X " . $b;
                    $_ANSWER = $a * $b;
                }

            break;

            case 2;
                // A . ( B . C)
                $a = rand(1, 10);
                $b = rand(1, 10);
                $c = rand(1, 10);

                $opr1 = rand(0, 1); // 0 -> Additon, 1 -> Multiple
                $opr2 = rand(0, 2); // 0 -> Addition, 1 -> Difference, 2 -> Multiple

                if($opr2 == 0){
                    $halfQuestText = "(" . $b . " + " . $c . ")";
                    $halfQuestAnswer = $b + $c;
                }else if($opr2 == 1){
                    $halfQuestText = "(|" . $b . " - " . $c . "|)";
                    $halfQuestAnswer = abs($b - $c);
                }else if($opr2 == 2){
                    $halfQuestText = "(" . $b . " X " . $c . ")";
                    $halfQuestAnswer = $b * $c; 
                }

                if($opr1 == 0){
                    $_QUESTION = $a . " + " . $halfQuestText;
                    $_ANSWER = $a + $halfQuestAnswer;
                }else if($opr1 == 1){
                    $_QUESTION = $a . " X " . $halfQuestText;
                    $_ANSWER = $a * $halfQuestAnswer;
                }

            break;

            case 3:
                // (A . B) . (C . D)
                $a = rand(1, 10);
                $b = rand(1, 10);
                $c = rand(1, 10);
                $d = rand(1, 10);

                $opr1 = rand(0, 2); // 0 -> Addition, 1 -> Difference, 2 -> Multiple
                $opr2 = rand(0, 1); // 0 -> Additon, 1 -> Multiple
                $opr3 = rand(0, 2); // 0 -> Addition, 1 -> Difference, 2 -> Multiple

                if($opr1 == 0){
                    $halfQuestText1 = "(" . $a . " + " . $b . ")";
                    $halfQuestAnswer1 = $a + $b; 
                }else if($opr1 == 1){
                    $halfQuestText1 = "(|" . $a . " - " . $b . "|)";
                    $halfQuestAnswer1 = abs($a - $b);
                }else if($opr1 == 2){
                    $halfQuestText1 = "(" . $a . " X " . $b . ")";
                    $halfQuestAnswer1 = $a * $b;
                }

                if($opr3 == 0){
                    $halfQuestText2 = "(" . $c . " + " . $d . ")";
                    $halfQuestAnswer2 = $c + $d;
                }else if($opr3 == 1){
                    $halfQuestText2 = "(|" . $c . " - " . $d . "|)";
                    $halfQuestAnswer2 = abs($c - $d);
                }else if($opr3 == 2){
                    $halfQuestText2 = "(" . $c . " X " . $d . ")";
                    $halfQuestAnswer2 = $c * $d;
                }

                if($opr2 == 0){
                    $_QUESTION = $halfQuestText1 . " + " . $halfQuestText2;
                    $_ANSWER = $halfQuestAnswer1 + $halfQuestAnswer2;
                }else if($opr2 == 1){
                    $_QUESTION = $halfQuestText1 . " X " . $halfQuestText2;
                    $_ANSWER = $halfQuestAnswer1 * $halfQuestAnswer2;
                }

            break;

        }

    
    break;
}




?>