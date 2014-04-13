<div>
    <!--    <div class="suodatin">            
            <form name="luokka" action="#">
                Luokka:
                <select class="">
                    <option value="">Kaikki</option>
                    <option value="Tärkeä">Tärkeä</option>
                    <option value="Tavallinen">Tavallinen</option>
                    <option value="Ei tärkeä">Ei tärkeä</option>
                </select>
                <input type="submit" value="Suodata">
            </form>
        </div>-->
</div>
<?php include 'views/ilmoitus.php'; ?>
<div class="panel panel-default taulukko">
    <table width='100%' class="table"> 
        <tr>
            <th>Askare</th>
            <th>Tärkeysaste</th>
            <th><a href="askare.php">Uusi Askare</a></th>
        </tr>     
        <?php foreach ($data->askareet as $askare): ?>
            <tr>
                <td><?php echo $askare->getNimi(); ?></td>
                <td><?php echo $askare->getTarkeysaste(); ?></td>
                <td><a href="askare.php?id=<?php echo $askare->getId() ?>">Muokkaa</a></td>
            </tr>
        <?php endforeach; ?>

    </table>
    <?php
    if (empty($data->askareet)) {
        echo '<p>EI ASKAREITA</p>';
    }
    ?>

</div>       
