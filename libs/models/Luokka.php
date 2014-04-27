<?php

require_once 'libs/tietokantayhteys.php';

class Luokka {

    private $id;
    private $nimi;

    // setterit ja getterit
    public function getID() {
        return $this->id;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }

    public function __construct($id, $nimi) {
        $this->id = $id;
        $this->nimi = $nimi;
    }

    //lisää luokan tietokantaan
     public static function lisaaLuokka($nimi) {
        $sql = "INSERT INTO Luokka(Nimi, Kayttaja_id) VALUES(?,?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        session_start();
        $kayttaja = (int) $_SESSION['kayttaja'];
        $kysely->execute(array($nimi, $kayttaja));
    }
    
    //Palauttaa kaikki käyttäjän luokat
    public static function getLuokat() {
        $sql = "SELECT id, Nimi FROM Luokka WHERE Kayttaja_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        session_start();
        $kayttaja = (int) $_SESSION['kayttaja'];
        $kysely->execute(array($kayttaja));
        $luokat = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $luokka = new Luokka($tulos->id, $tulos->nimi);
            $luokat[] = $luokka;
        }
        return $luokat;
    }

    //poistaa luokan tietokannasta
    public static function poistaLuokka($id) {
        $sql = "DELETE FROM Luokka where id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
    }

}
