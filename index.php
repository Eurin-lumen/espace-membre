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
                        <input type="text" value="" id="pseudo" name ="pseudo" placeholder="Votre pseudo">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail">Mail:</label>
                    </td>
                    <td align="right">
                        <input type="email" value="" id="mail"  name ="mail" placeholder="Votre mail">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail2">Confirmation du Mail:</label>
                    </td>
                    <td>
                        <input type="email" value="" id="mail2"  name ="mail2" placeholder="Confirmez votre mail">
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
                        <input type="submit" value="je m'inscris">
                    </td>
                
                </tr>
            </table>
          
    

            
        </form>

    </div>
</body>

</html>