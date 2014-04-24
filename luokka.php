<?php

require 'libs/common.php';
require 'libs/models/Luokka.php';
$sivu = 'luokka';

if (onKirjautunut()) {
    $luokat = Luokka::getLuokat();
    naytaNakyma($sivu, array(
        'luokat' => $luokat
    ));
} else {
    header('Location: index.php');
}