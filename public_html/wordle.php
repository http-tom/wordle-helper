<?php
require '../vendor/autoload.php';

use HttpTom\WordleHelper\WordleHelper;

$wordle = new WordleHelper('../dict/words5', false);


if(php_sapi_name() == 'cli') {
    if($argc == 1) {
        echo $wordle->usage();
        return;
    }


    if(isset($argv[1]) && $argv[1] === 'random') {
        echo $wordle->suggest().PHP_EOL;
        return;
    }


    for($i = 1; $i < $argc; $i++) {
        if($argv[$i][0] === '_') {
            // remove _ and remove any word with this in
            $argv[$i] = substr($argv[$i], 1);
            $wordle->exclude($argv[$i]);
        } else {
            $wordle->include($argv[$i]);
        }
    }
    echo $wordle;
}
else {
    header('Content-Type: application/javascript');
    if((isset($_POST['include']) && array_filter($_POST['include'])) || (isset($_POST['exclude']) && array_filter($_POST['exclude']))) {
        foreach($_POST['include'] as $inc) {
            $wordle->include($inc);
        }
        foreach($_POST['exclude'] as $exc) {
            $wordle->exclude($exc);
        }
        echo json_encode(['results'=>$wordle->results()]);
    } else {
        echo json_encode(['suggestion'=>$wordle->suggest()]);
    }
}
