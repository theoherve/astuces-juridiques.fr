<?php
$title="Administration";
include('includes/head.php');

if($connected!=1 || $_SESSION['status']<=2){
header('location:index.php');
}
?>

<!DOCTYPE html>
<html>
<?php ?>
<body>
  <?php include('includes/header_publications.php');
$req=$db->PREPARE('SELECT * FROM articles WHERE id_article=?');
$req->execute([$_GET['id']]);
WHILE($up=$req->fetch()){
   ?>
  <main>
    <form method="post" action="alter_publication_process.php?id=<?php echo $_GET['id'] ?>" class="formPublications" enctype="multipart/form-data">
      <div class="form-group">
        <label for="objet">Titre :</label>
        <input type="text" name="objet" class="form-control" id="objet" placeholder="<?php echo $up['objet'] ?>">
      </div>

      <div class="form-group">
        <label for="sub_domains">Le sous-domaine</label>
        <select class="form-control form-control-sm" name="id_sub_domain" id="sub_domains" >
        <option value=""><?php
          $whatdom=$db->PREPARE('SELECT name from sub_domains where id_sub_domain=?');
          $whatdom->execute([$up['id_sub_domain']]);
          $thedom=$whatdom->fetch();
          echo $thedom['name'];
         ?> </option>
          <?php
          $req = $db->query('SELECT * FROM sub_domains');
          $opts = $req->fetchAll(PDO::FETCH_ASSOC);
          foreach ($opts as $sub_domain):?>
          <option value="<?php echo $sub_domain['id_sub_domain'];?>"><?php echo $sub_domain['name']; ?></option>
          <?php endforeach;?>
        </select>
      </div>

      <div class="form-group">
        <label for="the_tip">L'astuce juridique :</label>
        <div class="form-group" id="the_tip" style="height: 100%;"><?php echo $up['content'] ?></div>
        <textarea type="text" name="the_tip" style="display: none;" id="inputAstuce"></textarea>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6" style="display: inline-block;">
          <label for="suggest">Proposé par :</label>
          <input type="text" placeholder="<?php

          $reqauthor=$db->PREPARE('SELECT first_name, family_name FROM users WHERE id_user=?');
          $reqauthor->execute([$up['id_author']]);
          $auteur=$reqauthor->fetch();
          echo $auteur['family_name']." ".$auteur['first_name'];
          ?>" name="suggest" class="form-control" id="suggest">
        </div>
        <div class="form-group col-md-6" style="display: inline-block;">
          <label for="url">URL :</label>
          <input type="text" name="url" placeholder="<?php echo $up['url'] ?>" class="form-control" id="url">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group" style="display: inline-block;">
          <label for="picture1">Photo n°1</label>
          <small>(Si nécessaire)</small>
          <input type="file" name="picture1" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="picture1" >
        </div>
        <div class="form-group" style="display: inline-block;">
          <label for="picture2">Photo n°2</label>
          <small>(Si nécessaire)</small>
          <input type="file" name="picture2" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="picture2">
        </div>
        <div class="form-group" style="display: inline-block;">
          <label for="picture3">Photo n°3</label>
          <small>(Si nécessaire)</small>
          <input type="file" name="picture3" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="picture3">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group" style="display: inline-block;">
          <label for="picture1">Photo n°4</label>
          <small>(Si nécessaire)</small>
          <input type="file" name="picture4" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="picture4" >
        </div>
        <div class="form-group" style="display: inline-block;">
          <label for="picture2">Photo n°5</label>
          <small>(Si nécessaire)</small>
          <input type="file" name="picture5" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="picture5">
        </div>
        <div class="form-group" style="display: inline-block;">
          <label for="picture3">Photo n°6</label>
          <small>(Si nécessaire)</small>
          <input type="file" name="picture6" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="picture6">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group" style="display: inline-block;">
          <label for="picture1">Photo n°7</label>
          <small>(Si nécessaire)</small>
          <input type="file" name="picture7" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="picture7" >
        </div>
        <div class="form-group" style="display: inline-block;">
          <label for="picture2">Photo n°8</label>
          <small>(Si nécessaire)</small>
          <input type="file" name="picture8" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="picture8">
        </div>
        <div class="form-group" style="display: inline-block;">
          <label for="picture3">Photo n°9</label>
          <small>(Si nécessaire)</small>
          <input type="file" name="picture9" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="picture9">
        </div>
      </div>

        <div class="form-group">
          <input id="saveDelta" type="submit" value="Valider">
        </div>
    </form>
<?php } ?>
  </main>
  <?php include('includes/footer.php'); ?>
</body>
<script src="js/quilljs.js" type="text/javascript"></script>
</html>
