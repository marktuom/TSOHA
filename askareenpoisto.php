<?php
require_once 'libs/common.php';
require_once 'libs/models/Askare.php';

$uusiaskare = new Askare();
$uusiaskare->setID($_POST['id']);
$uusiaskare->poistaAskare();
$_SESSION['ilmoitus'] = "Askare poistettu.";
header('Location: etusivu.php');