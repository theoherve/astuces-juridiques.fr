<?php
include('includes/config.php');
include('includes/connexion_check.php');

if (!isset($_SESSION['id'])) {
  header('Location: index.php');
}

$id_user = $_SESSION['id'];

$reqAllNotif = $db->prepare('SELECT * FROM notifications WHERE to_id_user=:to_id_user');
$reqAllNotif->bindParam(':to_id_user', $id_user, PDO::PARAM_INT);
$reqAllNotif->execute();
$allNotifs = $reqAllNotif->fetchAll(PDO::FETCH_ASSOC);

foreach ($allNotifs as $allNotif) {
  $reqUpdateNotif = $db->prepare('UPDATE notifications SET is_read=1 WHERE to_id_user=:to_id_user AND id_notification=:id_notification');
  $reqUpdateNotif->bindParam(':id_notification', $allNotif['id_notification'], PDO::PARAM_INT);
  $reqUpdateNotif->bindParam(':to_id_user', $id_user, PDO::PARAM_INT);
  $reqUpdateNotif->execute();
}

$reqAllNotifications = $db->prepare('SELECT * FROM notifications WHERE is_read=0');
$reqAllNotifications->execute();
$allNotifications = $reqAllNotifications->rowCount();
// echo (!empty($allNotifications)) ? "<div class=\"redRound\" id=\"divDisplayNotif\">".$allNotifications."</div>" : "" ;

echo "0";

?>
