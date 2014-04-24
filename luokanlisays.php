<?php

require 'libs/common.php';
require 'libs/models/Luokka.php';

$luokat = Luokka::getLuokat();
if (trim($_POST['Nimi']) == '') {
    $virhe = "Nimi ei saa olla tyhjä!";
}
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['Nimi'])) {
    $virhe = "Nimi ei saa sisältää erikoismerkkejä!";
}
if (isset($virhe)) {
    naytaNakyma('luokka', array(
        'virhe' => $virhe,
        'luokat' => $luokat
    ));
}
Luokka::lisaaLuokka($_POST['Nimi']);
$_SESSION['ilmoitus'] = "Luokka lisätty.";
header('Location: luokka.php');
