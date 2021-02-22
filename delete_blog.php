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
  $del=$db->PREPARE('DELETE FROM documentations WHERE id_documentation=?');
  $del->execute([$id]);


  $imgdocname = "img_blog_".$id;
  $delimgdir = "img/img_blog/".$imgdocname;
  unlink($delimgdir);

  header('location:administration_blog.php');
} else{
  header('location:index.php');
}
 ?>
