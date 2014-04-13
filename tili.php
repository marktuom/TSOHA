<?php
require 'libs/common.php';
$sivu = 'tili';
if (onKirjautunut()) {
    naytaNakyma($sivu, array(
    
  ));
} else {
    header('Location: index.php');
}