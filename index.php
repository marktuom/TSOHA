<?php
require_once 'libs/common.php';

if (onKirjautunut()) {
    header('Location: etusivu.php');
} else{
    header('Location: kirjautuminen.php');
}