<?php
include('includes/config.php');
include('includes/connexion_check.php');

$id_article = $_GET['id_article'];
$id=$_GET['id_article'];

if(empty($_SESSION['id']) || !isset($_SESSION['status']) || $_SESSION['status'] <= 2){
	header('Location: index.php');
}

$reqComment = $db->prepare('SELECT * FROM comments WHERE id_article=:id_article');
$reqComment->bindParam(':id_article', $_GET['id_article'], PDO::PARAM_INT);
$reqComment->execute();
$comments=$reqComment->fetchAll(PDO::FETCH_ASSOC);

if(isset($id_article) AND !empty($id_article)){

	$delWarnings = $db->prepare('DELETE FROM warnings WHERE id_article=:id_article');
 	$delWarnings->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $delWarnings->execute();

  $delFavorites = $db->prepare('DELETE FROM favorites WHERE id_article=:id_article');
 	$delFavorites->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $delFavorites->execute();

  $delReactsArticle = $db->prepare('DELETE FROM reacts_articles WHERE id_article=:id_article');
 	$delReactsArticle->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $delReactsArticle->execute();

  $delNotifications = $db->prepare('DELETE FROM notifications WHERE id_article=:id_article');
 	$delNotifications->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $delNotifications->execute();

  foreach($comments as $comment){
    $delCommentsLikes = $db->prepare('DELETE FROM comments_likes WHERE id_comment=:id_comment');
    $delCommentsLikes->bindParam(':id_comment', $comment['id_comment'], PDO::PARAM_INT);
    $delCommentsLikes->execute();
  }

	$delAnswersComments = $db->prepare('DELETE FROM answers_comments WHERE id_article=:id_article');
 	$delAnswersComments->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $delAnswersComments->execute();

  $delComments = $db->prepare('DELETE FROM comments WHERE id_article=:id_article');
 	$delComments->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $delComments->execute();

  $delAstuce = $db->prepare('DELETE FROM articles WHERE id_article=:id_article');
 	$delAstuce->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $delAstuce->execute();

	$img_1_name = "img_astuce_".$id."_1";
	$delimgdir = "img/img_astuces/".$img_1_name;
	unlink($delimgdir);

	$img_2_name = "img_astuce_".$id."_2";
	$delimgdir = "img/img_astuces/".$img_2_name;
	unlink($delimgdir);

	$img_3_name = "img_astuce_".$id."_3";
	$delimgdir = "img/img_astuces/".$img_3_name;
	unlink($delimgdir);

	$img_4_name = "img_astuce_".$id."_4";
	$delimgdir = "img/img_astuces/".$img_4_name;
	unlink($delimgdir);

	$img_5_name = "img_astuce_".$id."_5";
	$delimgdir = "img/img_astuces/".$img_5_name;
	unlink($delimgdir);

	$img_6_name = "img_astuce_".$id."_6";
	$delimgdir = "img/img_astuces/".$img_6_name;
	unlink($delimgdir);

	$img_7_name = "img_astuce_".$id."_7";
	$delimgdir = "img/img_astuces/".$img_7_name;
	unlink($delimgdir);

	$img_8_name = "img_astuce_".$id."_8";
	$delimgdir = "img/img_astuces/".$img_8_name;
	unlink($delimgdir);

	$img_9_name = "img_astuce_".$id."_9";
	$delimgdir = "img/img_astuces/".$img_9_name;
	unlink($delimgdir);

  header('location: administration.php');
}else{
  header('location:index.php');
}
?>
