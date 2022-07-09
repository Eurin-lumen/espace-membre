<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace-membre', 'root', '');

if(isset($_POST['formconnexion']))
{
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if(!empty ($mailconnect) AND  !empty($mdpconnect))
    {
        $requser  = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ? ");
        $requser->execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == true )
        {
            $usersinfo = $requser->fetch();
            $_SESSION['id'] = $usersinfo['id'];
            $_SESSION['pseudo'] = $usersinfo['pseudo'];
            $_SESSION['mail'] = $userinfo['mail'];
            header("Location: profil.php?id=".$_SESSION['id']);


        }
        else
        {
            

           $erreur = " <br/> Identifiant incorrect (Mail/Mot de passe)";

        }
    }
    else
    {
        $erreur =" <br >Tout les champs doivent etre complèter ! ";
    }

}

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