<?php

require_once 'libs/tietokantayhteys.php';

class Tarkeysaste {

    private $id;
    private $nimi;
    private $arvo;

    //setterit ja getterit
    public function getID() {
        return $this->id;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function getArvo() {
        return $this->arvo;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }

    public function setArvo($arvo) {
        $this->arvo = $arvo;
    }

    public function __construct($id, $nimi, $arvo) {
        $this->id = $id;
        $this->nimi = $nimi;
        $this->arvo = $arvo;
    }

    //Hakee käyttäjän tärkeysasteet tietokannasta
    public static function getTarkeysAsteet() {
        $sql = "SELECT id, Nimi, Arvo FROM Tarkeysaste WHERE Kayttaja_id = ? ORDER BY Arvo DESC";
        $kysely = getTietokantayhteys()->prepare($sql);
        session_start();
        $kayttaja = (int) $_SESSION['kayttaja'];
        $kysely->execute(array($kayttaja));
        $asteet = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $aste = new Tarkeysaste($tulos->id, $tulos->nimi, $tulos->arvo);
            $asteet[] = $aste;
        }
        return $asteet;
    }
    
    //lisää tärkeysasteen tietokantaan
    public function lisaaTarkeysaste() {
        $sql = "INSERT INTO Tarkeysaste(Nimi, Kayttaja_id, Arvo) VALUES(?,?,?) RETURNING id";
        $kysely = getTietokantayhteys()->prepare($sql);
        session_start();
        $kayttaja = (int) $_SESSION['kayttaja'];
        $ok = $kysely->execute(array($this->getNimi(), $kayttaja, $this->getArvo()));
        if ($ok) {
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    //Poistaa tärkeysasteen tietokannasta
    public static function poistaTarkeysaste($id) {
        $sql = "DELETE FROM Tarkeysaste where id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
    }

    //etsii ja palauttaa tärkeysasteen tietokannasta
    public static function etsiTarkeysaste($id){
        $sql = "select * from Tarkeysaste where Kayttaja_id = ? and id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        session_start();
        $kayttaja = (int) $_SESSION['kayttaja'];
        $kysely->execute(array($kayttaja, $id));
        $tulos = $kysely->fetchObject();
        return $tulos;   
    } 
}
