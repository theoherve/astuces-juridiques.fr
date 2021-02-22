<?php
include('includes/config.php');
?>

<?php
$title = "Inscription";
 ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include('includes/head.php'); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
      <?php include('includes/header.php'); ?>
        <main>
        <div id="div_renew_password">
          <h3>Nouveau mot de passe</h3>
          <form action="renew_password_process.php?key=<?php echo $_GET['key'] ?>&id=<?php echo $_GET['id']?>" method="post">
            <div class="form-group">
              <input type="password" class="form-control" name="password1" placeholder="Entrez votre mot de passe">
              <small id="text_renew_password" class="form-text text-muted">Votre mot de passe doit contenir au moins six caractères.</small>
            </div>
            <input type="password" class="form-control" name="password2" placeholder="Entrez votre mot de passe une seconde fois">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Valider</button>
          </form>
        </div>
        </main>
      <?php include('includes/footer.php'); ?>
    </body>
    <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
</html>
