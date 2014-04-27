<?php include 'views/ilmoitus.php'; ?>
<div>
    <form class="input-group" style="margin-left: 10px" method="POST" action="uusisalasana.php">
        <input type="password" name="uusiSalasana1" class="form-control" placeholder="Uusi salasana" >
        <input type="password" name="uusiSalasana2" class="form-control" placeholder="Toista salasana" >
        <input type="submit" class="btn btn-default" value="Vaihda salasana"> 
    </form>
</div>
<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<div>
    <form class="input-group" style="margin: 10px" action="tilinpoisto.php">        
        <input name="submit" type="submit" id="submit" value="Poista Tili">      
    </form>
</div>