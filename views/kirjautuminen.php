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
        <div>
            <h1>
                Kirjaudu sisään
            </h1>
        </div>
        <div>
            <form class="input-group" style="margin-left: 10px" method="POST" action="kirjaudu.php">
                <input type="text" name="Nimi" class="form-control" placeholder="Nimi"  value="<?php echo $data->kayttaja; ?>"><br>
                <input type="password" name="Salasana" class="form-control" placeholder="Salasana" ><br>
                <input type="submit" class="btn btn-default" value="Kirjaudu"> <input type="submit" class="btn btn-default" value="Rekisteröidy">
            </form>
        </div>
        <?php if (!empty($data->virhe)): ?>
            <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
        <?php endif; ?>
    </body>
</html>


