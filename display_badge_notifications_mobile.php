<?php
include('includes/config.php');
include('includes/connexion_check.php');

if(empty($_SESSION['id'])){
	header('Location: index.php');
}

$reqAllNotifications = $db->prepare('SELECT * FROM notifications WHERE is_read=0 AND to_id_user=:to_id_user LIMIT 20');
$reqAllNotifications->bindParam(':to_id_user', $_SESSION['id'], PDO::PARAM_INT);
$reqAllNotifications->execute();
$allNotifications = $reqAllNotifications->rowCount();

echo (!empty($allNotifications)) ? "<div class=\"redRound\" id=\"divDisplayNotif\" onclick=\"openCloseNotificationMobile()\" class=\"dropbtn\">".$allNotifications."</div>" : "" ;
echo "<a onclick=\"openCloseNotificationMobile()\"><img src=\"pictures/nav/notification.svg\" id=\"imgHeader1\" class=\"dropbtn\" data-number=".$allNotifications."></a>";

?>
