<?php

require 'libs/common.php';
require_once 'libs/models/Askare.php';
require_once 'libs/models/Tarkeysaste.php';

if (isset($_POST['talleta'])) {
    $uusiaskare = new Askare();
    $uusiaskare->setID($_POST['id']);
    $uusiaskare->setNimi($_POST['nimi']);
    $uusiaskare->setTarkeysaste($_POST['tarkeysaste']);

    if ($uusiaskare->onkoKelvollinen() && empty($_POST['id'])) {
        $uusiaskare->lisaaAskare();
        $_SESSION['ilmoitus'] = "Askare lisätty.";
        header('Location: etusivu.php');
    } else if ($uusiaskare->onkoKelvollinen() && isset($_POST['id'])) {
        $uusiaskare->paivitaAskare();
        $_SESSION['ilmoitus'] = "Askare päivitetty.";
        header('Location: etusivu.php');
    } else {

        $virheet = $uusiaskare->getVirheet();
        $asteet = Tarkeysaste::getTarkeysAsteet();
        naytaNakyma('askare', array(
            'asteet' => $asteet,
            'askare' => $uusiaskare,
            'virheet' => $virheet
        ));
    }
}

if (isset($_POST['poista'])) {
    $uusiaskare = new Askare();
    $uusiaskare->setID($_POST['id']);
    $uusiaskare->poistaAskare();
    $_SESSION['ilmoitus'] = "Askare poistettu.";
    header('Location: etusivu.php');
}


    