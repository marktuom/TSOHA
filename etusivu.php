<?php
require 'libs/common.php';
require 'libs/models/Askare.php';
$sivu = 'etusivu';
if (onKirjautunut()) {
    $askareet = Askare::getAskarelistaus();
    naytaNakyma($sivu, array(
    'askareet' => $askareet
  ));
} else {
    header('Location: index.php');
}

