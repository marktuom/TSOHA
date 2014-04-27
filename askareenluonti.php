<?php

require_once 'libs/common.php';
require_once 'libs/models/Askare.php';
require_once 'libs/models/Tarkeysaste.php';
require_once 'libs/models/Luokka.php';

if (!onKirjautunut() || (empty($_POST['talleta']) && empty($_POST['peruuta']))) {
     header('Location: index.php');
     exit();
}

//painettiin tallenna näppäintä
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
    if ($uusiaskare->onkoKelvollinen()) {
        //Annetut tiedot kelpaavat, luodaan askare ja lisätään luokat
        $id = $uusiaskare->lisaaAskare();
        $uusiaskare->setID($id);
        foreach ($_POST['askareenluokat'] as $luokka) {
            $uusiaskare->lisaaLuokka($luokka);
        }
        $_SESSION['ilmoitus'] = "Askare lisätty.";
        header('Location: etusivu.php');
    } else {
        //Annetut tiedot eivät kelpaa, pyydetään korjaamaan
        $virheet = $uusiaskare->getVirheet();
        $asteet = Tarkeysaste::getTarkeysAsteet();
        $luokat = Luokka::getLuokat();
        naytaNakyma('uusiaskare', array(
            'asteet' => $asteet,
            'askare' => $uusiaskare,
            'virheet' => $virheet,
            'luokat' => $luokat
        ));
    }
}

//Painettiin takaisin näppäintä
if (isset($_POST['peruuta'])) {
    header('Location: etusivu.php');
}