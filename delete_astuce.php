<?php
include('includes/config.php');
include('includes/connexion_check.php');

if($connected != 1 || $_SESSION['status'] <= 1){
  header('location:index.php');
}

if(isset($_GET['id'])){
  $id_article=$_GET['id'];
}

$reqComment = $db->prepare('SELECT * FROM comments WHERE id_article=:id_article');
$reqComment->bindParam(':id_article', $_GET['id_article'], PDO::PARAM_INT);
$reqComment->execute();
$comments=$reqComment->fetchAll(PDO::FETCH_ASSOC);

if(isset($id_article) AND !empty($id_article)){

  $delFavorites = $db->prepare('DELETE FROM favorites WHERE id_article=:id_article');
 	$delFavorites->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $delFavorites->execute();

  $delReactsArticle = $db->prepare('DELETE FROM reacts_articles WHERE id_article=:id_article');
 	$delReactsArticle->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $delReactsArticle->execute();

  $delNotifications = $db->prepare('DELETE FROM notifications WHERE id_article=:id_article');
 	$delNotifications->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $delNotifications->execute();

  foreach ($comments as $comment) {
    $delCommentsLikes = $db->prepare('DELETE FROM comments_likes WHERE id_comment=:id_comment');
    $delCommentsLikes->bindParam(':id_comment', $comment['id_comment'], PDO::PARAM_INT);
    $delCommentsLikes->execute();
  }

  $delComments = $db->prepare('DELETE FROM comments WHERE id_article=:id_article');
 	$delComments->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $delComments->execute();

  $delAstuce = $db->prepare('DELETE FROM articles WHERE id_article=:id_article');
 	$delAstuce->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $delAstuce->execute();

  header('location:administration_tips.php');
} else{
  header('location:index.php');
}
?>
