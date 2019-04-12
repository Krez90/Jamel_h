<?php
require "connect_bdd.php";

$query = $bdd->prepare('SELECT id FROM annonces');

try {
	$query->execute();
} catch (Exception $e) { /** Un genre de if else qui captures des erreurs. On peut ensuite faire un traitement particulier avec ces erreurs *
*/
	echo "Error :" + $e;
	die();
}

if (isset($_GET['idAnnonces']))
{
	$query = $bdd->prepare('DELETE FROM annonces WHERE annonces.id = :monId');

	$query->bindParam(":monId", $_GET['idAnnonces']);

	try {		
		$query->execute();
		header('Location: http://localhost/jamel_h/depotcolis.php');
	} catch (Exception $e) {
		
		echo "Error " . $e;
	}
}