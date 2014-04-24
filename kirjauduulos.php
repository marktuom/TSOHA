<?php

//Avataan istunto
session_start();

//Poistetaan istunnosta merkintä kirjautuneesta käyttäjästä -> Kirjaudutaan ulos
unset($_SESSION['kayttaja']); 


//Ilmoitetaan uloskirjautumisesta
$_SESSION['ilmoitus'] = "Kirjauduttu ulos!";

//Yleensä kannattaa ulkos kirjautumisen jälkeen ohjata käyttäjä kirjautumissivulle
header('Location: kirjautuminen.php');
