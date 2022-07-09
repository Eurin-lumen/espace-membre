<?php

$bdd = new PDO('mysql:host=localhost;dbname=espace-membre', 'root', '');
if(isset($_POST['forminscription']))
{
     // CONTROLE DE INJECTION DE CODE 
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);  
    $mdp2 = sha1($_POST['mdp2']);

    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
        {
           
            //
            $pseudolenght = strlen($pseudo);
            if($pseudolenght <= 30)
            {
                if($mail  == $mail2)
                   
                {
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                    {
                        $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail  = ? ");
                        $reqmail->execute(array($mail));
                        $mailexist = $reqmail->rowCount();
                        if($mailexist == 0)
                        {
                            if($mdp == $mdp2)
                            {
                                // inserer dans la base inserer dans la base de donnée
                            $insertmbr = $bdd-> prepare ("INSERT INTO membres(pseudo, mail, motdepasse) VALUES(?, ?, ?)");
                            $insertmbr->execute(array($pseudo, $mail, $mdp));
                            $erreur = "Votre compte à bien été crée";
                            }
                            else
                            {
                            $erreur = "Vos mots de passe ne correspondent pas !";

                            }
                        }
                        else
                        {
                            $erreur = "Adresse mail déja utilisée ! ";
                        }
                    }
                    else
                    {
                        $erreur = "Votre addresse mail n'est pas valide";

                    }

                
                }
                else
                {
                        $erreur = "Vos addresses mail ne correspondent pas !";
                }
            }
            else
            {
                $erreur = "Votre pseudo ne doit pas dépasser 30 caractères !";
            }

        }
        else
        {
            $erreur = "Tout les champs doivent etre complèter ";

        }
        
    
}


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création espace membres avec php</title>
</head>

<body>
    <div align="center">
        <h2>Inscription</h2>
        <br> <br> <br>
        <form action="" method="post">
            <table>
                <tr>
                    <td align="right">
                        <label for="pseudo">Pseudo:</label>
                    </td>
                    <td>
                        <input type="text" value="<?php if(isset($pseudo)) {echo $pseudo; } ?>" id="pseudo" name ="pseudo" placeholder="Votre pseudo">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail">Mail:</label>
                    </td>
                    <td align="right">
                        <input type="email" value="<?php if(isset($mail)) {echo $mail; } ?>" id="mail"  name ="mail" placeholder="Votre mail">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail2">Confirmation du Mail:</label>
                    </td>
                    <td>
                        <input type="email" value="<?php if(isset($mail2)) {echo $mail2; } ?>" id="mail2"  name ="mail2" placeholder="Confirmez votre mail">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp">Mot de passe:</label>
                    </td>
                    <td>
                        <input type="password" value="" id="mdp"  name ="mdp" placeholder="Votre mot de passe">
                    </td>
                    
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp2">Confirmation du mot de passe:</label>
                    </td>
                    <td>
                        <input type="password" value="" id="mdp2"  name ="mdp2" placeholder="confirmez votre mot de passe">
                    </td> 
                </tr>
                <tr>
                    <td></td>
                    <td align="center">
                        <br>
                        <input type="submit" name="forminscription" value="je m'inscris">
                    </td>
                
                </tr>
            </table>
          
    

            
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