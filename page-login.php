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


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jamel_h</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST">
                        <div class="form-group">
                            <label>Adresse Email</label>
                            <input type="email" name = "mailconnect" class="form-control" placeholder="Email">
                        </div>
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input type="password" name = "mdpconnect" class="form-control" placeholder="Password">
                        </div>
                        <?php
        if(isset($erreur)){
            echo $erreur;
        }
        ?><br>
                                <div class="checkbox">
                                    <label>
                                <input type="checkbox"> Souviens-toi de moi
                            </label>
                                    <label class="pull-right">
                                <a href="#">Mot de passe oublié ?</a>
                            </label>

                                </div>
                                <button type="submit" name = "formconnect"  class="btn btn-success btn-flat m-b-30 m-t-30">Se connecter</button>

                                <div class="register-link m-t-15 text-center">
                                    <p>Vous n'avez pas de compte ? <a href="index.php"> Inscrivez-vous ici</a></p>

                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>