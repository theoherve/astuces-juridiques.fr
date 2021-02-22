<?php
$title = "Inscription";
define('SITE_KEY', '6LfRR7AZAAAAALv2zLmCJdlBR_z7l6ZnYcwtRgfC');
define('SECRET_KEY', '6LfRR7AZAAAAAOkHckTyOhTCPWW5pO_xGq7BCqA5');
 ?>
<!DOCTYPE html>
<html lang="fr" style="width:100%">
    <head >
        <?php include('includes/head.php'); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='https://www.google.com/recaptcha/api.js' async defer></script>
        <script src='https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>'></script>
    </head>
    <body>
      <?php include('includes/header.php'); ?>
        <main id="body_inscription">
          <?php
            if(isset($_GET["error"]) && !empty($_GET["error"])){
              if($_GET["error"]=="mail"){
                $errorText = "Veuillez confirmer votre adressse email!";
              }else if($_GET["error"]=="password"){
                $errorText = "Mauvais mot de passe!";
              }else if($_GET["error"]=="nofound"){
                $errorText = "L'email ou le pseudo renseigné n'existe pas!";
              }else if($_GET["error"]=="forms"){
                $errorText = "Vous devez remplir tous les champs du formulaire!";
              }else if($_GET["error"]=="badName"){
                $errorText = "Il ne peut y avoir de caractères spéciaux ou chiffres dans le champs : Prénom!";
              }else if($_GET["error"]=="badFamilyName"){
                $errorText = "Il ne peut y avoir de caractères spéciaux ou chiffres dans le champs : Nom de famille!";
              }else if($_GET["error"]=="PasswordMatch"){
                $errorText = "Les deux mots de passe ne sont pas identiques, ou ne peuvent commencer/terminer par un espace!";
              }else if($_GET["error"]=="passwordShort"){
                $errorText = "Mot de passe doit avoir plus de 6 caracteres!";
              }else if($_GET["error"]=="badPseudo"){
                $errorText = "Le pseudo ne peut etre composé que de lettre et de chiffre!";
              }else if($_GET["error"]=="pseudoLength"){
                $errorText = "La taille du pseudo doit au maximum etre de 15 caractéres!";
              }else if($_GET["error"]=="usedMail"){
                $errorText = "Cet email existe deja.";
              }else if($_GET["error"]=="usedPseudo"){
                $errorText = "Ce pseudo existe deja.";
              }
            }else{
              $errorText = "";
            }
          ?>
          <h5 style="margin-top: 15px; color:red;text-align:center;"><?php echo $errorText ?></h5>
          <div id="inscription_connexion_3_div">
