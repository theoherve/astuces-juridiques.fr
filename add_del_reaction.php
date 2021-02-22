<?php
include('includes/config.php');
include('includes/connexion_check.php');

if(empty($_SESSION['id'])){
	header('Location: index.php');
}

$id_user = $_SESSION['id'];
$id_article = $_GET['id_article'];
$id_reaction = $_GET['id_reaction'];

$reqReaction = $db->prepare('SELECT * FROM reacts_articles WHERE id_user=:id_user AND id_article=:id_article');
$reqReaction->bindParam(':id_user', $id_user, PDO::PARAM_INT);
$reqReaction->bindParam(':id_article', $id_article, PDO::PARAM_INT);
$reqReaction->execute();
$reaction = $reqReaction->fetch();

if(!empty($_GET['id_reaction']) && !empty($_GET['id_article'])){
  if(empty($reaction)){

		$del=$db->prepare('DELETE FROM reacts_articles WHERE id_user=:id_user AND id_article=:id_article');
    $del->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $del->bindParam(':id_article', $id_article, PDO::PARAM_INT);
    $del->execute();

    $insert=$db->prepare('INSERT INTO reacts_articles (id_user, id_article, id_reaction) VALUES (:id_user, :id_article, :id_reaction)');
    $insert->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $insert->bindParam(':id_article', $id_article, PDO::PARAM_INT);
    $insert->bindParam(':id_reaction', $id_reaction, PDO::PARAM_INT);
    $insert->execute();
  }else{
    $del=$db->prepare('DELETE FROM reacts_articles WHERE id_user=:id_user AND id_article=:id_article AND id_reaction=:id_reaction');
    $del->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $del->bindParam(':id_article', $id_article, PDO::PARAM_INT);
    $del->bindParam(':id_reaction', $id_reaction, PDO::PARAM_INT);
    $del->execute();
		
  }
}

$reqReactions = $db->prepare('SELECT id_react_article FROM reacts_articles WHERE id_article=:id_article  AND id_reaction=:id_reaction');
$reqReactions->bindParam(':id_article', $id_article, PDO::PARAM_INT);
$reqReactions->bindParam(':id_reaction', $id_reaction, PDO::PARAM_INT);
$reqReactions->execute();
$allReactions = $reqReactions->rowCount();

if (empty($allReactions)){
  echo "0";
}else{
  echo $allReactions;
}

?>
