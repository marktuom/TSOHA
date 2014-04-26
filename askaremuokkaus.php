<?php

require_once 'libs/common.php';
require_once 'libs/models/Askare.php';
require_once 'libs/models/Tarkeysaste.php';

//Painettiin talleta näppäintä
if (isset($_POST['talleta'])) {
    $uusiaskare = new Askare();
    $uusiaskare->setID($_POST['id']);
    $uusiaskare->setNimi($_POST['nimi']);
    if(empty($_POST['tarkeysaste'])){
        $uusiaskare->setTarkeysaste(NULL);
    } else {
        $uusiaskare->setTarkeysaste($_POST['tarkeysaste']);
    }
    

    //Tehdään toiminto syötettyjen tietojen perusteella
    if ($uusiaskare->onkoKelvollinen() && empty($_POST['id'])) {
        //Annetut tiedot kelpaavat ja askaretta ei ole vielä olemassa eli luodaan uutta
        $uusiaskare->lisaaAskare();
        $_SESSION['ilmoitus'] = "Askare lisätty.";
        header('Location: etusivu.php');
    } else if ($uusiaskare->onkoKelvollinen() && isset($_POST['id'])) {
        //Annetut tiedot kelpaavat ja askare on olemassa eli päivitetään vanha
        $uusiaskare->paivitaAskare();
        $_SESSION['ilmoitus'] = "Askare päivitetty.";
        header('Location: etusivu.php');
    } else {
        //Annetut tiedot eivät kelpaa, pyydetään korjaamaan
        $virheet = $uusiaskare->getVirheet();
        $asteet = Tarkeysaste::getTarkeysAsteet();
        naytaNakyma('askare', array(
            'asteet' => $asteet,
            'askare' => $uusiaskare,
            'virheet' => $virheet
        ));
    }
}

//Painettiin peruuta näppäintä
if (isset($_POST['peruuta'])) {
    header('Location: etusivu.php');
}


    