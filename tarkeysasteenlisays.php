<?php

require 'libs/common.php';
require 'libs/models/Tarkeysaste.php';

if (!onKirjautunut() ||empty($_POST['submit'])) {
     header('Location: index.php');
     exit();
}

//Tutkitaan onko nimi kelvollinen
if (trim($_POST['Nimi']) == '') {
    $virhe = "Nimi ei saa olla tyhjä!";
}
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['Nimi'])) {
    $virhe = "Nimi ei saa sisältää erikoismerkkejä!";
}
if (isset($virhe)) {
    //Näytetään virhe
    $tarkeysasteet = Tarkeysaste::getTarkeysAsteet();
    naytaNakyma('tarkeysaste', array(
        'virhe' => $virhe,
        'tarkeysasteet' => $tarkeysasteet
    ));
}

//Luodaan tärkeysaste
$aste = new Tarkeysaste(NIL, $_POST['Nimi'], $_POST['Arvo']);
$aste->lisaaTarkeysaste();
$_SESSION['ilmoitus'] = "Tärkeysaste lisätty.";
header('Location: tarkeysaste.php');
