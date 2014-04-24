<?php
session_start();
if (!empty($_SESSION['kayttaja'])) {
    header('Location: etusivu.php');
} else{
    header('Location: kirjautuminen.php');
}