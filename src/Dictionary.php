<?php
namespace HttpTom\WordleHelper;

use HttpTom\WordleCrack\Reducer;

class Dictionary {

    public $words = [];

    public function __construct($filename, $reduce = true)
    {
        $f = file_get_contents($filename);
        $words = explode(PHP_EOL, $f);
        if($reduce) {
            $this->words = Reducer::filterByLength(5, $words);
        } else {
            $this->words = $words;
        }
    }

    public function writeToFile($filename) {
        return file_put_contents($filename, implode(PHP_EOL, $this->words));
    }
}