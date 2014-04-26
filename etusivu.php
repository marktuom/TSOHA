<?php

require_once 'libs/common.php';
require_once 'libs/models/Askare.php';
require_once 'libs/models/Luokka.php';
$sivu = 'etusivu';
if (onKirjautunut()) {
    $suodatin = $_GET['luokka'];
    //Haetaan lista askareista. Haetaan vain tietyn luokan omaavat mikäli suodatin asetettu.
    if (empty($suodatin)) {
        $askareet = Askare::getAskarelistaus();
    } else {
        $askareet = Askare::getSuodatettuAskarelistaus($suodatin);
    }

    $luokat = Luokka::getLuokat();
    naytaNakyma($sivu, array(
        'askareet' => $askareet,
        'suodatin' => $suodatin,
        'luokat' => $luokat
    ));
} else {
    header('Location: index.php');
}

