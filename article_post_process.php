<?php

if (!empty($_POST['new_article_title']) && isset($_POST['new_article_title'])
&& !empty($_POST['law_article']) && isset($_POST['law_article'])
&& !empty($_POST['article_author']) && isset($_POST['article_author'])
&& !empty($_POST['article_subdomain']) && isset($_POST['article_subdomain'])
&& !empty($_POST['picture']) && isset($_POST['picture'])) {

  $db_article = db->prepare("INSERT INTO articles(title, author, text, domain)
  VALUES ($_POST['new_article_title'], $_POST['article_author'], $_POST['law_article'],
  $_POST['article_subdomain'])")

  foreach ($_FILES['picture'] as $key) {
    $tmp = $_FILES['tmp'];
    $size = $_FILES['size'];
    $type = $_FILES['type'];
    $name = basename($_FILES['picture']['key']);
    $dir = /img_article/$name;
    echo $tmp;
    echo $size;
    echo $type;
    if ($size <= 4000000) {
      if ($type == png || $type == jpg || $type == jpeg || $type == svg) {
        move_uploaded_file($name, $dir);
      }
    }
  }

}else {
  echo "vous devez remplir tous les champs";
}

//header('Location: article_post.php');

 ?>
