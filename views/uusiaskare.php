<!-- Nimen ja tärkeysasteen muokkauslomake -->
<form class="input-group" method="POST" action="askareenluonti.php">
    <input type="text" name="nimi" class="form-control"  placeholder="Askareen nimi" value="<?php echo $data->askare->getNimi(); ?>"><br> 
    <input type="hidden" name="id" value="<?php echo $data->askare->getID(); ?>">
    <div> 
        <b>Tärkeysaste:</b>      
        <select name="tarkeysaste" style="margin-top: 5px;margin-bottom: 5px">
            <option value="">Ei Tärkeysastetta</option>
            <?php foreach ($data->asteet as $aste): ?>
                <option <?php
                if ($data->askare->getTarkeysaste() == $aste->getID()) {
                    echo 'selected="selected"';
                }
                ?> value="<?php echo $aste->getID(); ?>"><?php echo $aste->getNimi(); ?></option>
                <?php endforeach; ?>
        </select><br>
    </div> 
    <div>
        <b>Luokat:</b><br>
        <?php if(empty($data->luokat)){echo 'Ei luokkia';} ?>
        <?php foreach ($data->luokat as $luokka): ?>
        <input type="checkbox" name="askareenluokat[]" value="<?php echo $luokka->getID(); ?>" <?php if (in_array($luokka->getID(), $data->askare->getLuokat(), FALSE)) {echo 'checked';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $luokka->getNimi(); ?><br>
        <?php endforeach; ?>
    </div>
    <input type="submit" class="btn btn-default" name="talleta" value="Tallenna">
    <input type="submit" class="btn btn-default" name="peruuta" value="Peruuta">
</form>
<!-- Virheiden käsittely -->
<?php if (isset($data->virheet)): ?>
    <div class="alert alert-danger"><?php echo $data->virheet['nimi']; ?></div>
<?php endif; ?>


