<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace-membre', 'root', '');
if(isset($_SESSION['id']))
{
    $requser =$bdd->prepare("SELECT * FROM membres WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    
// Mettre à jour le pseudo
    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo']!= $user['pseudo'])
    {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ? ");
        $insertpseudo->execute(array($newpseudo,$_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
// Mettre à jour le mail
    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail']!= $user['mail'])
    {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ? ");
        $insertmail->execute(array($newmail,$_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
// Mettre à jour le mot de passe
    if(isset($_POST['newpmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newpmdp2']) AND !empty($_POST['newmdp2']))
    {
        $mdp1 = sha1($_POST['newmdp1']);
        $mdp2 = sha1($_POST['newmdp2']);
        if($mdp1 == $mdp2)
        {
            $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
            $insertmdp->execute(array($newmdp1, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION['id']);

        }
        else
        {
            $msg = "Vos deux mots de passe ne correspondent pas !";

        }



    }
    if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
        $taillmax = 2097152;
        $extensionValide = array('jpg', 'jpeg', 'gif', 'png');

        if($_FILES['avatar']['size'] <= $taillmax){
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'),1));
            if(in_array($extensionUpload, $extensionValide)){
                $chemin = "membres/avatar/".$_SESSION['id']. ".". $extensionUpload;
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                if($resultat){
                    $updateavatar = $bdd->prepare("UPDATE membres  SET avatar  = :avatar WHERE id= :id");
                    $updateavatar->execute(array(
                        'avatar' => $_SESSION['id'].".".$extensionUpload,
                        'id' => $_SESSION['id']
                    )); 
                    header('Location: profil.php?id='.$_SESSION['id']);


                }
                else{
                    $msg = "Erreur durant l'importation de votre phot de profile";
                }
            }
            else{
                $msg = "Votre photo de profile ne doit etre au format 'jpg', 'jpeg', 'gif' ou 'png' ";
            }
        }else{
            $msg = "Votre photo de profile ne doit pas dépasser 2 Mo";
        }
    }

    // if(isset($_POST['newpseudo']) AND $_POST['newpseudo'] == $_POST['userpseudo'] )
    // {
    //     header('Location: profil.php?id='.$_SESSION['id']);


    // }

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
        <h2>Édition de mon profil</h2>
        <br> <br>
        <?php if(!empty($userinfo['avatar'])): ?>
        <img src="/membres/avatar/11.jpg" width="auto"/>
        <?php endif ?>
        
           
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Nouveau Pseudo : </label>
                    <input type="text"   name="newpseudo" id="" placeholder="Pseudo" /> <br> <br>
                            
                    <label for="">Nouveau E-mail : </label>
                    <input type="email"  name="newmail" id="" placeholder="Mail"> <br> <br>
                            
                    <label for=""> Mot de passe: </label>
                    <input type="password" name="newmdp1" id="" placeholder="Mot de passe "> <br> <br>
                           
                    <label for="">Confirmation - Mot de passe: </label>
                    <input type="password" name="newmdp2" id="" placeholder="Confirmez votre mot de passe"> <br> <br>
                    
                    <label for="">Avatar :</label>
                    <input type="file" name="avatar" id=""/>

                    <br> <br>
                    <input type="submit" value="Mettre à jour mon profil !">
                    
                </form>
                <?php
                //Affiche message d'erreur
                if(isset($msg)){echo $msg;} ?>
            
        

    </div>
</body>

</html>
<?php
}
else
{
    header('Location: connexion.php');

}

?>