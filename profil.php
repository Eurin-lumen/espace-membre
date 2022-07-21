<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace-membre', 'root', ''); ?>
<?php if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare(('SELECT * FROM membres WHERE  id=?'));
    $requser->execute(array($getid));
    $userinfo =  $requser->fetch();
    ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de profil</title>
</head>

<body>
    <div align="center">
        <h2>Profil de <?php echo $userinfo['pseudo'];?> </h2>
        <br> <br> <br>
       
        Pseudo :  <?php echo $userinfo['pseudo'];?>
        <br>
        Mail:  <?php echo $userinfo['mail'];?>
        <br>

        <?php if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']):?>
            <a href="editionprofil.php">Éditer mon profil</a>
            <a href="deconnexion.php">se déconnecter</a>
    </div>
        <?php endif ?>

</body>

</html>
<?php
}
?>
