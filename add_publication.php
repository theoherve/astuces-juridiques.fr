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
  <?php include('includes/header_publications.php'); ?>
  <main>
    <form method="post" action="add_publication_process.php" class="formPublications" enctype="multipart/form-data">
      <div class="form-group">
        <label for="objet">Titre :</label>
        <input type="text" name="objet" class="form-control" id="objet" required>
      </div>

      <div class="form-group">
        <label for="sub_domains">Le sous-domaine</label>
        <select class="form-control form-control-sm" name="id_sub_domain" id="sub_domains" required>
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
        <div class="form-group" id="the_tip" style="height: 100%;"></div>
        <textarea type="text" name="the_tip" style="display: none;" id="inputAstuce"></textarea>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6" style="display: inline-block;">
          <label for="suggest">Proposé par :</label>
          <input type="text" name="suggest" class="form-control" id="suggest" required>
        </div>
        <div class="form-group col-md-6" style="display: inline-block;">
          <label for="url">URL :</label>
          <input type="text" name="url" class="form-control" id="url">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group" style="display: inline-block;">
          <label for="picture1">Photo n°1</label>
          <input type="file" name="picture1" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="picture1" required>
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
          <input type="file" name="picture4" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="picture4">
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

        <div class="form-group" style="margin-top: 0.8em;">
          <label for="releaseDateTime">Choisissez la date de publication :</label>
          <input type="datetime-local" id="releaseDateTime" name="releaseDateTime" value="" min="" max="">
        </div>
        <div class="form-group">
          <input id="saveDelta" type="submit" value="Valider">
        </div>
    </form>

  </main>
  <?php include('includes/footer.php'); ?>
</body>
<script src="js/quilljs.js" type="text/javascript"></script>
</html>
