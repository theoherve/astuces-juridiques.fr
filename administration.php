<?php
$title="Administration";
include('includes/head.php');

if($connected!=1 || $_SESSION['status']<1){
header('location:index.php');
}

 ?>

 <!DOCTYPE html>
 <html lang="fr">
   <?php  include('includes/header_publications.php'); ?>
   <body>
    <main>
      <div id="gestion_publication">
        <table class="table">
        <center><h1>Gestion des publications</h1></center>
        <thead>
          <tr>
          <th scope="col">Titre</th>
          <th scope="col">Date de publication</th>
          <th scope="col">Date de création</th>
          <th scope="col">Sous-domaine</th>
          <th scope="col">Rédacteur</th>
          <th scope="col">Statut</th>
          <th scope="col">Supprimer</th>
         </tr>
       </thead>
       <tbody>
       <?php
       $req = $db->PREPARE('SELECT * FROM articles WHERE status = 1 OR status = 2 ORDER BY id_article DESC');
       $req->execute();
      $count=$req->rowCount();
      echo "Total: ".$count;
       $articles = $req->fetchAll(PDO::FETCH_ASSOC);

       foreach ($articles as $article) {  ?>
         <!-- <tr onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $article['id_article'] ?>'">
        -->
        <tr>
        <td onclick="window.location.href='administration_alter_article.php?id=<?php echo $article['id_article'] ?>'"><?php echo $article['objet'] ?></td>
        <td onclick="window.location.href='administration_alter_article.php?id=<?php echo $article['id_article'] ?>'"><?php $date=$article['release_date'];
        echo $date=date('d-m-Y',strtotime($date)); ?></td>
        <td onclick="window.location.href='administration_alter_article.php?id=<?php echo $article['id_article'] ?>'"><?php $date_article=$article['publication_date'];


        echo $date_article=date('d-m-Y',strtotime($date_article)); ?></td>
        <td onclick="window.location.href='administration_alter_article.php?id=<?php echo $article['id_article'] ?>'"><?php
        $reqSubDomain = $db->PREPARE('SELECT name FROM sub_domains WHERE id_sub_domain = :id_sub_domain');
        $reqSubDomain->bindParam(':id_sub_domain', $article['id_sub_domain']);
        $reqSubDomain->execute();
        $sub_domain = $reqSubDomain->fetch();
        echo $sub_domain['name'] ?></td>
        <td onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $article['id_article'] ?>'"><?php
        $reqUser = $db->PREPARE('SELECT pseudo FROM users WHERE id_user = :id_user');
        $reqUser->bindParam(':id_user', $article['id_author']);
        $reqUser->execute();
        $user = $reqUser->fetch();
        echo $user['pseudo'] ?></td>
        <td>
         <?php if ($article['status'] == 1): ?>
           <button type="button" class="btn btn-dark" onclick="window.location.href='change_article_status.php?id_article=<?php echo $article['id_article'] . "&status=" . $article['status']?>'">Invisible</button>
         <?php elseif ($article['status'] == 2): ?>
           <button type="button" class="btn btn-light" onclick="window.location.href='change_article_status.php?id_article=<?php echo $article['id_article'] . "&status=" . $article['status']?>'">Visible</button>
         <?php endif; ?>
         </td>
         <td><button type="button" class="btn btn-danger" onclick="window.location.href='delete_article.php?id_article=<?php echo $article['id_article']?>'">Supprimer</button></td>
       </tr>
         <?php } ?>
         </tbody>
         </table>
       </main>
     <?php include('includes/footer.php'); ?>
   </body>
   <script src="js/modal.js" type="text/javascript"></script>
 </html>
