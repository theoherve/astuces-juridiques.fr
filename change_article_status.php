<?php
include('includes/config.php');
include('includes/connexion_check.php');

$status = $_GET['status'];
$id_article = $_GET['id_article'];

if(empty($_SESSION['id']) || !isset($_SESSION['status']) || $_SESSION['status'] <= 2){
	header('Location: index.php');
}
if(!empty($_GET['status']) && !empty($_GET['id_article'])){
  if($status != 1 && $status != 2){
    header('Location: index.php');
  }else{
    if($status == 1){
      $status = 2;
      $change=$db->prepare('UPDATE articles SET status=:status WHERE id_article=:id_article');
      $change->bindParam(':status', $status, PDO::PARAM_INT);
      $change->bindParam(':id_article', $id_article, PDO::PARAM_INT);
      $change->execute();

      header('Location: administration.php');
    }else{
      $status = 1;
      $change=$db->prepare('UPDATE articles SET status=:status WHERE id_article=:id_article');
      $change->bindParam(':status', $status, PDO::PARAM_INT);
      $change->bindParam(':id_article', $id_article, PDO::PARAM_INT);
      $change->execute();

      header('Location: administration.php');
    }
  }
}

?>
