<?php
require_once 'libs/common.php';
require_once 'libs/models/Kayttaja.php';
if(isset($_POST['rekisteroidy'])){
    header('Location: rekisteroityminen.php');
}

if (empty($_POST['Nimi'])) {
    naytaKirjautumisNakyma(array(
        'virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta."
    ));
}
$nimi = $_POST['Nimi'];

if (empty($_POST['Salasana'])) {
    naytaKirjautumisNakyma(array(
        'kayttaja' => $nimi,
        'virhe' => "Kirjautuminen epäonnistui! Et antanut salasanaa."
    ));
}
$salasana = $_POST['Salasana'];

/* Tarkistetaan onko parametrina saatu oikeat tunnukset */
$kayttaja = Kayttaja::etsiKayttajaTunnuksilla($nimi, $salasana);
if (empty($kayttaja)) {
    naytaKirjautumisNakyma(array(
        'kayttaja' => $nimi,
        'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä."
    ));
} else {
    $_SESSION['kayttaja'] = $kayttaja->getID();
    header('Location: etusivu.php');
}
