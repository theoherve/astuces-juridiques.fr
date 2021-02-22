<?php
include('includes/config.php');
include('includes/connexion_check.php');

$pseudo=$_GET['i'];
$k=$_GET['k'];

$check= $db->PREPARE('SELECT email, id_user FROM users WHERE pseudo = ?');
$check-> execute(array($pseudo));
$info_check = $check->fetch();
if(password_verify($info_check['email'], $k))
{
  $update=$db->PREPARE('UPDATE users SET token=1 WHERE id_user= ?');
  $update->execute(array($info_check['id_user']));
  ?><script>
    document.location.href="index.php"
    </script>
  <?php
} else{
  header('location:index.php');
}

 ?>
