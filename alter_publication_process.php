<?php
include('includes/config.php');

$id=$_GET['id'];
if(!empty($_GET['id'] AND isset($_GET['id'])))
{
  $id=$_GET['id'];


  if(!empty($_POST['objet']))
  {
    $update=$db->PREPARE('UPDATE articles SET  objet=? WHERE id_article=?');
    $update->execute([$_POST['objet'],$id]);
  }
  if(!empty($_POST['id_sub_domain']))
  {
    $update=$db->PREPARE('UPDATE articles SET  id_sub_domain=? WHERE id_article=?');
    $update->execute([$_POST['id_sub_domain'],$id]);
  }
  if(!empty($_POST['the_tip']))
  {
    $update=$db->PREPARE('UPDATE articles SET  content=? WHERE id_article=?');
    $update->execute([$_POST['the_tip'],$id]);
  }
  if(!empty($_POST['url']))
  {
    $update=$db->PREPARE('UPDATE articles SET  url=? WHERE id_article=?');
    $update->execute([$_POST['url'],$id]);
  }
  if(!empty($_FILES['picture1']['name']))
  {
    $img_1_name = "img_astuce_".$id."_1";
    $uploaddir = "img/img_astuces/".$img_1_name;
    $delimgdir = "img/img_astuces/".$img_1_name;
    $filetmpname = $_FILES['picture1']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
  }
  if(!empty($_FILES['picture2']['name']))
  {
    $img_2_name = "img_astuce_".$id."_2";
    $uploaddir = "img/img_astuces/".$img_2_name;
    $delimgdir = "img/img_astuces/".$img_2_name;
    $filetmpname = $_FILES['picture2']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
  }
  if(!empty($_FILES['picture3']['name']))
  {
    $img_3_name = "img_astuce_".$id."_3";
    $uploaddir = "img/img_astuces/".$img_3_name;
    $delimgdir = "img/img_astuces/".$img_3_name;
    $filetmpname = $_FILES['picture3']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
  }
  if(!empty($_FILES['picture4']['name']))
  {
    $img_4_name = "img_astuce_".$id."_4";
    $uploaddir = "img/img_astuces/".$img_4_name;
    $delimgdir = "img/img_astuces/".$img_4_name;
    $filetmpname = $_FILES['picture4']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
  }
  if(!empty($_FILES['picture5']['name']))
  {
    $img_5_name = "img_astuce_".$id."_5";
    $uploaddir = "img/img_astuces/".$img_5_name;
    $delimgdir = "img/img_astuces/".$img_5_name;
    $filetmpname = $_FILES['picture5']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
  }
  if(!empty($_FILES['picture6']['name']))
  {
    $img_6_name = "img_astuce_".$id."_6";
    $uploaddir = "img/img_astuces/".$img_6_name;
    $delimgdir = "img/img_astuces/".$img_6_name;
    $filetmpname = $_FILES['picture6']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
  }
  if(!empty($_FILES['picture7']['name']))
  {
    $img_7_name = "img_astuce_".$id."_7";
    $uploaddir = "img/img_astuces/".$img_7_name;
    $delimgdir = "img/img_astuces/".$img_7_name;
    $filetmpname = $_FILES['picture7']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
  }
  if(!empty($_FILES['picture8']['name']))
  {
    $img_8_name = "img_astuce_".$id."_8";
    $uploaddir = "img/img_astuces/".$img_8_name;
    $delimgdir = "img/img_astuces/".$img_8_name;
    $filetmpname = $_FILES['picture8']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
  }
  if(!empty($_FILES['picture9']['name']))
  {
    $img_9_name = "img_astuce_".$id."_9";
    $uploaddir = "img/img_astuces/".$img_9_name;
    $delimgdir = "img/img_astuces/".$img_9_name;
    $filetmpname = $_FILES['picture9']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
  }

  $update=$db->PREPARE('UPDATE articles SET status= 1 WHERE id_article=?');
  $update->execute([$id]);
  header('location:previsu_astuce.php?id_astuce='.$id);
} else{
  header('location:index.php');
}



 ?>
