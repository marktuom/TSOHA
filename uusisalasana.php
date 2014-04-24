<?php

require 'libs/common.php';
require 'libs/models/Kayttaja.php';

if(!onKirjautunut()){
    header('Location: index.php');
}

//tarkistetaan onko salasana kelvollinen, jos ei niin ohjataan takaisin virheen kera
if (empty($_POST['uusiSalasana1']) || trim($_POST['uusiSalasana1']) == '') {
    naytaNakyma('tili', array(
        'virhe' => "Salasana ei saa olla tyhjä."
    ));
}

if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['uusiSalasana1'])) {
    naytaNakyma('tili', array(
        'virhe' => "Salasana ei saa sisältää erikoismerkkejä."
    ));
}

if (empty($_POST['uusiSalasana2'])) {
    naytaNakyma('tili', array(
        'virhe' => "Et toistanut salasanaa."
    ));
}

if ($_POST['uusiSalasana1'] != $_POST['uusiSalasana2']) {
     naytaNakyma('tili', array(
        'virhe' => "Salasanat eivät täsmää."
    ));
}

//vaihdetaan salasana
Kayttaja::muutasalasana($_POST['uusiSalasana1']);

//Ilmoitetaan toiminnon suorittamisesta
$_SESSION['ilmoitus'] = "Salasana vaihdettu!";

//Ohjataan takaisin tili näkymään
header('Location: tili.php');
