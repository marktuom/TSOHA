<?php

//Avataan istunto
session_start();

//Poistetaan istunnosta merkintä kirjautuneesta käyttäjästä -> Kirjaudutaan ulos
session_destroy();

//Yleensä kannattaa ulkos kirjautumisen jälkeen ohjata käyttäjä kirjautumissivulle
header('Location: kirjautuminen.php');
