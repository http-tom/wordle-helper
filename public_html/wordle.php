<?php
require '../vendor/autoload.php';

use HttpTom\WordleHelper\Template;
use HttpTom\WordleHelper\WordleSolver;

$wordle = new WordleSolver('../dict/words5', false);

$template = new Template();

if(php_sapi_name() == 'cli') {
    if($argc == 1) {
        echo $wordle->usage();
        return;
    }


    if(isset($argv[1]) && $argv[1] === 'random') {
        echo $wordle->suggest().PHP_EOL;
        return;
    }

    // set template if one set (string enclosed in square brackets)
    $skip_set_key = '';
    foreach($argv as $k => $v) {
        if($v[0] == '[' && $v[(strlen($v)-1)] == ']') {
            $v = substr($v, 1, -1);
            for($i = 0; $i < strlen($v); $i++) {
                if($v[$i] != ' ') {
                    $template->setCharacter($i+1, $v[$i]);
                }
            }
            $skip_set_key = $k;
        }
    }

    for($i = 1; $i < $argc; $i++) {
        if($i === $skip_set_key) {
            continue;
        }
        if($argv[$i][0] === '_') {
            // remove _ and remove any word with this in
            $argv[$i] = substr($argv[$i], 1);
            $wordle->exclude($argv[$i]);
            echo "Excluding:{$argv[$i]}".PHP_EOL;
        } else {
            $wordle->include($argv[$i]);
            echo "Including:{$argv[$i]}".PHP_EOL;
        }
    }

    $wordle->setTemplate($template);

    echo $wordle;
}
else {
    header('Content-Type: application/javascript');

    function safeStr($input) {
        $re = '/[^a-z]/mi';
        return substr(preg_replace($re, '', $input),0,4);
    }

    if((isset($_POST['include']) && array_filter($_POST['include']))
        || (isset($_POST['exclude']) && array_filter($_POST['exclude']))
        || (isset($_POST['template_1']) && !empty($_POST['template_1']))
        || (isset($_POST['template_2']) && !empty($_POST['template_2']))
        || (isset($_POST['template_3']) && !empty($_POST['template_3']))
        || (isset($_POST['template_4']) && !empty($_POST['template_4']))
        || (isset($_POST['template_5']) && !empty($_POST['template_5']))
        ) {
        foreach($_POST['include'] as $inc) {
            $wordle->include(safeStr($inc));
        }
        foreach($_POST['exclude'] as $exc) {
            $wordle->exclude(safeStr($exc));
        }


        $template->setCharacter(1, isset($_POST['template_1']) ? safeStr($_POST['template_1']) : '');
        $template->setCharacter(2, isset($_POST['template_2']) ? safeStr($_POST['template_2']) : '');
        $template->setCharacter(3, isset($_POST['template_3']) ? safeStr($_POST['template_3']) : '');
        $template->setCharacter(4, isset($_POST['template_4']) ? safeStr($_POST['template_4']) : '');
        $template->setCharacter(5, isset($_POST['template_5']) ? safeStr($_POST['template_5']) : '');

        $wordle->setTemplate($template);

        echo json_encode(['results'=>$wordle->results()]);
    } else {
        echo json_encode(['suggestion'=>$wordle->suggest()]);
    }
}
