<?php
include('includes/config.php');
include('includes/connexion_check.php');

$id_user=$_GET['id_user'];
$id_who=$_SESSION['id'];
$op=$_GET['action'];

$check=$db->PREPARE('SELECT status FROM users WHERE id_user = ?');
$check->execute([$id_who]);
$v=$check->fetch();

$status=$v[0];

if($status==2 || $status==3){
	$tmp=$db->PREPARE('SELECT status FROM users WHERE id_user= ?');
	$tmp->execute([$id_user]);
	$bruce=$tmp->fetch();
	if($bruce['status']!=3){
		if($op=='del'){

			$delWarnings = $db->prepare('DELETE FROM warnings WHERE id_user=:id_user');
		 	$delWarnings->bindParam(':id_user', $id_user, PDO::PARAM_INT);
		  $delWarnings->execute();

		  $delFavorites = $db->prepare('DELETE FROM favorites WHERE id_user=:id_user');
		 	$delFavorites->bindParam(':id_user', $id_user, PDO::PARAM_INT);
		  $delFavorites->execute();

		  $delReactsArticle = $db->prepare('DELETE FROM reacts_articles WHERE id_user=:id_user');
		 	$delReactsArticle->bindParam(':id_user', $id_user, PDO::PARAM_INT);
		  $delReactsArticle->execute();

		  $delNotifications = $db->prepare('DELETE FROM notifications WHERE id_user=:id_user');
		 	$delNotifications->bindParam(':id_user', $id_user, PDO::PARAM_INT);
		  $delNotifications->execute();

	    $delCommentsLikes = $db->prepare('DELETE FROM comments_likes WHERE id_user=:id_user');
	    $delCommentsLikes->bindParam(':id_user', $id_user, PDO::PARAM_INT);
	    $delCommentsLikes->execute();

			$delAnswersComments = $db->prepare('DELETE FROM answers_comments WHERE id_user=:id_user');
		 	$delAnswersComments->bindParam(':id_user', $id_user, PDO::PARAM_INT);
		  $delAnswersComments->execute();

		  $delComments = $db->prepare('DELETE FROM comments WHERE id_user=:id_user');
		 	$delComments->bindParam(':id_user', $id_user, PDO::PARAM_INT);
		  $delComments->execute();

			$delete=$db->PREPARE('DELETE FROM users WHERE id_user=?');
			$delete->execute(array($id_user));
			session_destroy($id_user);
			
			header('location:administration_users.php');
		}else{
			header('location:administration_users.php');
		}
	}else{
		$erreur="on ne supprime pas Bruce Lee, c est Bruce Lee qui te supprime !";
		?><script>alert('<?php echo($erreur) ?>');
	   document.location.href="administration_users.php";
	  </script><?php
	}
}else{
	header('location:administration_users.php');
}
?>
