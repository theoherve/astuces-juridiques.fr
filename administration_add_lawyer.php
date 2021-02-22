<?php
$title="Administration";
include('includes/head.php');

if($connected!=1 || $_SESSION['status']<=1){
header('location:index.php');
}
?>

 <!DOCTYPE html>
 <html lang="fr">
     <?php include('includes/header_lawyers.php'); ?>
     <head >
         <meta charset="UTF-8">
         <title>Summernote with Bootstrap 4</title>
         <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

         <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
         <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
       </head>
     <body>
         <main>
          <center><h1>Ajout d'un avocat</h1></center>
          <div id='add_lawyer_div_1'>
          <center><h3>informations personnelles</h3></center>
            <form action="administration_lawyers_process.php" method="post" enctype="multipart/form-data">
              <div class="form-row">
                <div class="col">
                  <label for="family_name">Nom:</label>
                  <input type="text" class="form-control" name="family_name" placeholder="saisissez le Nom">
                </div>
                <div class="col">
                    <label for="first_name">Prénom</label>
                  <input type="text" class="form-control" name="first_name" placeholder="saisissez le Prénom">
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <label for="family_name">email:</label>
                  <input type="text" class="form-control" name="email" placeholder="saisissez l'adresse mail">
                </div>
                <div class="col">
                    <label for="first_name">Téléphone:</label>
                  <input type="text" class="form-control" name="phone" placeholder="saisissez le numéro de téléphone">
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <label for="family_name">Adresse:</label>
                  <input type="text" class="form-control" name="address" placeholder="saisissez l'adresse" id="address">
                </div>
                <div class="col">
                    <label for="first_name">code_postal</label>
                  <input type="text" class="form-control" name="zip_code" placeholder="saisissez le code postal" id="zip_code">
                </div>
              </div>
              <br>
                <button type="button" onclick="geocode()" class="btn btn-info btn-lg btn-block">Calculer la position</button>
              <br>
            <center><h3>Vérification de la position:</h3></center>

              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" value="" id="region">
                </div>
                <div class="col">
                  <input type="text" class="form-control" value="" id="departement">
                </div>
                <div class="col">
                  <input type="text" class="form-control" value="" id="rue">
                </div>
              </div>
                <input type="text" name="lat" value="" id="lat" style="display: none;">
                <input type="text" name="lng" value="" id="lng" style="display: none;">
              <br>
              <div id="ss" class="form-row">
                <div class="col">
                  <label for="first_name">ajoutez une photo :  </label>
                  <input type="file" name="picture" >
                </div>
                <div class="col">
                  <label for="first_name">Genre</label>
                  <select class="form-control" name="gender">
                    <option value="0">Homme</option>
                    <option value="1">Femme</option>
                  </select>
                </div>
              </div>
          </div>

          <div id='add_lawyer_div_2'>
            <center><h3>informations professionnelles</h3></center>
            <div class="form-row">
              <div class="col">
                <label for="family_name">date du serment:</label>
                <input type="date" class="form-control"name="oath" >
              </div>
              <div class="col">
                  <label for="first_name">aide juridictionnelle:</label>
                  <select class="form-control" name="legal_aids">
                    <option value="1">oui</option>
                    <option value="0">non</option>
                  </select>
              </div>
            </div>
              <br>
              <h5>Langue(s) maitrisée(s):</h5>
              <div class="form-row">
                <div class="col">
                  <label for="first_name">Langue 1</label>
                  <select class="form-control" name="language_1">
                    <option Value="1">Francais</option>
                    <?php
                      $lg1=$db->PREPARE('SELECT * FROM languages ORDER BY name');
                      $lg1->execute();
                      WHILE($lgg1=$lg1->fetch()){?>
                      <option Value="<?php echo $lgg1['id_language']; ?>"><?php echo $lgg1['name'] ?></option>
                      <?php } ?>
                  </select>
                </div>
                <div class="col">
                  <label for="first_name">Langue 2</label>
                  <select class="form-control" name="language_2">
                    <option value=""></option>
                    <?php
                    $lg1=$db->PREPARE('SELECT * FROM languages ORDER BY name');
                    $lg1->execute();
                    WHILE($lgg1=$lg1->fetch()){?>
                    <option Value="<?php echo $lgg1['id_language']; ?>"><?php echo $lgg1['name'] ?></option>
                    <?php } ?>
                    ?>
                  </select>
                </div>
                <div class="col">
                  <label for="first_name">Langue 3</label>
                  <select class="form-control" name="language_3">
                    <option value=""></option>
                    <?php
                    $lg1=$db->PREPARE('SELECT * FROM languages ORDER BY name');
                    $lg1->execute();
                    WHILE($lgg1=$lg1->fetch()){?>
                    <option Value="<?php echo $lgg1['id_language']; ?>"><?php echo $lgg1['name'] ?></option>
                    <?php } ?>
                     ?>
                  </select>
                </div>
              </div>
              <br>
              <div class="form-row">
                <div class="col">
                  <label for="family_name">type de paiement:</label>
                  <input type="text" class="form-control" name="paiement_type" placeholder="saisissez le type de paiement">
                </div>
                <div class="col">
                    <label for="first_name">taux horaire/au forfait:</label>
                  <input type="text" class="form-control" name="th" placeholder="saisissez l'information à renseigner">
                </div>
              </div>
            </div>
          </div>
          <div id='add_lawyer_div_3'>
          <center><h3>Présentation de l'avocat</h3></center>
              <textarea class="summernote" name="pres_lawyer"></textarea>
                <script>
                  $(document).ready(function() {
                      $('.summernote').summernote({
                      height: 300,                 // set editor height
                      minHeight: null,             // set minimum height of editor
                      maxHeight: null,             // set maximum height of editor
                      focus: true                  // set focus to editable area after initializing summernote
                    });
                  });
                </script>
            </div>

          <div id='add_lawyer_div_3'>
          <center><h3>Division question juridique</h3></center>
              <textarea class="summernote" name="pres_qj"></textarea>
                <script>
                  $(document).ready(function() {
                      $('.summernote').summernote({
                      height: 300,                 // set editor height
                      minHeight: null,             // set minimum height of editor
                      maxHeight: null,             // set maximum height of editor
                      focus: true                  // set focus to editable area after initializing summernote
                    });
                  });
                </script>
              <br>
              <input type="text" class="form-control" name="paypal_link" placeholder="lien paypal.me">
            </div>

          <div id='add_lawyer_div_5'>
            <center><h3>Compétence</h3></center>
            <div class="form-row">
              <div class="col">
                <label for="first_name">Compétence 1</label>
                <select class="form-control" name="competence_1">
                  <option Value=""></option>
                  <?php
                    $cp1=$db->PREPARE('SELECT * FROM skills ORDER BY name');
                    $cp1->execute();
                    WHILE($cpt1=$cp1->fetch()){?>
                    <option Value="<?php echo $cpt1['id_skill']; ?>"><?php echo $cpt1['name'] ?></option>
                    <?php } ?>
                </select>
              </div>
              <div class="col">
                <label for="first_name">Compétence 2</label>
                <select class="form-control" name="competence_2">
                  <option value=""></option>
                  <?php
                    $cp1=$db->PREPARE('SELECT * FROM skills ORDER BY name');
                    $cp1->execute();
                    WHILE($cpt1=$cp1->fetch()){?>
                    <option Value="<?php echo $cpt1['id_skill']; ?>"><?php echo $cpt1['name'] ?></option>
                    <?php } ?>
                  ?>
                </select>
              </div>
              <div class="col">
                <label for="first_name">Compétence 3</label>
                <select class="form-control" name="competence_3">
                  <option value=""></option>
                  <?php
                    $cp1=$db->PREPARE('SELECT * FROM skills ORDER BY name');
                    $cp1->execute();
                    WHILE($cpt1=$cp1->fetch()){?>
                    <option Value="<?php echo $cpt1['id_skill']; ?>"><?php echo $cpt1['name'] ?></option>
                    <?php } ?>
                   ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="first_name">Compétence 4</label>
                <select class="form-control" name="competence_4">
                  <option Value=""></option>
                  <?php
                    $cp1=$db->PREPARE('SELECT * FROM skills ORDER BY name');
                    $cp1->execute();
                    WHILE($cpt1=$cp1->fetch()){?>
                    <option Value="<?php echo $cpt1['id_skill']; ?>"><?php echo $cpt1['name'] ?></option>
                    <?php } ?>
                </select>
              </div>
              <div class="col">
                <label for="first_name">Compétence 5</label>
                <select class="form-control" name="competence_5">
                  <option value=""></option>
                  <?php
                    $cp1=$db->PREPARE('SELECT * FROM skills ORDER BY name');
                    $cp1->execute();
                    WHILE($cpt1=$cp1->fetch()){?>
                    <option Value="<?php echo $cpt1['id_skill']; ?>"><?php echo $cpt1['name'] ?></option>
                    <?php } ?>
                  ?>
                </select>
              </div>
              <div class="col">
                <label for="first_name">Compétence 6</label>
                <select class="form-control" name="competence_6">
                  <option value=""></option>
                  <?php
                    $cp1=$db->PREPARE('SELECT * FROM skills ORDER BY name');
                    $cp1->execute();
                    WHILE($cpt1=$cp1->fetch()){?>
                    <option Value="<?php echo $cpt1['id_skill']; ?>"><?php echo $cpt1['name'] ?></option>
                    <?php } ?>
                   ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="first_name">Compétence 7</label>
                <select class="form-control" name="competence_7">
                  <option Value=""></option>
                  <?php
                    $cp1=$db->PREPARE('SELECT * FROM skills ORDER BY name');
                    $cp1->execute();
                    WHILE($cpt1=$cp1->fetch()){?>
                    <option Value="<?php echo $cpt1['id_skill']; ?>"><?php echo $cpt1['name'] ?></option>
                    <?php } ?>
                </select>
              </div>
              <div class="col">
                <label for="first_name">Compétence 8</label>
                <select class="form-control" name="competence_8">
                  <option value=""></option>
                  <?php
                    $cp1=$db->PREPARE('SELECT * FROM skills ORDER BY name');
                    $cp1->execute();
                    WHILE($cpt1=$cp1->fetch()){?>
                    <option Value="<?php echo $cpt1['id_skill']; ?>"><?php echo $cpt1['name'] ?></option>
                    <?php } ?>
                  ?>
                </select>
              </div>
              <div class="col">
                <label for="first_name">Compétence 9</label>
                <select class="form-control" name="competence_9">
                  <option value=""></option>
                  <?php
                    $cp1=$db->PREPARE('SELECT * FROM skills ORDER BY name');
                    $cp1->execute();
                    WHILE($cpt1=$cp1->fetch()){?>
                    <option Value="<?php echo $cpt1['id_skill']; ?>"><?php echo $cpt1['name'] ?></option>
                    <?php } ?>
                   ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="first_name">Compétence 10</label>
                <select class="form-control" name="competence_10">
                  <option Value=""></option>
                  <?php
                    $cp1=$db->PREPARE('SELECT * FROM skills ORDER BY name');
                    $cp1->execute();
                    WHILE($cpt1=$cp1->fetch()){?>
                    <option Value="<?php echo $cpt1['id_skill']; ?>"><?php echo $cpt1['name'] ?></option>
                    <?php } ?>
                </select>
              </div>
              <div class="col">
                <label for="first_name">Compétence 11</label>
                <select class="form-control" name="competence_11">
                  <option value=""></option>
                  <?php
                    $cp1=$db->PREPARE('SELECT * FROM skills ORDER BY name');
                    $cp1->execute();
                    WHILE($cpt1=$cp1->fetch()){?>
                    <option Value="<?php echo $cpt1['id_skill']; ?>"><?php echo $cpt1['name'] ?></option>
                    <?php } ?>
                  ?>
                </select>
              </div>
              <div class="col">
                <label for="first_name">Compétence 12</label>
                <select class="form-control" name="competence_12">
                  <option value=""></option>
                  <?php
                    $cp1=$db->PREPARE('SELECT * FROM skills ORDER BY name');
                    $cp1->execute();
                    WHILE($cpt1=$cp1->fetch()){?>
                    <option Value="<?php echo $cpt1['id_skill']; ?>"><?php echo $cpt1['name'] ?></option>
                    <?php } ?>
                   ?>
                </select>
              </div>
            </div>
          </div>
          <div id='add_lawyer_div_6'>
            <center><h3>Cabinet</h3></center>
            <input type="text" class="form-control" name="link_cab" placeholder="lien/ url vers le cabinet">
          </div>
          <button id="sub_la" type="submit" class="btn btn-primary btn-lg btn-block">Valider</button>
          </form>
         </main>
       <?php include('includes/footer.php'); ?>
     </body>
     <script src="js/modal.js" type="text/javascript"></script>
    <script src="js/geocode.js" type="text/javascript"></script>
 </html>
