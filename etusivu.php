<?php
require 'libs/common.php';

$sivu = 'etusivu';
if (common::onKirjautunut()) {
    naytaNakyma($sivu);
} else {
    header('Location: index.php');
}

