<?php
require 'libs/common.php';
require 'libs/models/Tarkeysaste.php';
$tarkeysasteet = Tarkeysaste::getTarkeysAsteet();
if (trim($_POST['Nimi']) == '') {
    $virhe = "Nimi ei saa olla tyhjä!";
}
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['Nimi'])) {
    $virhe = "Älä käytä nimessä erikoismerkkejä!";
} 
if(isset($virhe)){
    naytaNakyma($sivu, array(
    'virhe' => $virhe,
    'tarkeysasteet' => $tarkeysasteet
));
}
$aste = new Tarkeysaste(NIL, $_POST['Nimi'], $_POST['Arvo']);
$aste->lisaaTarkeysaste();
$_SESSION['ilmoitus'] = "Tärkeysaste lisätty.";
header('Location: tarkeysaste.php');
