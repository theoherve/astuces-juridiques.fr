<?php
  include('includes/head.php');
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <body>
    <?php include('includes/header.php'); ?>
    <main>
      <form class="" action="article_post_process.php" method="post">

        <nav id="article_post_nav">
          <input type="text" name="new_article_title" placeholder="Titre">
          <input type="radio" name="article_subdomain" id="Droit civil" checked value="Droit civil">
          <label for="Droit civil">Droit civil</label>
          <input type="radio" name="article_subdomain" id="Droit pénal" value="Droit pénal">
          <label for="Droit pénal">Droit pénal</label>
          <input type="radio" name="article_subdomain" id="Droit administratif" value="Droit administratif">
          <label for="Droit administratif">Droit administratif</label>
          <input type="radio" name="article_subdomain" id="Droit européen" value="Droit européen">
          <label for="Droit européen">Droit européen</label>
          <input type="file" name="picture" form="multipart/form-data">
          <label for="picture">Ajouter une image</label>
          <input type="text" name="article_author" placeholder="Auteur">
        </nav>

        <section>
          <p>
            <input type="text" name="law_article" placeholder="Corps de l'article">
          </p>
          <button type="button" name="Visualiser"></button>
        </section>

      </form>



  </body>
</html>
