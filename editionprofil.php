<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=jamel_h','root','');
//////////////////////////Si il est pas connecter, pas de profil à modifier////////////////
 if(isset($_SESSION['id'])){

     $requser = $bdd->prepare("SELECT * FROM client WHERE id = ?");
     $requser->execute([$_SESSION['id']]);
     $user = $requser->fetch();
//////////////Modification du profil de l'utilisateur dans la base de donnée NOM//////////////////
     if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom']){
         $newnom = htmlspecialchars($_POST['newnom']);
         $insertnom = $bdd->prepare("UPDATE client SET nom = ? WHERE id = ?");
         $insertnom->execute([$newnom, $_SESSION['id']]);
         $erreur = "Votre profil à bien été mise à jour";
 ////////////////////////On le redirige vers son profil//////////////////////////////////////
        //  header("Location: profil.php?id=".$_SESSION['id']);
     }
////////////////////////Modification du Prénom//////////////////////////////////////
     if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom']){
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertprenom = $bdd->prepare("UPDATE client SET prenom = ? WHERE id = ?");
        $insertprenom->execute([$newprenom, $_SESSION['id']]);
        $erreur = "Votre profil à bien été mise à jour";

    }
////////////////////////Modification du Mail//////////////////////////////////////
    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']){
        $newmail = htmlspecialchars($_POST['newmail']);
        $newmail = strtolower($newmail);
        $reqmail = $bdd->prepare("SELECT * FROM client WHERE mail = ?");
        $reqmail->execute([$newmail]);
        $mailexist = $reqmail->rowCount();
        if($mailexist == 0){
            $insertmail = $bdd->prepare("UPDATE client SET mail = ? WHERE id = ?");
            $insertmail->execute([$newmail, $_SESSION['id']]);
            $erreur = "Votre profil à bien été mise à jour";
        }else{
            $erreur = "Adresse mail déjà utilisée ! ";
        }

    }
////////////////////////Modification du mot de passe//////////////////////////////////////
if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])){
    $mdp1 = sha1($_POST['newmdp1']);
    $mdp2 = sha1($_POST['newmdp2']);
    
    if($mdp1 == $mdp2){
        $insertmdp = $bdd->prepare("UPDATE client SET password = ? WHERE id = ?");
        $insertmdp->execute([$mdp1, $_SESSION['id']]);
        $erreur = "Votre profil à bien été mise à jour";
          
    }
    else{
        $erreur = "Vos mots de passes ne correspondent pas";
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
        <h1>Edition du Profil</h1>
        <form method="POST" action="">
        <label>Nom</label>
            <input type="text" name="newnom" placeholder="Nom" value="<?php echo $user['nom']?>"><br>

            <label>Prénom</label>
            <input type="text" name="newprenom" placeholder="Prenom" value="<?php echo $user['prenom']?>"><br>

            <label>Email</label>
            <input type="email" name="newmail" placeholder="Email" value="<?php echo $user['mail']?>"><br>

            <label>Mot de passe</label>
            <input type="password" name="newmdp1" placeholder="Mot de passe"><br>
            
            <label>Confirmation de passe</label>
            <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe"><br>

            <input type="submit" value="Enregistrer"><br>
        </form>
        <?php
        if(isset($erreur)){echo $erreur;}
        ?>
    </div>

</body>

</html>
<?php
}
else{
    header("Location: connexion.php");
}
?>
