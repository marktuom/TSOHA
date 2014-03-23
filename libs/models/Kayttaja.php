<?php

/**
 * Description of kayttaja
 *
 * @author Markus
 */
class Kayttaja {
    private $id;
    private $nimi;
    private $salasana;

    public function __construct($id, $nimi, $salasana) {
        $this->id = $id;
        $this->nimi = $nimi;
        $this->salasana = $salasana;
    }

    /* Tähän gettereitä ja settereitä */
    public function getNimi(){
        return $this->nimi;
    }
    
    public function getSalasana(){
        return $this->salasana;
    }
}
