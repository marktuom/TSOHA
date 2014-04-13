<?php
require 'libs/common.php';
$sivu = 'luokka';
if (onKirjautunut()) {
    naytaNakyma($sivu, array(
    
  ));
} else {
    header('Location: index.php');
}