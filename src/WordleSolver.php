<?php
namespace HttpTom\WordleHelper;


use HttpTom\WordleHelper\Template;


class WordleSolver extends WordleHelper {

    private $template = null;

    public function setTemplate(Template $template) {
        $this->template = $template;
    }

    public function results() {
        $results = $this->dictionary->words;
        $template = $this->template->getTemplate();
        // filter so that words matching template places are returned only
        foreach($results as $k => $word) {
            $word = strtolower($word);
            if(!empty($template[1])) {
                if($word[0] != $template[1]) {
                    unset($results[$k]);
                    continue;
                }
            }
            if(!empty($template[2])) {
                if($word[1] != $template[2]) {
                    unset($results[$k]);
                    continue;
                }
            }
            if(!empty($template[3])) {
                if($word[2] != $template[3]) {
                    unset($results[$k]);
                    continue;
                }
            }
            if(!empty($template[4])) {
                if($word[3] != $template[4]) {
                    unset($results[$k]);
                    continue;
                }
            }
            if(!empty($template[5])) {
                if($word[4] != $template[5]) {
                    unset($results[$k]);
                    continue;
                }
            }
        }
        return $results;
    }
}
