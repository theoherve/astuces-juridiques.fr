<?php
include('includes/config.php');
include('includes/connexion_check.php');
date_default_timezone_set('Europe/Paris');

$id_article = $_GET['id_article'];

$reqCommentsLikes = $db->prepare('SELECT id_user FROM comments_likes WHERE id_comment=:id_comment');
$reqCommentsLikes->bindParam(':id_comment', $_GET['id_comment'], PDO::PARAM_INT);
$reqCommentsLikes->execute();
$commentsLikes = $reqCommentsLikes->fetchAll(PDO::FETCH_ASSOC);

foreach($commentsLikes as $commentlike){
  $reqPseudoUser = $db->prepare('SELECT pseudo FROM users WHERE id_user=:id_user');
  $reqPseudoUser->bindParam(':id_user', $commentlike['id_user'], PDO::PARAM_INT);
  $reqPseudoUser->execute();
  $pseudoUserLike = $reqPseudoUser->fetch(PDO::FETCH_ASSOC);
  echo "<a href=\"public_profile.php?id_user=". $commentlike['id_user'] ."\"><p>". $pseudoUserLike['pseudo'] ."</p></a>";
}

?>
