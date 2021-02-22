<?php
if(!isset($_SESSION['id']) AND isset($_COOKIE['email'],$_COOKIE['password']) AND !empty($_COOKIE['email']) AND !empty($_COOKIE['password'])) {
 $requser = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
 $requser->execute(array($_COOKIE['email'], $_COOKIE['password']));
 $userexist = $requser->rowCount();
 if($userexist == 1)
 {
		$userinfo = $requser->fetch();
		$_SESSION['id']=$userinfo['id_user'];
		$_SESSION['status']=$userinfo['status'];
		$_SESSION['email']=$userinfo['email'];
 }
}
?>
