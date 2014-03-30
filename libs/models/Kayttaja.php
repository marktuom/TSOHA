<?php
require_once 'libs/tietokantayhteys.php';
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

    public function getID() {
        return $this->id;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function getSalasana() {
        return $this->salasana;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }

    public function setSalasana($salasana) {
        $this->salasana = $salasana;
    }

    public static function etsiKayttajaTunnuksilla($nimi1, $salasana1) {
        $sql = "SELECT id, Nimi, Salasana from Kayttaja where Nimi = ? AND Salasana = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($nimi1, $salasana1));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $kayttaja = new Kayttaja();
            $kayttaja->setId($tulos->id);
            $kayttaja->setNimi($tulos->Nimi);
            $kayttaja->setSalasana($tulos->Salasana);
            return $kayttaja;
        }
    }

}
