<?php

require_once 'libs/tietokantayhteys.php';
require_once 'libs/models/Kayttaja.php';
require_once 'libs/models/Luokka.php';

class Askare {

    private $id;
    private $nimi;
    private $tarkeysaste;
    private $luokat;
    private $virheet = array();

//Konstruktori, setterit ja getterit
    public function __construct($id, $nimi, $tarkeysaste, $luokat) {
        $this->id = $id;
        $this->nimi = $nimi;
        $this->tarkeysaste = $tarkeysaste;
        $this->luokat = $luokat;
    }

    public function getID() {
        return $this->id;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function getTarkeysaste() {
        return $this->tarkeysaste;
    }

    public function getLuokat() {
        return $this->luokat;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }

    public function setTarkeysaste($tarkeysaste) {
        $this->tarkeysaste = $tarkeysaste;
    }

    public function setLuokat($luokat) {
        $this->luokat = $luokat;
    }

    // Kaikkien käyttäjän askareiden haku tietokannasta
    public static function getAskarelistaus() {
        $sql = "SELECT Askare.id, Askare.Nimi as animi, Tarkeysaste.Nimi as tnimi, Tarkeysaste.Arvo FROM Askare LEFT OUTER JOIN Tarkeysaste ON Tarkeysaste_id = Tarkeysaste.id WHERE Askare.Kayttaja_id = ? ORDER BY Arvo DESC";
        $kysely = getTietokantayhteys()->prepare($sql);
        session_start();
        $kayttaja = (int) $_SESSION['kayttaja'];
        $kysely->execute(array($kayttaja));
        $askareet = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $askare = new Askare($tulos->id, $tulos->animi, $tulos->tnimi, NIL);
            $askareet[] = $askare;
        }
        return $askareet;
    }

    //Kaikkien tiettyyn luokkaan kuuluvien, tietyn käyttäjän askareiden haku tietokannasta
    public static function getSuodatettuAskarelistaus($luokka) {
        $sql = "SELECT Askare.id, Askare.Nimi as animi, Tarkeysaste.Nimi as tnimi, Tarkeysaste.Arvo FROM Askare LEFT OUTER JOIN Tarkeysaste ON Tarkeysaste_id = Tarkeysaste.id, Askareenluokka WHERE Askare.Kayttaja_id = ? AND Askare.id = Askareenluokka.Askare_id AND Askareenluokka.Luokka_id = ? ORDER BY Arvo DESC";
        $kysely = getTietokantayhteys()->prepare($sql);
        session_start();
        $kayttaja = (int) $_SESSION['kayttaja'];
        $kysely->execute(array($kayttaja, $luokka));
        $askareet = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $askare = new Askare($tulos->id, $tulos->animi, $tulos->tnimi, NIL);
            $askareet[] = $askare;
        }
        return $askareet;
    }

    //Askareen lisäys tietokantaan
    public function lisaaAskare() {
        $sql = "INSERT INTO Askare(nimi, Kayttaja_id, Tarkeysaste_id) VALUES(?,?,?) RETURNING id";
        $kysely = getTietokantayhteys()->prepare($sql);
        session_start();
        $kayttaja = (int) $_SESSION['kayttaja'];
        $kysely->execute(array($this->getNimi(), $kayttaja, $this->getTarkeysaste()));   
        $tulos = $kysely->fetch(PDO::FETCH_ASSOC);
        return $tulos["id"];
    }

    //askareen tietojen virhetarkistus
    public function onkoKelvollinen() {
        if (trim($this->nimi) == '') {
            $this->virheet['nimi'] = "Nimi ei saa olla tyhjä!";
        } else {
            if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $this->nimi)) {
                $this->virheet['nimi'] = "Nimessä ei saa käyttää erikoismerkkejä!";
            } else {
                unset($this->virheet['nimi']);
            }
        }
        return empty($this->virheet);
    }

    //metodi, joka palauttaa luokan virheet
    public function getVirheet() {
        return $this->virheet;
    }

    //Yhden askareen haku tietokannasta sen id numeron perusteella
    public static function getAskare($id) {
        $sql = "select * from Askare where Kayttaja_id = ? and id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        session_start();
        $kayttaja = (int) $_SESSION['kayttaja'];
        $kysely->execute(array($kayttaja, $id));
        $tulos = $kysely->fetchObject();
        return new Askare($tulos->id, $tulos->nimi, $tulos->tarkeysaste_id, NIL);
    }

    //Yhden askareen tietojen päivitys
    public function paivitaAskare() {
        $sql = "UPDATE Askare SET Nimi = ?, Tarkeysaste_id = ? where id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        session_start();
        $kayttaja = (int) $_SESSION['kayttaja'];
        $kysely->execute(array($this->getNimi(), $this->getTarkeysaste(), $this->getID()));
    }

    //askareen poistaminen
    public function poistaAskare() {
        $sql = "DELETE FROM Askare where id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getID()));
    }

    //Luokan lisääminen askareelle
    public function lisaaLuokka($luokka) {
        $sql = "INSERT INTO Askareenluokka(Askare_id, Luokka_id) VALUES(?,?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getID(), $luokka));
    }

    //Luokan poistaminen askareelta
    public function poistaLuokka($luokka) {
        $sql = "DELETE FROM Askareenluokka where Askare_id = ? AND Luokka_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getID(), $luokka));
    }

    //Kaikkien askareeseen liittyvien luokkien haku
    public function haeLuokat() {
        $sql = "SELECT id, Nimi FROM Luokka where id in (select Luokka_id from Askareenluokka where Askare_id = ?) and Kayttaja_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        session_start();
        $kayttaja = (int) $_SESSION['kayttaja'];
        $kysely->execute(array($this->id, $kayttaja));
        $luokat = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $luokka = new Luokka($tulos->id, $tulos->nimi);
            $luokat[] = $luokka;
        }
        return $luokat;
    }

}
