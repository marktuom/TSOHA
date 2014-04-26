<?php

require_once 'libs/models/Askare.php';

if (isset($_POST['lisaa'])) {
    $askare = Askare::getAskare($_POST['id']);
    $luokka = $_POST['luokka'];
    $askare->lisaaLuokka($luokka);
    $_SESSION['ilmoitus'] = "Luokka lisätty.";
    header("Location: askare.php?id=" . $_POST['id']);
    exit();
}

if(isset($_POST['poista'])){
    $askare = Askare::getAskare($_POST['id']);
    $luokka = $_POST['luokka'];
    $askare->poistaLuokka($luokka);
    $_SESSION['ilmoitus'] = "Luokka poistettu.";
    header("Location: askare.php?id=" . $_POST['id']);
    exit();
}
