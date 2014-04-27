<?php

require 'libs/common.php';
require_once 'libs/models/Tarkeysaste.php';
require_once 'libs/models/Askare.php';
require_once 'libs/models/Luokka.php';

$sivu = 'askare';
if (onKirjautunut()) {
    $askare = Askare::getAskare($_GET['id']);
    $luokat = Luokka::getLuokat();
    $askareenluokat = $askare->haeLuokat();
    $askare->setLuokat($askareenluokat);
    $asteet = Tarkeysaste::getTarkeysAsteet();
    naytaNakyma($sivu, array(
        'asteet' => $asteet,
        'askare' => $askare,
        'luokat' => $luokat
    ));
} else {
    header('Location: index.php');
}