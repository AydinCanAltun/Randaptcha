# Randaptcha

## Usage

Copy and paste the code below to your html page

    <iframe  src="randaptcha/randaptcha.html"  width="400px"  height="300px"></iframe>
and that's it.

## Adding New Fonts to System
To add a new font to system there are 2 things that you need to do

 1. Download a font from Internet make sure it's otf font and paste the font to the "assets/fonts" folder
 2. Open settings.php and add the font file's name to the $fonts array.

## Changing the Question Types
Randaptcha supports 2 types of Question's Math Equations and Random Texts, if you want your captcha ask only Math Equations or Random Text Questions all you need to do is open settings.php and change the "RANDOM_TEXT_QUESTION" and "MATH_EQUATION_QUESTION" variables value to true or false.

## Math Equation Difficulty's
Math Equations has 3 different difficulties.
|  |  |
|--|--|
| 1  | (A . B) |
| 2 | A . (B . C)  |
| 3 | (A . B) . (C . D) |

## Verify
After user submitting the form you should check

    $_SESSION['randaptcha']['result'] == true



