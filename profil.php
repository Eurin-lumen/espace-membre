<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace-membre', 'root', '');


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
</head>

<body>
    <div align="center">
        <h2>Connexion</h2>
        <br> <br> <br>
        <form action="" method="POST">
            <input type="text" name="mailconnect" id="" placeholder="Email">
            <input type="password" name="mdpconnect" id="" placeholder="Mot de passe">
            <input type="submit" name="formconnexion" value="Se connecter">
        </form>
        <?php
        if(isset($erreur))
        {
            echo '<font color="red">'. $erreur ."</font>";
        }
        ?>
    </div>
</body>

</html>