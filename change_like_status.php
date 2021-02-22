<?php
include('includes/config.php');
include('includes/connexion_check.php');

if(empty($_SESSION['id'])){
	header('Location: index.php');
}

$id_user = $_SESSION['id'];
$id_comment = $_GET['id_comment'];
$type = 'like';

$reqLike = $db->prepare('SELECT * FROM comments_likes WHERE id_comment=:id_comment AND id_user=:id_user');
$reqLike->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);
$reqLike->bindParam(':id_user', $id_user, PDO::PARAM_INT);
$reqLike->execute();
$like = $reqLike->fetch();

$reqAllLikes = $db->prepare('SELECT id_comment_like FROM comments_likes WHERE id_comment=:id_comment');
$reqAllLikes->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);
$reqAllLikes->execute();
$allLikes = $reqAllLikes->rowCount();

if(!empty($_GET['id_comment'])){
  if(empty($like)){
    $insert=$db->prepare('INSERT INTO comments_likes (id_comment, id_user) VALUES (:id_comment, :id_user)');
    $insert->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);
    $insert->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $insert->execute();

    echo '<img src="pictures/likeLeftBlue.png" alt="Like" style="cursor: pointer;">';
    // echo " " . $allLikes;
  }else{

    $delLike=$db->prepare('DELETE FROM comments_likes WHERE id_comment=:id_comment AND id_user=:id_user');
    $delLike->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);
    $delLike->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $delLike->execute();

		$delNotif=$db->prepare('DELETE FROM notifications WHERE id_comment=:id_comment AND id_user=:id_user AND type=:type');
		$delNotif->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);
		$delNotif->bindParam(':id_user', $id_user, PDO::PARAM_INT);
		$delNotif->bindParam(':type', $type, PDO::PARAM_STR);
		$delNotif->execute();
		
    echo '<img src="pictures/likeLeftGrey.png" alt="Like" style="cursor: pointer;">';
    // echo " " . $allLikes;
  }
}

echo " " . $allLikes;
?>
