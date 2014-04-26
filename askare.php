<?php

require 'libs/common.php';
require_once 'libs/models/Tarkeysaste.php';
require_once 'libs/models/Askare.php';
require_once 'libs/models/Luokka.php';

$sivu = 'askare';
if (onKirjautunut()) {
    $askare = Askare::getAskare($_GET['id']);
    $luokat = Luokka::getLuokat();
    if (empty($askare)) {
        $askare = new Askare('0', NIL, NIL, NIL);
        $askareenluokat = NULL;
    } else {
        $askareenluokat = $askare->haeLuokat();
    }

    $asteet = Tarkeysaste::getTarkeysAsteet();
    naytaNakyma($sivu, array(
        'asteet' => $asteet,
        'askare' => $askare,
        'askareenluokat' => $askareenluokat,
        'luokat' => $luokat
    ));
} else {
    header('Location: index.php');
}