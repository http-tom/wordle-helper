<?php
namespace HttpTom\WordleCrack;

class Reducer {

    /**
     * Returns array of all words that are $length long
     * @param int $length
     * @param array $dictionary
     * @return array
     */
    public static function filterByLength($length, $dictionary) {
        $words = [];
        foreach($dictionary as $word) {
            if(strlen($word) == $length) {
                if(strstr($word, "'") == false) {
                    $words[] = $word;
                }
            }
        }
        return $words;
    }
}