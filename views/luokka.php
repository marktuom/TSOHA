<?php include 'ilmoitus.php'; ?>
<div class="panel panel-default taulukko">
    <table width='100%' class="table"> 
        <tr>
            <th>Luokan nimi</th>
            <th></th>
        </tr>
        <?php if (isset($data->luokat)): ?>
            <?php foreach ($data->luokat as $luokka): ?>
                <tr>
                    <td><?php echo $luokka->getNimi(); ?></td>
                    <td><form action="luokanpoisto.php" method="POST"><input type="hidden" name="id" value="<?php echo $luokka->getID(); ?>"><input type=submit value="Poista"></form></td>
                </tr>
            <?php endforeach; ?>
        <?php else: echo 'Ei tärkeysasteita'; ?>
        <?php endif; ?>
    </table>
    <?php if (empty($data->luokat)) {
         echo '<h3 style="text-align: center">EI LUOKKIA</3h>';
    } ?>
</div>       
<div style="margin-left: 20px">
    <form name="Uusi" method="POST" action="luokanlisays.php" class="form-group">
        <input type="text" name="Nimi" placeholder="Luokan nimi" />
        <input type="submit" value="Luo uusi">
    </form>
</div>
<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>