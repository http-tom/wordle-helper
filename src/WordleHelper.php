<?php
namespace HttpTom\WordleHelper;

use HttpTom\WordleHelper\Dictionary;

class WordleHelper {

    private $dictionary = null;

    public function __construct($word_source, $reduce = true)
    {   
        $this->dictionary = new Dictionary($word_source, $reduce);
        // $this->dictionary->writeToFile(dirname($word_source).'/words5');
    }

    public function usage() {
        return "Usage: php wordle.php a e i _o _u    where _prefixed letters will exclude words with those characters. Use keyword random to provide a word suggestion.".PHP_EOL;
    }

    public function suggest() {
        return $this->dictionary->words[rand(0, count($this->dictionary->words)-1)];
    }

    public function exclude($letter) {
        if (!empty(trim($letter))) {
            foreach ($this->dictionary->words as $k => $word) {
                if (stristr($word, $letter) !== false) {
                    unset($this->dictionary->words[$k]);
                }
            }
        }
    }

    public function include($letter) {
        if (!empty(trim($letter))) {
            foreach ($this->dictionary->words as $k => $word) {
                if (stristr($word, $letter) === false) {
                    unset($this->dictionary->words[$k]);
                }
            }
        }
    }

    public function results() {
        return $this->dictionary->words;
    }

    public function __toString()
    {
        $str = '';
        foreach($this->dictionary->words as $word) {
            $str .= "{$word}\n";
        }
        return $str;
    }
}