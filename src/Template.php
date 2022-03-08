<?php
namespace HttpTom\WordleHelper;


class Template {

    protected $positions = [
        1 => '',
        2 => '',
        3 => '',
        4 => '',
        5 => ''
    ];

    public function setCharacter($position, $char) {
        $this->positions[$position] = strtolower($char);
    }

    public function getTemplate() {
        return $this->positions;
    }
}