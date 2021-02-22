<?php
include('includes/head.php');
include('includes/config.php');

if($connected != 1 || $_SESSION['status'] <= 1){
header('location:index.php');
}


if(isset($_GET['id'])){
  $id=$_GET['id'];
}

if(isset($id) AND !empty($id)){
  $del=$db->PREPARE('DELETE FROM warnings WHERE id_warning=?');
  $del->execute([$id]);
  header('location:administration_tips.php');
} else{
  header('location:index.php');
}
 ?>
