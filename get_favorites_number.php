<?php
include('includes/config.php');
include('includes/connexion_check.php');

if(empty($_SESSION['id'])){
	header('Location: index.php');
}

$reqAllFavorites = $db->prepare('SELECT * FROM favorites WHERE id_user=:id_user');
$reqAllFavorites->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
$reqAllFavorites->execute();
$allFavorites = $reqAllFavorites->rowCount();

echo "Mes favoris (".$allFavorites.")";

?>
