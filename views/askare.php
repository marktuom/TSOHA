<?php include 'views/ilmoitus.php'; ?>
<!-- Nimen ja tärkeysasteen muokkauslomake -->
<form class="input-group" style="margin-left: 10px; margin-top: 20px" method="POST" action="askaremuokkaus.php">
    <input type="text" name="nimi" class="form-control"  placeholder="Askareen nimi" value="<?php echo $data->askare->getNimi(); ?>"><br> 
    <input type="hidden" name="id" value="<?php echo $data->askare->getID(); ?>">
    <?php if (isset($data->asteet)): ?>
        <div> 
            <b>Tärkeysaste:</b>      
            <select name="tarkeysaste" style="margin-top: 5px;margin-bottom: 5px">
                <option value="">Ei Tärkeysastetta</option>
                <?php foreach ($data->asteet as $aste): ?>
                    <option <?php
                    if ($data->askare->getTarkeysaste() === $aste->getID()) {
                        echo 'selected="selected"';
                    }
                    ?> value="<?php echo $aste->getID(); ?>"><?php echo $aste->getNimi(); ?></option>
                    <?php endforeach; ?>
            </select><br>
        </div> 
    <?php endif; ?>
    <input type="submit" class="btn btn-default" name="talleta" value="Tallenna">
    <input type="submit" class="btn btn-default" name="peruuta" value="Peruuta">
</form>
<!-- Virheiden käsittely -->
<?php if (isset($data->virheet)): ?>
    <div class="alert alert-danger"><?php echo $data->virheet['nimi']; ?></div>
<?php endif; ?>

<!-- Luokkien hallinta -->
<?php if ($data->askare->getID() == 0): ?>
    <div style="margin-top: 10px;margin-left: 10px">
        <p>Voit lisätä askareelle luokkia muokkausnäkymässä</p>
    </div>
<?php else: ?>
    <div style="margin-top: 10px;margin-left: 10px">
        <table>
            <tr>
                <th>Luokat:</th>
            </tr>
            <?php foreach ($data->askareenluokat as $luokka): ?>
                <tr>
                    <td><?php echo $luokka->getNimi(); ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><form action="askareenluokka.php" method="POST"><input name="id" type="hidden" value="<?php echo $data->askare->getID(); ?>"><input type="hidden" name="luokka" value="<?php echo $luokka->getID(); ?>"><input name="poista" type=submit value="Poista"></form></td>
                </tr>
            <?php endforeach; ?>            
        </table>
        <?php if (empty($data->askareenluokat)) : ?>
            Ei luokkia
        <?php endif; ?> 
        <?php if (count($data->askareenluokat) < count($data->luokat)): ?>
            <form method="POST" action="askareenluokka.php">
                <select name="luokka">
                    <?php foreach ($data->luokat as $luokka): ?>
                        <?php if (!in_array($luokka, $data->askareenluokat, FALSE)) : ?>
                            <option value="<?php echo $luokka->getID(); ?>"><?php echo $luokka->getNimi(); ?></option>
                        <?php endif; ?>         
                    <?php endforeach; ?>
                </select>
                <input name="id" type="hidden" value="<?php echo $data->askare->getID(); ?>">
                <input name="lisaa" type="submit" value="Lisää luokka">
            </form>
        <?php endif; ?> 
    </div>
<?php endif; ?>
