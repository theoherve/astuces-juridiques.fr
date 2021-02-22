<?php
include('includes/config.php');
include('includes/connexion_check.php');

if(empty($_SESSION['id']) || !isset($_GET['type']) || !isset($_GET['id_article']) || !isset($_GET['to_id_user']) || !isset($_GET['id_comment'])){
	header('Location: index.php');
}

date_default_timezone_set('Europe/Paris');
$publication_date = gmdate("Y-m-d H:i:s");

$reqPseudo = $db->prepare("SELECT id_user FROM users WHERE pseudo=:to_id_user");
$reqPseudo->bindParam(':to_id_user', $_GET['to_id_user'], PDO::PARAM_STR);
$reqPseudo->execute();
$id_user=$reqPseudo->fetch();

$to_id_user = $id_user['id_user'];

if($_GET['type'] == 'comment'){

  $insert=$db->prepare('INSERT INTO notifications (type, id_user, to_id_user, id_article, id_comment, publication_date, id_answer_comment) VALUES (:type, :id_user, :to_id_user, :id_article, :id_comment, :publication_date, :id_answer_comment)');
  $insert->bindParam(':type', $_GET['type'], PDO::PARAM_STR);
  $insert->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
  $insert->bindParam(':to_id_user', $to_id_user, PDO::PARAM_INT);
  $insert->bindParam(':id_article', $_GET['id_article'], PDO::PARAM_INT);
  $insert->bindParam(':id_comment', $_GET['id_comment'], PDO::PARAM_INT);
  $insert->bindParam(':publication_date', $publication_date);
	$insert->bindParam(':id_comment', $_GET['id_comment'], PDO::PARAM_INT);
	$insert->bindParam(':id_answer_comment', $_GET['id_answer_comment'], PDO::PARAM_INT);
  $insert->execute();
}elseif($_GET['type'] == 'like'){

	$reqCommentsLikes = $db->prepare("SELECT id_comment_like FROM comments_likes WHERE id_comment=:id_comment AND id_user=:id_user");
	$reqCommentsLikes->bindParam(':id_comment', $_GET['id_comment'], PDO::PARAM_INT);
	$reqCommentsLikes->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
	$reqCommentsLikes->execute();
	$allLikes=$reqCommentsLikes->fetch();

	if(!empty($allLikes)){
		$insert=$db->prepare('INSERT INTO notifications (type, id_user, to_id_user, id_article, id_comment, publication_date) VALUES (:type, :id_user, :to_id_user, :id_article, :id_comment, :publication_date)');
	  $insert->bindParam(':type', $_GET['type'], PDO::PARAM_STR);
	  $insert->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
	  $insert->bindParam(':to_id_user', $to_id_user, PDO::PARAM_INT);
	  $insert->bindParam(':id_article', $_GET['id_article'], PDO::PARAM_INT);
	  $insert->bindParam(':id_comment', $_GET['id_comment'], PDO::PARAM_INT);
	  $insert->bindParam(':publication_date', $publication_date);
	  $insert->execute();
	}
}else{
  header('Location: index.php');
}

?>
