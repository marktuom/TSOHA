<?php

require_once 'libs/common.php';
require_once 'libs/models/Askare.php';
require_once 'libs/models/Tarkeysaste.php';
require_once 'libs/models/Luokka.php';

//jos painettii talleta näppäintä
if (isset($_POST['talleta'])) {
    $uusiaskare = new Askare();
    $uusiaskare->setID($_POST['id']);
    $uusiaskare->setNimi($_POST['nimi']);
    if (empty($_POST['tarkeysaste'])) {
        $uusiaskare->setTarkeysaste(NULL);
    } else {
        $uusiaskare->setTarkeysaste($_POST['tarkeysaste']);
    }
    $uusiaskare->setLuokat($_POST['askareenluokat']);

    //Tehdään toiminto syötettyjen tietojen perusteella
    if ($uusiaskare->onkoKelvollinen() && isset($_POST['id'])) {
        //Annetut tiedot kelpaavat eli päivitetään ne
        $uusiaskare->paivitaAskare();
        $vanhatluokat = Askare::getAskare($_POST['id'])->haeLuokat();
        //Lisätään puuttuvat luokat
        foreach ($_POST['askareenluokat'] as $luokka) {
            if (!in_array($luokka, $vanhatluokat)) {
                $uusiaskare->lisaaLuokka($luokka);
            }
        }
        //Poistetaan ylimääräiset luokat
        foreach ($vanhatluokat as $luokka) {
            if (!in_array($luokka, $uusiaskare->getLuokat())) {
                $uusiaskare->poistaLuokka($luokka);
            }
        }
        $_SESSION['ilmoitus'] = "Askare päivitetty.";
        header('Location: etusivu.php');
    } else {
        //Annetut tiedot eivät kelpaa, pyydetään korjaamaan
        $virheet = $uusiaskare->getVirheet();
        $asteet = Tarkeysaste::getTarkeysAsteet();
        $luokat = Luokka::getLuokat();
        naytaNakyma('askare', array(
            'asteet' => $asteet,
            'askare' => $uusiaskare,
            'virheet' => $virheet,
            'luokat' => $luokat
        ));
    }
}

//Jos painettiin peruuta näppäintä
if (isset($_POST['peruuta'])) {
    header('Location: etusivu.php');
}


    