<?php
include "config.php";
  session_start();
  if(isset($_GET['searchString'])){
    $searchString = (String) trim($_GET['searchString']);
    $searchString ='%'.$searchString.'%';


    ////nom prenom avocat
    ////tire des astuces
    ////titre des articles (blog)
    $req = $db->prepare('SELECT id_lawyer,first_name,family_name FROM lawyers WHERE status = 1 AND first_name LIKE :searchString OR family_name LIKE :searchString LIMIT 3');
    $req->bindParam(":searchString", $searchString);
    $req->execute();
    $req = $req->fetchALL();
    ?>
    <div class="researchResultTitle" id="resAvocat">Avocats</div>
    <?php
    if (empty($req)) {
      ?><div class="researchResultZero">zéro resultat trouvé</div><?php
    }else{
      foreach($req as $r){
        ?>
          <div class="researchResult" onclick="location.href='display_one_lawyer.php?idl=<?=$r['id_lawyer']?>'"><a href="display_one_lawyer.php?idl=<?=$r['id_lawyer']?>"><?= $r['first_name'] . " " . $r['family_name'] ?></a></div><?php
      }
    }

    $req2 = $db->prepare('SELECT id_article,objet FROM articles WHERE status = 2 AND objet LIKE :searchString LIMIT 3');
    $req2->bindParam(":searchString", $searchString);
    $req2->execute();
    $req2 = $req2->fetchALL();
    ?>
    <div class="researchResultTitle" id="resAstuces">Astuces</div>
    <?php
    if (empty($req2)) {
      ?><div class="researchResultZero">zéro resultat trouvé</div><?php
    }else{
      foreach($req2 as $r){
        ?>
          <div class="researchResult" onclick="location.href='astuce.php?id_article=<?=$r['id_article']?>'"><a href="astuce.php?id_article=<?=$r['id_article']?>"><?= $r['objet']?></a></div><?php
      }
    }

    $req3 = $db->prepare('SELECT id_documentation,title FROM documentations WHERE title LIKE :searchString OR content LIKE :searchString LIMIT 3');
    $req3->bindParam(":searchString", $searchString);
    $req3->execute();
    $req3 = $req3->fetchALL();
    ?>
    <div class="researchResultTitle" id="resBlog">Blog</div>
    <?php
    if (empty($req3)) {
      ?><div class="researchResultZero">zéro resultat trouvé</div><?php
    }else{
      foreach($req3 as $r){
        ?>
          <div class="researchResult" onclick="location.href='article_blog.php?id_documentation=<?=$r['id_documentation']?>'"><a href="article_blog.php?id_documentation=<?=$r['id_documentation']?>"><?= $r['title']?></a></div><?php
      }
    }
    ?><div class="researchResultTitle" style="height:0.1em;"> </div><?php
  }
?>
