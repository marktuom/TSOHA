<?php
require 'libs/common.php';
require 'libs/models/Tarkeysaste.php';
require 'libs/models/Askare.php';

$sivu = 'askare';
if (onKirjautunut()) {
    $askare = Askare::getAskare($_GET['id']);
    if(empty($askare)){
        $askare = new Askare('0', NIL, NIL, NIL);
    }
    $asteet = Tarkeysaste::getTarkeysAsteet();
    naytaNakyma($sivu, array(
        'asteet' => $asteet,
        'askare' => $askare
  ));
} else {
    header('Location: index.php');
}