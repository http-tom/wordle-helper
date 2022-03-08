<?php
namespace HttpTom\WordleHelper;

use HttpTom\WordleHelper\Dictionary;


class WordleHelper {

    protected $dictionary = null;

    /**
     * Creates a new WordleHelper object
     * @param string $word_source Path to the dictionary word source file
     * @param bool $reduce = true Whether to reduce the dictionary file to 5 letter words or not (useful if the dictionary is not already filtered)
     */
    public function __construct($word_source, $reduce = true)
    {   
        $this->dictionary = new Dictionary($word_source, $reduce);

        // if using an unfiltered dictionary, uncomment to save a filtered version
        // $this->dictionary->writeToFile(dirname($word_source).'/words5');
    }

    /**
     * Returns a string specifying usage instructions
     */
    public function usage() {
        return "Usage: php wordle.php a e i _o _u \"[i a e]\"    where _prefixed letters will exclude words with those characters. A parameter inside square brackets will match the position of those characters in the word. Use keyword random to provide a word suggestion.".PHP_EOL;
    }

    /**
     * Returns a string random word suggestion
     */
    public function suggest() {
        return $this->dictionary->words[rand(0, count($this->dictionary->words)-1)];
    }

    /**
     * Excludes words with the specified character or string
     */
    public function exclude(string $letter) {
        if (!empty(trim($letter))) {
            foreach ($this->dictionary->words as $k => $word) {
                if (stristr($word, $letter) !== false) {
                    unset($this->dictionary->words[$k]);
                }
            }
        }
    }

    /**
     * Includes words that have the specified character or string
     */
    public function include(string $letter) {
        if (!empty(trim($letter))) {
            foreach ($this->dictionary->words as $k => $word) {
                if (stristr($word, $letter) === false) {
                    unset($this->dictionary->words[$k]);
                }
            }
        }
    }

    /**
     * Returns all words after exclusion/inclusion removals
     */
    public function results() {
        return $this->dictionary->words;
    }

    /**
     * Returns a string of all results
     * @see $this->results()
     */
    public function __toString()
    {
        $str = '';
        $results = $this->results();
        foreach($results as $word) {
            $str .= "{$word}\n";
        }
        return $str;
    }
}