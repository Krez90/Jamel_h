<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=jamel_h;charset=utf8','root','');
 if(isset($_POST['formconnect'])){
     $mailconnect = htmlspecialchars($_POST['mailconnect']);
     $mdpconnect = sha1($_POST['mdpconnect']);
     if(!empty($mailconnect) && !empty($mdpconnect)){
         $requser = $bdd->prepare("SELECT * FROM client WHERE mail = ?  AND password = ?");
         $requser->execute([$mailconnect, $mdpconnect]);
         $userexist = $requser->rowCount();
         if($userexist == 1){
             $userinfo = $requser->fetch();
             $_SESSION['id'] = $userinfo['id'];
             $_SESSION['mail'] = $userexist['mail'];
             header("Location: profil.php?id=".$_SESSION['id']);

         }else{
            $erreur = "Votre mail ou identifiant ne correspondent pas";

         }

     }else{
         $erreur = "Tout les champs doivent être complétées";
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
        <h1>Connexion</h1>
        <br><br>
        <form action="" method="post">
        <input type="text" name = "mailconnect" placeholder = "Mail">
        <input type="password" name = "mdpconnect" placeholder = "Mot de passe">
        <input type="submit" name = "formconnect" value = "Se connecter">
           
        </form><br>
        <?php
        if(isset($erreur)){
            echo $erreur;
        }
        ?>

    </div>

</body>

</html>