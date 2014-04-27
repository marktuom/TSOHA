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

    //setterit ja getterit

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

    
    //Uuden käyttäjän lisäys tietokantaan
    public static function lisaaKayttaja($nimi, $salasana) {
        $sql = "INSERT INTO Kayttaja(Nimi, Salasana) VALUES(?,?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($nimi, $salasana));
    }

    
    //Tutkitaan löytyykö jonkin niminen käyttäjä tietokannasta
    public static function nimiVarattu($nimi) {
        $sql = "SELECT * from Kayttaja where Nimi = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($nimi));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    
    //Käyttäjän hakeminen käyttäjätunnuksella ja salasanalla
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
            $kayttaja->setNimi($tulos->nimi);
            $kayttaja->setSalasana($tulos->salasana);
            return $kayttaja;
        }
    }
    
    //Salasanan päivittäminen
    public static function muutasalasana($salasana) {
        $sql = "UPDATE Kayttaja SET Salasana = ? where id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        session_start();
        $kayttaja = (int) $_SESSION['kayttaja'];
        $kysely->execute(array($salasana, $kayttaja));
    }
    
    //Käyttäjän poistaminen
    public static function poistaTili($id) {
        $sql = "DELETE FROM Kayttaja where id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
    }

}
