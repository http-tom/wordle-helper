<?php
require '../vendor/autoload.php';

use HttpTom\WordleHelper\Template;
use HttpTom\WordleHelper\WordleSolver;

$wordle = new WordleSolver('../dict/words5', false);

$template = new Template();
$template->setCharacter(1, '');
$template->setCharacter(2, '');
$template->setCharacter(3, 'E');
$template->setCharacter(4, '');
$template->setCharacter(5, 'T');

$wordle->setTemplate($template);

$wordle->exclude('R');
$wordle->exclude('P');
$wordle->exclude('A');
$wordle->exclude('L');
$wordle->exclude('C');
$wordle->include('S');

$results = $wordle->results();

var_dump($results);