<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=jamel_h;charset=utf8','root','');

if(isset($_POST['inscription'])){
    
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail = strtolower($mail);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mail2 = strtolower($mail2);
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    
        if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['mail2']) && !empty($_POST['mdp'])){

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
/////////////////////////////////////Vérification des doublons//////////////////////////////////////
        $reqmail = $bdd->prepare("SELECT * FROM clients WHERE mail = ?");
        $reqmail->execute([$mail]);
        $mailexist = $reqmail->rowCount();
        if($mailexist == 0){

        
            $insertmbr = $bdd->prepare("INSERT INTO clients (nom, prenom, mail, password) VALUES (?,?,?,?)");
            $insertmbr->execute([$nom, $prenom, $mail, $mdp]);
            $erreur = "Votre compte a bien été crée";
            
        }else{
        $erreur = "Adresse mail déjà utilisée ! ";
        }
    }
        else{
            $erreur = "Tous les champs doivent être complétés";
        }
    
}
?>
<!doctype html>

<html class="no-js" lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
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
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control" placeholder="">
                        </div>

                        <div class="form-group">
                            <label>Prenom</label>
                            <input type="text" name="prenom" class="form-control" placeholder="">
                        </div>

                        <div class="form-group">
                            <label>Adresse Mail</label>
                            <input type="email" name="mail" class="form-control" placeholder="">
                        </div>

                        <div class="form-group">
                            <label>Confirmation du Mail</label>
                            <input type="email" name="mail2" class="form-control" placeholder="">
                        </div>

                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" name="mdp" class="form-control" placeholder="">
                        </div>
                        <?php
        if(isset($erreur)){
            echo $erreur;
        } 
        ?><br>
                                    <div class="checkbox">
                                        <label>
                                <input type="checkbox"> Accepter les termes et la politique
                            </label>
                                    </div>
                                    <button type="submit" name="inscription" class="btn btn-primary btn-flat m-b-30 m-t-30">Inscrivez-vous</button>
                                    <div class="social-login-content">

                                    </div>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Vous avez déjà un compte ? <a href="page-login.php"> Se connecter</a></p>

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
