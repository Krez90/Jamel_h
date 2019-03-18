<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=jamel_h','root','');

if(isset($_POST['inscription'])){
    
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1 ($_POST['mdp2']);
        if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['mail2']) && !empty($_POST['mdp']) && !empty($_POST['mdp2'])){

        $nomlength = strlen($nom);
        if($nomlength <= 255){

        }else{
            $erreur = "Vous avez dépasser la limite du nombre de caractère autorisé !";
        }

        $prenomlength = strlen($prenom);
        if($prenomlength <= 255){

        }else{
            $erreur = "Vous avez dépasser la limite du nombre de caractère autorisé !";
        }
        
        if($mail == $mail2){
            
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){

        }
        }else{
            $erreur = "Vos adresses mails ne correspondent pas !";
        }
        $reqmail = $bdd->prepare("SELECT * FROM client WHERE mail = ?");
        $reqmail->execute([$mail]);
        $mailexist = $reqmail->rowCount();
        if($mailexist == 0){

        if($mdp == $mdp2){
            $insertmbr = $bdd->prepare("INSERT INTO client (nom, prenom, mail, password) VALUES (?,?,?,?)");
            $insertmbr->execute([$nom, $prenom, $mail, $mdp]);
            $erreur = "Votre compte a bien été crée";
            

        }else{
        $erreur = "Vos mots de passes ne correspondent pas !";
        }

        }else{
        $erreur = "Adresse mail déjà utilisée ! ";
        }
    }
        else{
            $erreur = "Tous les champs doivent être complétés";
        }
    
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Jamel_h</title>
</head>

<body>
    <div>
        <h1>Inscription</h1>
        <br><br>
        <form action="" method="post">
            <table>
                <tr>
                    <td class="td">
                        <label for="nom">Nom :</label>
                    </td>
                    <td>
                        <input type="text" name="nom" id="nom" placeholder="Votre nom" value="<?php if(isset($nom)) {echo $nom;}?>">
                    </td>
                </tr>
                <tr>
                    <td class="td">
                        <label for="prenom">Prénom :</label>
                    </td>
                    <td>
                        <input type="text" name="prenom" id="prenom" placeholder="Votre prénom" value="<?php if(isset($prenom)) {echo $prenom;}?>">
                    </td>
                </tr>
                <tr>
                    <td class="td">
                        <label for="mail">Mail :</label>
                    </td>
                    <td>
                        <input type="email" name="mail" id="mail" placeholder="Votre mail" value="<?php if(isset($mail)) {echo $mail;}?>">
                    </td>
                </tr>
                <tr>
                    <td class="td">
                        <label for="mail2">Confirmation du Mail :</label>
                    </td>
                    <td>
                        <input type="email" name="mail2" id="mail2" placeholder="Confirmation du Mail" value="<?php if(isset($mail2)) {echo $mail2;}?>">
                    </td>
                </tr>
                <tr>
                    <td class="td">
                        <label for="mdp">Mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" name="mdp" id="mdp" placeholder="Mot de passe">
                    </td>
                </tr>
                <tr>
                    <td class="td">
                        <label for="mdp2">Confirmation du mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" name="mdp2" id="mdp2" placeholder="Confirmation du mot de passe">
                    </td>
                </tr>

                <tr>
                    <td class="button">
                        <input type="submit" value="Inscription" name="inscription">
                    </td>
                </tr>
            </table>
        </form><br>
        <?php
        if(isset($erreur)){
            echo $erreur;
        ?>
        <br>
        <a href="connexion.php"> Me connecter</a>
        <?php
        }
        ?>
    </div>

</body>

</html>