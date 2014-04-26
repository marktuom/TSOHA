<?php include 'views/ilmoitus.php'; ?>
<!--Askareen lisäysnappi-->
<div class="nappi">
    <form action="askare.php"><input type=submit value="Uusi askare"></form>
</div>
<!--Suodatin askareille-->
<div class="suodatin">            
    <form method="GET" action="etusivu.php">
        Luokka:
        <select name="luokka">
            <option value="">Kaikki</option>
            <?php foreach ($data->luokat as $luokka): ?>
                <option <?php
                if ($luokka->getID() == $data->suodatin) {
                    echo 'selected="selected"';
                }
                ?> value="<?php echo $luokka->getID(); ?>"><?php echo $luokka->getNimi(); ?></option>
                <?php endforeach; ?>
        </select>
        <input type="submit" value="Suodata">
    </form>
</div>
<!--Lista askareista-->
<div class="panel panel-default taulukko">
    <table width='100%' class="table"> 
        <tr>
            <th>Askare</th>
            <th>Tärkeysaste</th>
            <th></th>
        </tr>     
        <?php foreach ($data->askareet as $askare): ?>
            <tr>
                <td><?php echo $askare->getNimi(); ?></td>
                <td><?php echo $askare->getTarkeysaste(); ?></td>
                <td><form action="askare.php" method="GET"><input type="hidden" name="id" value="<?php echo $askare->getID(); ?>"><input type=submit value="Muokkaa"></form></td>
                <td><form action="askareenpoisto.php" method="POST"><input type="hidden" name="id" value="<?php echo $askare->getID(); ?>"><input type=submit value="Poista"></form></td>
            </tr>
        <?php endforeach; ?>

    </table>
    <?php
    //Viesti jos askareita ei ole
    if (empty($data->askareet)) {
        if (empty($data->suodatin)) {
            echo '<p style="text-align: center">Ei askareita</p>';
        } else {
            echo '<p style="text-align: center">Ei luokkaan kuuluvia askareita</p>';
        }
    }
    ?>
</div>       
