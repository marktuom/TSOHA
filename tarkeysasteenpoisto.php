<?php
require 'libs/common.php';
require 'libs/models/Tarkeysaste.php';

if (!onKirjautunut() ||empty($_POST['id'])) {
     header('Location: index.php');
     exit();
}

Tarkeysaste::poistaTarkeysaste($_POST['id']);
$_SESSION['ilmoitus'] = "Tärkeysaste poistettu.";
header('Location: tarkeysaste.php');
