<?php
include('includes/config.php');
include('includes/connexion_check.php');

if(empty($_SESSION['id'])){
	header('Location: index.php');
}

function filterComment(string $comment){
	preg_replace('#(<script>)#i', '&lt;script&gt;', $comment);
	preg_replace('#(</script>)#i', '&lt;/script&gt;', $comment);
	preg_replace('#(<style>)#i', '&lt;style&gt;', $comment);
	preg_replace('#(</style>)#i', '&lt;/style&gt;', $comment);
	preg_replace('#(<object>)#i', '&lt;object&gt;', $comment);
	preg_replace('#(</object>)#i', '&lt;/object&gt;', $comment);
	preg_replace('#(<frame>)#i', '&lt;frame&gt;', $comment);
	preg_replace('#(</frame>)#i', '&lt;/frame&gt;', $comment);
	preg_replace('#(<img>)#i', '&lt;img&gt;', $comment);
	preg_replace('#(</img>)#i', '&lt;/img&gt;', $comment);
	preg_replace('#(<frameset>)#i', '&lt;frameset&gt;', $comment);
	preg_replace('#(</frameset>)#i', '&lt;/frameset&gt;', $comment);
	preg_replace('#(<iframe>)#i', '&lt;iframe&gt;', $comment);
	preg_replace('#(</iframe>)#i', '&lt;/iframe&gt;', $comment);
	preg_replace('#(<video>)#i', '&lt;video&gt;', $comment);
	preg_replace('#(</video>)#i', '&lt;/video&gt;', $comment);
	preg_replace('#(<audio>)#i', '&lt;audio&gt;', $comment);
	preg_replace('#(</audio>)#i', '&lt;/audio&gt;', $comment);
	preg_replace('#(<button>)#i', '&lt;button&gt;', $comment);
	preg_replace('#(</button>)#i', '&lt;/button&gt;', $comment);
	preg_replace('#(<source>)#i', '&lt;source&gt;', $comment);
	return $comment;
}

$id_user = $_SESSION['id'];
$id_article = $_POST['id_article'];
date_default_timezone_set('Europe/Paris');
$publication_date = gmdate("Y-m-d H:i:s");
$comment = filterComment($_POST['comment']);
$id_comment = $_GET['id_comment'];

$insertAnswerComment = $db->prepare('INSERT INTO answers_comments (content, publication_date, id_user, id_article, id_comment) VALUES (:content, :publication_date, :id_user, :id_article, :id_comment)');
$insertAnswerComment->bindParam(':content', $comment, PDO::PARAM_STR);
$insertAnswerComment->bindParam(':publication_date', $publication_date);
$insertAnswerComment->bindParam(':id_user', $id_user, PDO::PARAM_INT);
$insertAnswerComment->bindParam(':id_article', $id_article, PDO::PARAM_INT);
$insertAnswerComment->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);
$insertAnswerComment->execute();

$lastInsertId = $db->lastInsertId();

if($_GET['type'] == 'comment'){
	$reqPseudo = $db->prepare("SELECT id_user FROM users WHERE pseudo=:to_id_user");
	$reqPseudo->bindParam(':to_id_user', $_GET['to_id_user'], PDO::PARAM_STR);
	$reqPseudo->execute();
	$id_user=$reqPseudo->fetch();
	$to_id_user = $id_user['id_user'];
	date_default_timezone_set('Europe/Paris');
	$publication_date = gmdate("Y-m-d H:i:s");

  $insertNotif=$db->prepare('INSERT INTO notifications (type, id_user, to_id_user, id_article, id_comment, publication_date, id_answer_comment) VALUES (:type, :id_user, :to_id_user, :id_article, :id_comment, :publication_date, :id_answer_comment)');
  $insertNotif->bindParam(':type', $_GET['type'], PDO::PARAM_STR);
  $insertNotif->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
  $insertNotif->bindParam(':to_id_user', $to_id_user, PDO::PARAM_INT);
  $insertNotif->bindParam(':id_article', $id_article, PDO::PARAM_INT);
  $insertNotif->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);
  $insertNotif->bindParam(':publication_date', $publication_date);
	$insertNotif->bindParam(':id_answer_comment', $lastInsertId, PDO::PARAM_INT);
  $insertNotif->execute();
	print_r($insert->debugDumpParams());
	print_r($insert->erronInfo());
}else{
	header('location: /');
}
?>
