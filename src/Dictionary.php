<?php
namespace HttpTom\WordleHelper;

use HttpTom\WordleCrack\Reducer;


class Dictionary {

    public $words = [];

    /**
     * Loads a word dictionary
     * @param string $filename
     * @param bool $reduce = true Whether to reduce the dictionary file to 5 letter words
     */
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

    /**
     * Writes the stored words to file
     * @param string $filename
     */
    public function writeToFile($filename) {
        return file_put_contents($filename, implode(PHP_EOL, $this->words));
    }
}