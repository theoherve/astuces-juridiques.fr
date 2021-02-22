<?php
include('includes/config.php');
include('includes/connexion_check.php');
date_default_timezone_set('Europe/Paris');

// $id_article = $_GET['id_article'];
$position = 0;

$reqNotifications = $db->prepare('SELECT * FROM notifications WHERE to_id_user=:to_id_user ORDER BY publication_date DESC');
$reqNotifications->bindParam(':to_id_user', $_SESSION['id'], PDO::PARAM_INT);
$reqNotifications->execute();
$notifications = $reqNotifications->fetchAll(PDO::FETCH_ASSOC);

if(empty($notifications)){

  echo "<div name=\"divOneNotif\">";
  echo "<div class=\"divCenterNoNotif\">";
  echo "<span>Vous n'avez aucune</span>";
  echo "<span style=\"font-weight: bold;\">notification</span>";
  echo "</div>";
}else{
  foreach($notifications as $notification){

    $reqUser = $db->prepare('SELECT id_user, pseudo FROM users WHERE id_user=:id_user');
    $reqUser->bindParam(':id_user', $notification['id_user'], PDO::PARAM_INT);
    $reqUser->execute();
    $user = $reqUser->fetch();

    $publication_date = $notification['publication_date'];
    $year = gmdate('Y', strtotime($publication_date));
    $month = gmdate('m', strtotime($publication_date));
    $day = gmdate('d', strtotime($publication_date));
    $hour = gmdate('H', strtotime($publication_date));
    $min = gmdate('i', strtotime($publication_date));
    $seconde = gmdate('s', strtotime($publication_date));
    $nowYear = gmdate('Y');
    $nowMonth = gmdate('m');
    $nowDay = gmdate('d');
    $nowHour = gmdate('H');
    $nowHour-= 2;
    $nowMin = gmdate('i');
    $nowSeconde = date('s');
    $sinceYear =  $nowYear - $year;
    $monthSince = $nowMonth - $month;
    $daySince = $nowDay - $day;
    $hourSince = $nowHour - $hour;
    $minSince = $nowMin - $min;
    $secondeSince = $nowSeconde - $seconde;

    if($notification['type'] == "comment"){
      echo "<div name=\"divOneNotif\" onclick=\"window.location.href='astuce.php?id_article=".$notification['id_article']. "&id_answer_comment=".$notification['id_answer_comment']."'\">";
      echo "<span><a href=\"public_profile.php?id_user=".$user['id_user']."\">" . $user['pseudo'] .  "</a> a répondu à votre <span style=\"font-weight: bold;\">commentaire</span></span>";
      if($sinceYear > 0){
        echo "<div style=\"color: #304771;\">Il y a " . $sinceYear . " ans </div>";
      }elseif($monthSince > 0){
        echo "<div style=\"color: #304771;\">Il y a " . $monthSince . " mois </div>";
      }elseif($daySince > 0){
        echo "<div style=\"color: #304771;\">Il y a " . $daySince . " jours </div>";
      }elseif($hourSince > 0){
        echo "<div style=\"color: #304771;\">Il y a " . $hourSince . " heures </div>";
      }elseif($minSince > 0){
        echo "<div style=\"color: #304771;\">Il y a " . $minSince . " minutes </div>";
      }elseif($secondeSince > 0){
        echo "<div style=\"color: #304771;\">Il y a " . $secondeSince . " secondes </div>";
      }
      echo "</div>";
    }elseif($notification['type'] == "like"){
      echo "<div name=\"divOneNotif\" onclick=\"window.location.href='astuce.php?id_article=".$notification['id_article']."&id_comment=".$notification['id_comment']."'\">";
      echo "<span><a href=\"public_profile.php?id_user=".$user['id_user']."\">" . $user['pseudo'] .  "</a> a aimé votre <span style=\"font-weight: bold;\">commentaire</span></span>";
      if($sinceYear > 0){
        echo "<div style=\"color: #304771;\">Il y a " . $sinceYear . " ans </div>";
      }elseif($monthSince > 0){
        echo "<div style=\"color: #304771;\">Il y a " . $monthSince . " mois </div>";
      }elseif($daySince > 0){
        echo "<div style=\"color: #304771;\">Il y a " . $daySince . " jours </div>";
      }elseif($hourSince > 0){
        echo "<div style=\"color: #304771;\">Il y a " . $hourSince . " heures </div>";
      }elseif($minSince > 0){
        echo "<div style=\"color: #304771;\">Il y a " . $minSince . " minutes </div>";
      }elseif($secondeSince > 0){
        echo "<div style=\"color: #304771;\">Il y a " . $secondeSince . " secondes </div>";
      }
      echo "</div>";
    }else{
      echo "<h1 style=\"color:grey; font-style:italic;\">Une erreur s'est produite, nous travaillons actuellement pour résoudre le problème ;)</h1>";
    }

    $reqIdArticle = $db->prepare('SELECT id_article FROM comments WHERE id_comment=:id_comment');
    $reqIdArticle->bindParam(':id_comment', $notification['id_comment'], PDO::PARAM_INT);
    $reqIdArticle->execute();
    $id_article = $reqIdArticle->fetch();

		$reqLike = $db->prepare('SELECT * FROM comments_likes WHERE id_comment=:id_comment AND id_user=:id_user');
		$reqLike->bindParam(':id_comment', $id_comment, PDO::PARAM_INT);
		$reqLike->bindParam(':id_user', $id_user, PDO::PARAM_INT);
		$reqLike->execute();
		$like = $reqLike->fetch();

    $reqAllLikesUser = $db->prepare('SELECT id_comment_like FROM comments_likes WHERE id_comment=:id_comment AND id_user=:id_user');
		$reqAllLikesUser->bindParam(':id_comment', $notification['id_comment'], PDO::PARAM_INT);
    $reqAllLikesUser->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
		$reqAllLikesUser->execute();
		$allLikesUser = $reqAllLikesUser->rowCount();

		$reqAllLikes = $db->prepare('SELECT id_comment_like FROM comments_likes WHERE id_comment=:id_comment');
		$reqAllLikes->bindParam(':id_comment', $notification['id_comment'], PDO::PARAM_INT);
		$reqAllLikes->execute();
		$allLikes = $reqAllLikes->rowCount();
  }
}

?>
