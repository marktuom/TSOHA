<?php

require 'libs/common.php';
require_once 'libs/models/Tarkeysaste.php';
require_once 'libs/models/Askare.php';
require_once 'libs/models/Luokka.php';

$sivu = 'uusiaskare';
if (onKirjautunut()) {
    $luokat = Luokka::getLuokat();
    $asteet = Tarkeysaste::getTarkeysAsteet();
    $askare = new Askare('0', "", NULL, array());
    naytaNakyma($sivu, array(
        'asteet' => $asteet,
        'askare' => $askare,
        'luokat' => $luokat
    ));
} else {
    header('Location: index.php');
}
