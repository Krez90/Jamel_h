<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=jamel_h;charset=utf8','root','');

if(isset($_SESSION['id']) && !empty($_SESSION['id'])) :
    
    $id = $_GET['idAnnonces'];

    $query = $bdd->prepare("DELETE FROM annonces where id=?");
    $query->execute([$id]);


endif;

header();
header("Cache-Control: no-cache, must-revalidate");
exit;