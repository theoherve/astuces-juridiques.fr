    <footer id="footer">
      <div class="footerGlobal">
        <div class="mentionLegale">
            <div class="footer_title">Mention légale</div>
            <div>
              <a href="cg/CGU" target="_blank">CGU</a>
              <?php if(isset($_SESSION['status']) && $_SESSION['status']>=3){?>
                <a href="cgu_gestion.php" id="gestion">Gestion</a> <?php
              } ?>
            </div>
            <div>
              <a href="cg/CGV" target="_blank">CGV</a>
              <?php if(isset($_SESSION['status']) && $_SESSION['status']>=3) {?>
                <a href="cgv_gestion.php" id="gestion">Gestion</a> <?php
              } ?>
            </div>
            <div>
              <a href="cg/politiqueDeConfidentialite" target="_blank">Politique de confidentialité</a>
              <?php if(isset($_SESSION['status']) && $_SESSION['status']>=3) {?>
                <a href="confidential_politic.php" id="gestion">Gestion</a> <?php
              } ?>
            </div>
        </div>
        <div class="footerRS">
            <div class="footer_title">Suivez-nous</div>
            <div><a href="#">Instagram</a></div>
            <div><a href="#">Facebook</a></div>
            <div><a href="#">Twitter</a></div>
        </div>

        <div class="footerContact">
            <div class="footer_title">Contact</div>
            <div><a href="mailto:contact@astuces-juridiques.fr">contact@astuces-juridiques.fr</a></div>
        </div>

        <div class="footerSubsiption">
            <div class="footer_title" id="subscribe_newsletter">S'abonnez à la newsletter</div>
            <?php $id_user = $_SESSION['id']; ?>
            <input type="hidden" id="id_user" value="<?php echo $id_user; ?>"> <?php

            if($connected == 1){
              $reqNewsletter = $db->prepare("SELECT newsletter, token FROM users WHERE id_user=:id_user");
              $reqNewsletter->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
              $reqNewsletter->execute();
              $newsletter = $reqNewsletter->fetch(PDO::FETCH_ASSOC);
              ?>

              <div id="divNewsletter">

              <?php if($newsletter['newsletter'] == 0){ ?>
                <div class="2Buttons">
                  <button type="button" id="newslettersButtonSubscribe" class="footer_validator" onclick="change_newsletter_status_subscribe(<?=$_SESSION['id'] . "," . $newsletter['newsletter'] . "," . $newsletter['token'];?>)">S'inscrire</button>
              <?php }else{ ?>
                  <button type="button" id="newslettersButtonUnsubscribe" class="footer_validator" onclick="change_newsletter_status_unsubscribe(<?=$_SESSION['id'] . "," . $newsletter['newsletter'] . "," . $newsletter['token'];?>)">Se désinscrire</button>
              <?php  } ?>
              <?php if ($_SESSION['status'] > 0): ?>
                <a href="export_newsletter.php" id="gestion">Export users</a>
              <?php endif; ?>
              </div>
            <?php }else{  ?>

               <form action="/includes/footer_process.php" method="post" id="emailSending">
                   <div id="newsletter_validator">
                     <input type="text" id="footer_search_mail" name="email" placeholder="Adresse mail">
                     <input type="submit" name="Valider" class="footer_input" value="Valider" form="emailSending">
                   </div>
               </form>
          <?php } ?>
          </div>
        </div>
      </div>
      <script type="text/javascript" src="js/footer.js"></script>
    </footer>
