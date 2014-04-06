<form class="input-group" style="margin-left: 10px; margin-top: 20px" method="POST" action="askaremuokkaus.php">
    <input type="text" name="nimi" class="form-control"  placeholder="Askareen nimi" value="<?php echo $data->askare->getNimi(); ?>"><br>
    <?php if (!empty($data->virheet)): ?>
        <div class="alert alert-danger"><?php echo $data->virheet['nimi']; ?></div>
    <?php endif; ?>
        <div>
            <input type="hidden" name="id" value="<?php echo $data->askare->getID(); ?>">
        </div>
    <!--    <div>
            <b>Luokat:</b><br>
            Luokka 1                
            <input type="checkbox" value="1" name="luokka[]" class="btn-default"><br>
            Luokka 2   
            <input type="checkbox" value="true" name="luokka[]" class="btn-default"><br>
        </div>-->
    <?php if (isset($data->asteet)): ?>
        <div> 
            <b>Tärkeysaste:</b>      
            <select name="tarkeysaste">
                <?php foreach ($data->asteet as $aste): ?>
                    <option value="<?php echo $aste->getID(); ?>"><?php echo $aste->getNimi(); ?></option>
                <?php endforeach; ?>
            </select><br>
        </div> 
    <?php endif; ?>
    <input type="submit" class="btn btn-default" name="talleta" value="Tallenna">
    <input type="submit" class="btn btn-default" name="poista" value="Poista">
</form>
