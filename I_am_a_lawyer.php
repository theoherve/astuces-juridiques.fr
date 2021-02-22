<?php
$title = "Mon Avocat";
 ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include('includes/head.php'); ?>
    </head>
    <body id="my_lawyers">
        <?php include('includes/header.php'); ?>
        <main>
          <section id="layerParentSection">
            <div id="firstChildDiv">
              <form name="formLawyers" action="lawyer_statement.php" onsubmit=" return submitform()" method="post" >
                <div id="div_lawyer_3">
                  <div><h2>Vos informations personnelles<span style="color: #3BA1E4"><sup>*</sup></span></h2></div>
                  <div><input class="lawyerImput1" type="text" id="lawyerName" name="name" placeholder="Ex: Maître Sébastien Bonnamy"></div>
                  <div><input class="lawyerImput1" type="email" id="lawyerEmail" name="email" placeholder="Adresse mail"></div>
                  <div><input class="lawyerImput1" type="tel" id="lawyerPhone" name="phone" placeholder="Téléphone"></div>
                </div>
                <div id="div_lawyer_5">
                    <h2>Préférence de contact</h2>
                    <div class="lawyer_info_div">
                      <div class="imputFull">
                        <div><input class="lawyerImput2Box" type="checkbox" value="yes" name="monday"></div>
                        <div><p>Lundi</p></div>
                      </div>
                      <div class="imputFull"><input class="lawyerImput2" type="text" name="monday_1" placeholder="10h30-13h00"></div>
                      <div class="imputFull"><input class="lawyerImput2" type="text" name="monday_2" placeholder="14h30-17h00"></div>
                    </div>
                    <div class="lawyer_info_div">
                      <div class="imputFull">
                        <div><input class="lawyerImput2Box" type="checkbox" value="yes" name="tuesday"></div>
                        <div><p>Mardi</p></div>
                      </div>
                      <div class="imputFull"><input class="lawyerImput2" type="text" name="tuesday_1" placeholder="10h30-13h00"></div>
                      <div class="imputFull"><input class="lawyerImput2" type="text" name="tuesday_2" placeholder="14h30-17h00"></div>
                    </div>
                    <div class="lawyer_info_div">
                      <div class="imputFull">
                        <div><input class="lawyerImput2Box" type="checkbox" value="yes" name="wednesday"></div>
                        <div><p>Mercredi</p></div>
                      </div>
                      <div class="imputFull"><input class="lawyerImput2" type="text" name="wednesday_1" placeholder="10h30-13h00"></div>
                      <div class="imputFull"><input class="lawyerImput2" type="text" name="wednesday_2" placeholder="14h30-17h00"></div>
                    </div>
                    <div class="lawyer_info_div">
                      <div class="imputFull">
                        <div><input class="lawyerImput2Box" type="checkbox" value="yes" name="thursday"></div>
                        <div><p>Jeudi</p></div>
                      </div>
                      <div class="imputFull"><input class="lawyerImput2" type="text" name="thursday_1" placeholder="10h30-13h00"></div>
                      <div class="imputFull"><input class="lawyerImput2" type="text" name="thursday_2" placeholder="14h30-17h00"></div>
                    </div>
                    <div class="lawyer_info_div">
                      <div class="imputFull">
                        <div><input class="lawyerImput2Box" type="checkbox" value="yes" name="friday"></div>
                        <div><p>Vendredi</p></div>
                      </div>
                      <div class="imputFull"><input class="lawyerImput2" type="text" name="friday_1" placeholder="10h30-13h00"></div>
                      <div class="imputFull"><input class="lawyerImput2" type="text" name="friday_2" placeholder="14h30-17h00"></div>
                    </div>
                    <div id="div_terms">
                      <div id="imputFullCGU"><input class="lawyerImput2Box" type="checkbox" required name="termConditions"><a href="/cg/politiqueDeConfidentialite" target="_blank">J'accepte les <span style="text-decoration: underline;">termes et conditions</span style="text-decoration: underline;"><sup style="color: #3BA1E4">*</sup></a></input></div>
                    </div>
                    <button id="ILawyerButton" name="validButton" type="submit">Valider</button>
                </div>
              </form>
              <script type="text/javascript">
                  function submitform()
                  {
                    l_name = document.getElementById("lawyerName");
                    l_mail = document.getElementById("lawyerEmail");
                    l_phone = document.getElementById("lawyerPhone");
                    if(l_name.value == "" || l_mail.value == "" || l_phone.value == ""){
                      l_name.style.border = "solid";
                      l_name.style.borderColor = "red";
                      l_name.style.borderWidth = "1px";
                      l_mail.style.border = "solid";
                      l_mail.style.borderColor = "red";
                      l_mail.style.borderWidth = "1px";
                      l_phone.style.border = "solid";
                      l_phone.style.borderColor = "red";
                      l_phone.style.borderWidth = "1px";
                      l_name.required = true;
                      l_mail.required = true;
                      l_phone.required = true;

                      return false;
                    }else{
                      l_name.setCustomValidity("");
                    }
                  }
              </script>
            </div>

            <div id="secondChildDiv">
              <!--middle bar-->
            </div>
            <div id="secondHalfOfScreen">

            <div id="ThirdChildDiv">
              <div class="rightContent">
                <div><img src="/pictures/SVG/Performance copie.svg" id="lawyerPic1" alt="perf"></div>
                <div class="lawyerText"><p>Augmenter votre clientèle<br>sans avoir à faire le commercial</p></div>
              </div>
              <div id="bomb_div" class="rightContent">
                <div><img src="/pictures/SVG/Explosion copie.svg" id="lawyerPic2" alt="Boom" id="Boom"></div>
                <div  class="lawyerText"><p>Explosez votre productivité <br>sans avoir à faire l'agent de recouvrement</p></div>
              </div>
              <div class="rightContent">
                <div><img src="/pictures/SVG/Foule copie.svg" id="lawyerPic3" alt="people"></div>
                <div class="lawyerText"><p>Propulsez votre visibilité<br>sans avoir à faire le marketteur</p></div>
              </div>
              <div class="rightContent">
                <div class="lawyerText"><p id="last_p_lawyer">Mon astuce juridique<br>"Apporteur d'affaires juridiques au service des avocat et des particuliers".</p></div>
              </div>
            </div>
          </div>
          </section>
        </main>
        <?php include('includes/footer.php'); ?>
  </body>
  <script type="text/javascript" src="js/lawyer.js"></script>
  <script src="js/modal.js" type="text/javascript"></script>
  <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
</html>
