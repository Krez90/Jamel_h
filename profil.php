<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=jamel_h','root','');
 if(isset($_GET['id']) && $_GET['id'] > 0){
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare("SELECT * FROM client WHERE id = ?");
    $requser->execute([$getid]);
    $userinfo = $requser->fetch();
    
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
        <h1>Profil</h1>
        <?php echo $userinfo['nom'];?><br>
        <?php echo $userinfo['prenom'];?><br>
        <?php echo $userinfo['mail'];?>
        <br><br>


        <?php
        if(isset($_SESSION['id']) && $userinfo['id'] == $_SESSION['id']){
        ?>
        <a href = "editionprofil.php"> Modifier votre profil</a>
        <a href = "deconnexion.php"> Se déconnecter</a> 
        <?php  
        }

        ?>

    </div>

</body>

</html>
<?php
}else{

}
?>
