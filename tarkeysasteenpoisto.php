<?php
require 'libs/common.php';
require 'libs/models/Tarkeysaste.php';
require_once 'libs/models/Tarkeysaste.php';
Tarkeysaste::poistaTarkeysaste($_POST['id']);
$_SESSION['ilmoitus'] = "Tärkeysaste poistettu.";
header('Location: tarkeysaste.php');
