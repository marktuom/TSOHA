<?php
require_once 'libs/tietokantayhteys.php';
require_once './libs/models/Kayttaja.php';

$sql = "SELECT id,Nimi,Salasana from Kayttaja";
$kysely = getTietokantayhteys()->prepare($sql);
$kysely->execute();
?>
<h1>HTML KOODIA</h1>
<p>asdf</p>
<?php
echo "<h1>PHP KOODIA</h1>";
echo 'Kannasta haettu nimi:  ';
echo $kysely->fetchColumn(1);
