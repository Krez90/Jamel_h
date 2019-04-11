<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=jamel_h;charset=utf8','root','');

if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
    if(isset($_GET['idAnnonces'])){

        $query = $bdd->prepare("DELETE FROM annonces WHERE id=?");
        $query->execute($_GET['idAnnonces']);

    }else{
        
        }
};


// header('Location: http://localhost/jamel_h/profil.php');
header("Cache-Control: no-cache, must-revalidate");
exit;
