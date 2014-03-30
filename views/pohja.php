<!DOCTYPE html>
<html>
    <head>
        <title>Muistilista</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1><a href="etusivu.php">Muistilista</a></h1>           
        </header>
        <form style="float: right" name="form" action="kirjauduulos.php">
            <label class="oikeaYlakulmaValikko">
                <input type="submit" value="kirjaudu ulos">
            </label>          
        </form>
        <div style="float: right" class="tiliLinkki">
            <a href="#">Tilin asetukset</a>
        </div>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#">Askareet</a></li>
            <li><a href="#">Luokat</a></li>
            <li><a href="#">Tärkeysasteet</a></li>
        </ul>
        <?php
        /* HTML-rungon keskellä on sivun sisältö, 
         * joka haetaan sopivasta näkymätiedostosta.
         * Oikean näkymän tiedostonimi on tallennettu muuttujaan $sivu.
         */
        require 'views/' . $sivu . '.php';
        ?>
    </body>
</html>