<!-- inscription -->
            <div id="div_inscription">
              <h3>Inscription</h3>
              <form name="subForm"  action="signup_process.php" onsubmit="return submitform()" method="post">
                <div class="form-row">
                  <div class="col" >
                      <input type="text" id="t_firstname" class="form-control" name="firstname" placeholder="Prénom">
                      <div id="first_name_message"></div>
                  </div>
                  <div class="col">
                    <input type="text" id="t_familyname" class="form-control" name="familyname" placeholder="Nom">
                    <div id="family_name_message"></div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <input type="text" id="t_pseudo" class="form-control" name="pseudo" placeholder="Pseudo">
                    <div id="pseudo_message"></div>
                  </div>
                  <div class="col" class="form-control">
                    <select id="t_sexe" class="form-control form-control-lg">
                      <option value="" disabled selected>Sexe</option>
                      <option value="1">Homme</option>
                      <option value="2">Femme</option>
                    </select>
                  </div>
                </div>
                <div id="botom_form_singup">
                  <div class="col">
                    <input type="email" id="t_mail" class="form-control" name="email" placeholder="Adresse mail">
                    <input type="password" id="t_password" class="form-control" name="password1" placeholder="Mot de passe">
                    <input type="password" id="t_password_bis" class="form-control" name="password2" placeholder="Confirmer le mot de passe">
                    <div id="password_message"></div>
                  </div>
                </div>
                <div id="div_inscription_cgu" class="form-check">
                  <div class="inscription_checkbox"><input class="form-check-input" required type="checkbox" name="Check_cu"></input></div>
                  <div><a href="cg/CGU" target="_blank" class="form-check-label" for="gridCheck1">
                    J'accepte les conditions générales d'utilisation
                  </a></div>
                </div>
                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" /><br >
              <!-- <div class="col">
                <div class="g-recaptcha" data-sitekey="6Lf4vAEVAAAAAJxUk7FWoCd85OINOPbIBVWa4pem "></div>
              </div>
                <script>
                $( document ).ready(function() {
                  var width = $('.g-recaptcha').parent().width();
                  var scale = width / 304;
                  console.log("width: "+width);
                  console.log("scale: "+scale);
                  //$('.g-recaptcha').css('margin-bottom', (scale*(scale+2))+"vh");
                  //console.log("margin recaptcha"+$('.g-recaptcha').css('padding-bottom'));
                  $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
                  $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
                  $('.g-recaptcha').css('transform-origin', '0 0');
                  $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
                });
                $( window ).resize(function() {
                  var width = $('.g-recaptcha').parent().width();
                  var scale = width / 304;
                  console.log("width: "+width);
                  console.log("scale: "+scale);
                  //$('.g-recaptcha').css('margin-bottom', (scale*scale+"vh");
                  //console.log("margin recaptcha"+$('.g-recaptcha').css('padding-bottom'));
                  $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
                  $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
                  $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
                  $('.g-recaptcha').css('transform-origin', '0 0');
                  $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
                }); -->
                <script>
                    grecaptcha.ready(function() {
                    grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'homepage'})
                    .then(function(token) {
                        //console.log(token);
                        document.getElementById('g-recaptcha-response').value=token;
                    });
                    });
                </script>
                <div id="div_button">
                  <div><button type="submit" name="valid_form_inscription" class="btn btn-primary btn-lg btn-block">S'inscrire</button></div>
                </div>
              </form>
            </div>
            <script src="js/singup_prosses_local.js" type="text/javascript"></script>
            <!-- barre -->
            <div id="div_inscription_connexion_barre">

            </div>
            <!-- connexion -->
            <div id="div_connexion">
              <h3>Connexion</h3>
              <form action="signin_process.php" method="post">
              <input type="text" name="id" class="form-control" placeholder="Adresse mail ou pseudo">
              <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                  <a data-toggle="modal" data-target="#div_modal_forgotten_mdp" href="#div_modal_forgotten_mdp">Mot de passe oublié ?</a>
              </div>
              <div id="div_remember_me" style="display: flex;" class="form-check">
                <div class="inscription_checkbox"><input class="form-check-input" type="checkbox" name="remember_me" id="rememberCheck"></div>
                <div ><label class="form-check-label" for="rememberCheck">
                  Se souvenir de moi*
                </label></div>
              </div>
                <div id="div_button">
                  <div><button type="submit" name="valid_form_connexion" class="btn btn-primary btn-lg btn-block">Se connecter</button></div>
                <div>
                </div>
              </form>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="div_modal_forgotten_mdp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Réinitialisation du mot de passe</h5>
                </div>
                  <form action="forget_password.php" method="post">
                    <div class="modal-body">
                        <div class="form_group">
                          <p>Un email de réinitialisation vous sera envoyé</p>
                          <input type="text" required name="email" class="form-control" placeholder="Veuillez saisir votre email">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary btn-lg btn-block">Envoyer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </main>
        <!-- <div id="testeset" class="container-cookie-consent">
        <div class="cookie-text">En cliquant sur "Se souvenir de moi" vous acceptez l’utilisation de cookies vous permettant de bénéficier d’une expérience de navigation optimale. <a href="/cg/politiqueDeConfidentialite">Cliquez ici</a> pour plus d'information. <a onclick="close_cookie()" class="button-accept-cookies">J'ai compris !</a></div>
        </div>
        <script type="text/javascript">
          function close_cookie(){
            document.getElementById("testeset").style.display = "none";
          }
        </script> -->
      <?php include('includes/footer.php'); ?>
    </body>
    <script src="js/modal.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
    <?php include('includes/scripts.php'); ?>

</html>
