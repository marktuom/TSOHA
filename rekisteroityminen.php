<?php
require_once 'libs/common.php';
if (!empty($_SESSION['kayttaja'])) {
    header('Location: etusivu.php');
} 
naytaRekisteroitymisNakyma();
