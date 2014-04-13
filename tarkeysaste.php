<?php
require 'libs/common.php';
require 'libs/models/Tarkeysaste.php';
$sivu = 'tarkeysaste';
if (onKirjautunut()) {
    $tarkeysasteet = Tarkeysaste::getTarkeysAsteet();
    naytaNakyma($sivu, array(
    'tarkeysasteet' => $tarkeysasteet
  ));
} else {
    header('Location: index.php');
}