<?php

require 'libs/common.php';
require 'libs/models/Luokka.php';

Luokka::poistaLuokka($_POST['id']);
$_SESSION['ilmoitus'] = "Luokka poistettu.";
header('Location: luokka.php');
