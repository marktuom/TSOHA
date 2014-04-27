<?php

require 'libs/common.php';
require 'libs/models/Luokka.php';

if (!onKirjautunut() || empty($_POST['id'])) {
     header('Location: index.php');
     exit();
}

Luokka::poistaLuokka($_POST['id']);
$_SESSION['ilmoitus'] = "Luokka poistettu.";
header('Location: luokka.php');
