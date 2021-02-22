<?php
  include('includes/config.php');

  $id = $_GET['id'];

  $trick = $db->prepare("DELETE FROM articles WHERE id_article = :idArt");
  $trick->bindParam(':idArt', $id);
  $trick->execute();

  header('Location: administration_blog.php');

 ?>
