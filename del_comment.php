<?php
include('includes/config.php');
include('includes/connexion_check.php');

$id_article = $_GET['id_article'];

if(empty($_GET['id_article'])){
  header('Location: index.php');
}else{

	// $reqComment = $db->prepare('SELECT * FROM comments WHERE id_article=:id_article');
	// $reqComment->bindParam(':id_article', $_GET['id_article'], PDO::PARAM_INT);
	// $reqComment->execute();
	// $comment=$reqComment->fetch(PDO::FETCH_ASSOC);

  $delNotifications = $db->prepare('DELETE FROM notifications WHERE id_comment=:id_comment');
	$delNotifications->bindParam(':id_comment', $_GET['id_comment'], PDO::PARAM_INT);
  $delNotifications->execute();

	$delLikes = $db->prepare('DELETE FROM comments_likes WHERE id_comment=:id_comment');
	$delLikes->bindParam(':id_comment', $_GET['id_comment'], PDO::PARAM_INT);
  $delLikes->execute();

	$delComment = $db->prepare('DELETE FROM comments WHERE id_comment=:id_comment AND id_article=:id_article');
	$delComment->bindParam(':id_comment', $_GET['id_comment'], PDO::PARAM_INT);
  $delComment->bindParam(':id_article', $_GET['id_article'], PDO::PARAM_INT);
  $delComment->execute();

  header('Location: /administration.php');
}
?>
