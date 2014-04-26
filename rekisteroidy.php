<?php

require_once 'libs/common.php';
require_once 'libs/models/Kayttaja.php';
if (isset($_POST['peruuta'])) {
    header('Location: kirjautuminen.php');
}

//Tarkistetaan onko nimi kelvollinen
if (empty($_POST['Nimi']) || trim($_POST['Nimi']) == '') {
    naytaRekisteroitymisNakyma(array(
        'virhe' => "Nimi ei saa olla tyhjä."
    ));
}

if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['Nimi'])) {
    naytaRekisteroitymisNakyma(array(
        'virhe' => "Älä käytä nimessä erikoismerkkejä."
    ));
}

if (Kayttaja::nimiVarattu($_POST['Nimi'])) {
    naytaRekisteroitymisNakyma(array(
        'virhe' => "Nimi on jo varattu."
    ));
}

$nimi = $_POST['Nimi'];

// Tarkistetaan onko salasana kelvollinen
if (empty($_POST['Salasana1']) || trim($_POST['Salasana1']) == '') {
    naytaRekisteroitymisNakyma(array(
        'kayttaja' => $nimi,
        'virhe' => "Salasana ei saa olla tyhjä."
    ));
}

if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['Salasana1'])) {
    naytaRekisteroitymisNakyma(array(
        'kayttaja' => $nimi,
        'virhe' => "Älä käytä salasanassa erikoismerkkejä."
    ));
}

if (empty($_POST['Salasana2'])) {
    naytaRekisteroitymisNakyma(array(
        'kayttaja' => $nimi,
        'virhe' => "Et toistanut salasanaa."
    ));
}

if ($_POST['Salasana1'] != $_POST['Salasana2']) {
    naytaRekisteroitymisNakyma(array(
        'kayttaja' => $nimi,
        'virhe' => "Salasanojen tulee täsmätä."
    ));
}

//Luodaan käyttäjä ja annetaan ilmoitus
Kayttaja::lisaaKayttaja($_POST['Nimi'], $_POST['Salasana1']);
$_SESSION['ilmoitus'] = "Rekisteröityminen onnistui!";
header('Location: kirjautuminen.php');
