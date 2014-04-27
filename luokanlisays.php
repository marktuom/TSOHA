<?php

require 'libs/common.php';
require 'libs/models/Luokka.php';

if (!onKirjautunut()) {
     header('Location: index.php');
     exit();
}

//Tutkitaan onko annettu nimi luokalle kelvollinen
if (trim($_POST['Nimi']) == '') {
    $virhe = "Nimi ei saa olla tyhjä!";
}
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['Nimi'])) {
    $virhe = "Nimi ei saa sisältää erikoismerkkejä!";
}
if (isset($virhe)) {
    $luokat = Luokka::getLuokat();
    naytaNakyma('luokka', array(
        'virhe' => $virhe,
        'luokat' => $luokat
    ));
}

//Luodaan uusi luokka ja ilmoitetaan siitä
Luokka::lisaaLuokka($_POST['Nimi']);
$_SESSION['ilmoitus'] = "Luokka lisätty.";
header('Location: luokka.php');
