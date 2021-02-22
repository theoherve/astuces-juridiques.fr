<?php
include('includes/config.php');
$id=$_GET['id'];
if(!empty($_GET['id'] AND isset($_GET['id'])))
{
  $id=$_GET['id'];
  if(!empty($_POST['title']))
  {
    $update=$db->PREPARE('UPDATE documentations SET  title=? WHERE id_documentation=?');
    $update->execute([$_POST['title'],$id]);
  }
  if(!empty($_POST['sub_title']))
  {
    $update=$db->PREPARE('UPDATE documentations SET  sub_title=? WHERE id_documentation=?');
    $update->execute([$_POST['sub_title'],$id]);
  }
  if(!empty($_POST['content']))
  {
    $update=$db->PREPARE('UPDATE documentations SET  content=? WHERE id_documentation=?');
    $update->execute([$_POST['content'],$id]);
  }

  if(!empty($_FILES['miniature']['name']))
  {
    $imgdocname = "img_blog_".$id;
    $uploaddir = "img/img_blog/".$imgdocname;
    $delimgdir = "img/img_blog/".$imgdocname;
    $filetmpname = $_FILES['miniature']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
  }
  header('location:administration_blog.php');
} else{
  header('location:index.php');
}



 ?>
