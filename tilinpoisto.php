<?php
require 'libs/common.php';
require 'libs/models/Kayttaja.php';

if (!onKirjautunut()) {
     header('Location: index.php');
     exit();
}

//poistetaan kirjautuneena olevan tili
Kayttaja::poistaTili($_SESSION['kayttaja']);

//Poistetaan istunnosta merkintä kirjautuneesta käyttäjästä
unset($_SESSION['kayttaja']); 

//Ilmoitetaan toiminnon suorittamisesta
$_SESSION['ilmoitus'] = "Tili poistettu!";

//Ohjataan kirjautumisnäkymään
header('Location: kirjautuminen.php');
