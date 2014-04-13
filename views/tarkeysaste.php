<?php include 'views/ilmoitus.php'; ?>
<div class="panel panel-default taulukko">
    <table width='100%' class="table"> 
        <tr>
            <th>Tärkeysaste</th>
            <th>Arvo</th>
            <th></th>
        </tr>
        <?php if (isset($data->tarkeysasteet)): ?>
            <?php foreach ($data->tarkeysasteet as $tarkeysaste): ?>
                <tr>
                    <td><?php echo $tarkeysaste->getNimi(); ?></td>
                    <td><?php echo $tarkeysaste->getArvo(); ?></td>
                    <td><form action="tarkeysasteenpoisto.php" method="POST"><input type="hidden" name="id" value="<?php echo $tarkeysaste->getID(); ?>"><input type=submit value="Poista"></form></td>
                </tr>
            <?php endforeach; ?>
        <?php else: echo 'Ei tärkeysasteita'; ?>
        <?php endif; ?>
    </table>
</div>       
<div style="margin-left: 20px">
    <form action="tarkeysasteenlisays.php" method="POST" class="form-group">
        <input type="text" name="Nimi" placeholder="Tärkeysasteen nimi" />
        Arvo:
        <select name="Arvo">
            <option>10</option>
            <option>9</option>
            <option>8</option>
            <option>7</option>
            <option>6</option>
            <option>5</option>
            <option>4</option>
            <option>3</option>
            <option>2</option>
            <option>1</option>
        </select>
        <input type="submit" value="Luo">
    </form>
</div>
<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
