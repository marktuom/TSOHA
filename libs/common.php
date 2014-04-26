<?php

session_start();

function onKirjautunut() {
    return isset($_SESSION['kayttaja']);
}

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/pohja.php';
    exit();
}

function naytaKirjautumisNakyma($data = array()) {
    $data = (object) $data;
    require 'views/kirjautuminen.php';
    exit();
}

function naytaRekisteroitymisNakyma($data = array()) {
    $data = (object) $data;
    require 'views/rekisteroityminen.php';
    exit();
}
