<?php
include('includes/config.php');
include('includes/connexion_check.php');

if(empty($_SESSION['id'])){
	header('Location: index.php');
}

$id_user = $_GET['id_user'];
$id_article = $_GET['id_article'];

$reqFavorites = $db->prepare('SELECT * FROM favorites WHERE id_article=:id_article AND id_user=:id_user');
$reqFavorites->bindParam(':id_article', $id_article, PDO::PARAM_INT);
$reqFavorites->bindParam(':id_user', $id_user, PDO::PARAM_INT);
$reqFavorites->execute();
$favorite = $reqFavorites->fetch();

if(!empty($_GET['id_user']) && !empty($_GET['id_article'])){
  if(empty($favorite)){

    $insert=$db->prepare('INSERT INTO favorites (id_article, id_user) VALUES (:id_article, :id_user)');
    $insert->bindParam(':id_article', $id_article, PDO::PARAM_INT);
    $insert->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $insert->execute();

    echo '<img src="pictures/favoris_done.png" alt="Favoris" style="cursor: pointer;">';
  }else{

    $del=$db->prepare('DELETE FROM favorites WHERE id_article=:id_article AND id_user=:id_user');
    $del->bindParam(':id_article', $id_article, PDO::PARAM_INT);
    $del->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $del->execute();

    echo '<img src="pictures/favoris.png" alt="Favoris" style="cursor: pointer;">';
  }
}
?>
