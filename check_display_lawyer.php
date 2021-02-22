<?php
$title = "Recherche Avocat";
include('includes/head.php');
$reqUsers = $db->prepare('SELECT * FROM users WHERE id_user=:id_user');
$reqUsers->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
$reqUsers->execute();
$profil=$reqUsers->fetch(PDO::FETCH_ASSOC);
 ?>
<!DOCTYPE html>
<html lang="fr"  dir="ltr">
		<head>
      <?php header('Cache-Control: no cache'); ?>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
		</head>
		<body id="my_lawyers">
				<?php include('includes/header.php'); ?>


        <main id="main_display_one_lawyer_check">
          <section id="my_lawyer_first_section_check">
            <div id="my_lawyer_first_section_div_1">
              <div id="my_lawyer_first_section_div_1_1">
                <p>Trouvez l'avocat de vos besoins,<br> et penchez la balance de votre côté</p>
              </div>
              <div id="my_lawyer_first_section_div_1_2">
            </div>
          </section>
          <section id="who_check">
            <?php
              $id=$_GET['idl'];
              $allinfo=$db->PREPARE('SELECT * FROM lawyers WHERE id_lawyer =?');
              $allinfo->execute([$id]);
              $info=$allinfo->fetch();
            ?>
              <p><a href="lawyer.php">Mon avocat</a> / <a href="javascript:history.go(-1)">Recherche avancée</a> / Maitre <?php echo $info['family_name'].' '.$info['first_name'] ?></a></p>
          </section>
          <section id="section_lawyer_9">
            <section id="section_for_check_1">
              <div id="conteneur_conteneur">
                <div id="conteneur_conteneur_1">
                  <div id="main_pres_lawyer">
                    <div id="main_pres_lawyer_info_1">
                      <div id="pdp_lawyer">
                        <img src="pictures/pdp_users/img_1_user_<?php echo $id ?>" alt="img_lawyer">
                      </div>
                      <div id="main_pres_lawyer_info_1_1">
                        <p id="main_pres_lawyer_info_1_p_1">Maître </p><p id="main_pres_lawyer_info_1_p_2"><?php echo $info['family_name'].' ' ?></p><p id="main_pres_lawyer_info_1_p_3"><?php echo $info['first_name'] ?></p>
                      </div>
                      <div id="main_pres_lawyer_info_1_2">
                        <div id="main_pres_lawyer_info_1_2_button_1" type="button" class="btn_modal" data-modal="RDVCabinet">
                          <button type="button" class="btn btn-primary btn-lg btn-block">Rendez-vous cabinet</button>
                        </div>
                        <div id="main_pres_lawyer_info_1_2_button_2" type="button" class="btn_modal" data-modal="phoneCabinet">
                          <button type="button" class="btn btn-primary btn-lg btn-block">Rendez-vous cabinet</button>
                        </div>
                      </div>
                      <div id="main_pres_lawyer_info_1_3">
                        <div id="main_pres_lawyer_info_1_3_li_1">
                          <ul>
                            <li><img id="main_pres_lawyer_info_1_3_puce" src="pictures/puce.svg" alt="puce"> A prété serment il y a
                              <?php
                              $today=date('Y-m-d');
                              $past=$info['oath'];

                              $datetime1 = date_create($past);
                              $datetime2 = date_create($today);
                              $interval = date_diff($datetime1, $datetime2);
                              $ydate=$interval->format('%y ans');
                              $mdate=$interval->format('%m mois');
                              $ddate=$interval->format('%d jours');
                              if($ydate>0){
                                echo $ddate;
                              }	else if($mdate>0){
                                echo $mdate;
                              }	else{
                                echo $ddate;
                              }
                              ?>
                            </li>
                            <li><img id="main_pres_lawyer_info_1_3_puce" src="pictures/puce.svg" alt="puce"><?php echo ' '.$info['payement_type'] ?></li>
                          </ul>
                        </div>
                        <div id="main_pres_lawyer_info_1_3_li_2">
                          <ul>
                            <li><img id="main_pres_lawyer_info_1_3_puce" src="pictures/puce.svg" alt="puce"><?php echo ' '.$info['th'] ?></li>
                            <li><img id="main_pres_lawyer_info_1_3_puce" src="pictures/puce.svg" alt="puce">
                                <?php
                                if($info['legal_aid']==1){
                                echo "Aide juridictionnelle";
                                }	else{
                                  if(!empty($info['language_1'])){
                                    $recl=$db->PREPARE('SELECT name FROM languages WHERE id_language= ?');
                                    $recl->execute([$info['language_1']]);
                                    $recl=$recl->fetch();
                                    echo $recl['name'];
                                  }
                                  if(!empty($info['language_2'])){
                                    $recl=$db->PREPARE('SELECT name FROM languages WHERE id_language= ?');
                                    $recl->execute([$info['language_2']]);
                                    $recl=$recl->fetch();
                                    echo ' / '.$recl['name'];
                                  }
                                  if(!empty($info['language_3'])){
                                    $recl=$db->PREPARE('SELECT name FROM languages WHERE id_language= ?');
                                    $recl->execute([$info['language_3']]);
                                    $recl=$recl->fetch();
                                    echo ' / '.$recl['name'];
                                  }
                                }
                                ?>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div id="main_pres_lawyer_info_2">

                    </div>
                    <div id="main_pres_lawyer_info_3">
                        <?php echo $info['description'] ?>
                    </div>

                  </div>
                </div>
                <div id="conteneur_conteneur_2">
                  <div id="right_pres_lawyer">
                    <p id="question_juridique_text">Posez votre question juridique</p>
                    <div id="right_pres_lawyer_paypal">
                      <div>
                        <img src="img/paypal.png" alt="paypal">
                      </div>
                      <div>
                        <a href="<?php echo $info['paypal'] ?>"><?php echo $info['paypal']?></a>
                      </div>
                    </div>
                    <div id="right_pres_lawyer_text">
                      <p id="right_pres_lawyer_text_text"> <?php echo $info['question_j']?></p>

                    </div>
                  </div>
                  <div id="down_pres_lawyer">
                    <div >
                      <p id="down_pres_lawyer_title">Domaine de compétences</p>
                    </div>
                    <div id="down_pres_lawyer_competences">
                      <?php
                      $i=1;
                      while($i<=12){
                        ?>
                        <?php
                        $recc=$db->PREPARE('SELECT name FROM skills WHERE id_skill= ?');
                        $recc->execute([$info['competence_'.$i]]);
                        $reci=$recc->fetch();
                         ?>
                      <?php
                      if(!empty($info['competence_'.$i]))
                      {
                        ?>
                        <div class="one_competence">
                          <p><?php echo $reci['name']?></p>
                        </div><?php
                      } else{?>
                        <div class="one_competence_phantom">
                          <p><?php echo $reci['name']?></p>
                        </div><?php
                        }?>
                        <?php
                        $i++;
                      }
                      ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="main_pres_lawyer_mob">
                  <div id="preview_lawyer_1">
                    <div id="img_profil_lawyer">
                      <img src="pictures/pdp_users/img_1_user_<?php echo $info['id_lawyer']?>" alt="Avocat" height="230em">
                    </div>
                    <div id="preview_lawyer_1_2">
                      <div id="preview_lawyer_21_1">
                        <p id=identity><?php echo 'Maître' .' '. '<span class="family_name">' . $info['family_name'] . '</span>' .' '. $info['first_name']; ?></p>
                      </div>
                      <div id="display_one_lawyer_button_1">
                        <button type="button" class="btn btn-primary btn-lg btn-block">Rendez-vous cabinet</button>
                      </div>
                        <div id="display_one_lawyer_button_2">
                          <button type="button" class="btn btn-primary btn-lg btn-block">Rendez-vous cabinet</button>
                        </div>
                    </div>
                  </div>
                  <div id="preview_lawyer_2">
                    <div id="lawyer_information">
                      <div id="preview_lawyer_22">
                        <ul>
                          <li class="li_sup"><img src="/pictures/puce.svg" height="10em">	<?php
                            echo "À preté serment il y a ";
                            $today=date('Y-m-d');
                            $past=$info['oath'];

                            $datetime1 = date_create($past);
                            $datetime2 = date_create($today);
                            $interval = date_diff($datetime1, $datetime2);
                            $ydate=$interval->format('%y ans');
                            $mdate=$interval->format('%m mois');
                            $ddate=$interval->format('%d jours');
                            if($ydate>0){
                              echo $ddate;
                            }	else if($mdate>0){
                              echo $mdate;
                            }	else{
                              echo $ddate;
                            }
                            ?>
                          </li>
                          <li>
                            <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Paiement' . ' ' . $info['payement_type']; ?>
                          </li>
                        </ul>
                      </div>
                      <div id="preview_lawyer_23">
                        <ul>
                          <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($info['legal_aid']){
                            echo " Aide juridictionnelle";
                            }else{
                              echo ' ' . $info['language_name'];
                            } ?>
                          </li>
                          <li>
                            <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Taux horaire: ' . $info['th']; ?>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div id="div_zone_description_area_f">
                    <div id="description_area_f">
                      <?php echo $info['description']; ?>
                    </div>
                  </div>
                </div>
                <div id="down_pres_lawyer_mob">
                  <div >
                    <p id="down_pres_lawyer_title">Domaine de compétences</p>
                  </div>
                  <div id="down_pres_lawyer_competences">
                    <?php
                    $i=1;
                    while($i<=12){
                      ?>
                      <?php
                      $recc=$db->PREPARE('SELECT name FROM skills WHERE id_skill= ?');
                      $recc->execute([$info['competence_'.$i]]);
                      $reci=$recc->fetch();
                       ?>
                    <?php
                    if(!empty($info['competence_'.$i]))
                    {
                      ?>
                      <div class="one_competence">
                        <p><?php echo $reci['name']?></p>
                      </div><?php
                    } else{?>
                      <div class="one_competence_phantom">
                        <p><?php echo $reci['name']?></p>
                      </div><?php
                      }?>
                      <?php
                      $i++;
                    }
                    ?>
                    </div>
                  </div>
                </div>
                <div id="right_pres_lawyer_mob">
                    <p id="question_juridique_text_mob">Posez votre question juridique
                    </p>
                    <div id="right_pres_lawyer_paypal_mob">
                      <div>
                      <img src="img/paypal.png" alt="paypal">
                      </div>
                      <div>
                        <a href="<?php echo $info['paypal'] ?>"><?php echo $info['paypal']?></a>
                      </div>
                    </div>
                    <div id="right_pres_lawyer_text_mob">
                      <p id="right_pres_lawyer_text_text_mob"> <?php echo $info['question_j']?></p>

                    </div>
                </div>
              </div>
                <div id="conteneur_map">
                  <div id="map">
                    <?php
                    $city=$db->PREPARE('SELECT lat, lng FROM lawyers WHERE id_lawyer=?');
                    $city->execute([$_GET['idl']]);
                    $city=$city->fetch();
                    ?>

                    <script>
                      //début api google chrome
                      var map;
                      function initMap()
                      {
                        map = new google.maps.Map(document.getElementById('map'),
                        {
                          center: { lat: <?php echo $city['lat'] ?>, lng: <?php echo $city['lng'] ?> },
                          zoom: 16
                        });

                        var marker = new google.maps.Marker({
                        position: { lat: <?php echo $city['lat'] ?>, lng: <?php echo $city['lng'] ?> },
                        map: map,
                        title: 'map astuces juridiques'
                        });
                      }
                    </script>
                  </div>
                  <div id="up_map">
                  <img src="pictures/position.png" alt="">
                  <p> <?php
                    $req_city_boy= $db->PREPARE('SELECT zip_code FROM cities WHERE id_city=?');
                    $req_city_boy->execute([$info['id_city']]);
                    $req_cit=$req_city_boy->fetch();
                    echo $info['address'].', '.$req_cit['zip_code'] ?>
                  </p>
                  </div>
                </div>
                <div id="site_pres_lawyer">
                  <div id="img_link">
                    <img id="aaa" src="pictures/link.png" alt="img_link">
                  </div>
                  <div id="site_pres_lawyer_text">
                  <a href="<?php echo $info['link_cab']; ?>" target="_blank">Site internet du cabinet</a>
                </div>
              </div>
              </section>
            <section id='validation_lawyer'>
              	<h3>Validation de l'avocat</h3>
              	<div id="validation_lawyer_button">
              		<div>
              			<button type="button" onclick="window.location.href='update_status_lawyer.php?idl=<?php echo $_GET['idl'] ?>&status=ko'" class="btn btn-warning btn-lg btn-block">Mettre en attente</button>
              		</div>
              		<div>
              			<button type="button" onclick="window.location.href='update_status_lawyer.php?idl=<?php echo $_GET['idl'] ?>&status=ok'" class="btn btn-success btn-lg btn-block">Mettre en ligne</button>
              		</div>
              	</div>
              </section>
          </section>
        </main>
				<?php
					include('includes/footer.php');
 				?>

        <div id="RDVCabinet" class="modal_bg_client">
          <div class="mod_content_client">
            <left><a class="close_mod" data-modal="RDVCabinet"><img src="pictures/croix.svg" alt="Cancel" style="width: 1em; margin-left: 1em; margin-top:1em;"></a></left>
            <div class="mod_main_client">
              <div id="modalClient">
                <form method="post" action="contact_lawyer.php?id_lawyer=<?php echo $_GET['idl'] ?>" id="warning">
                  <center><h1>Rendez-vous cabinet</h1></center>
                  <div>
                    <input type="text" name="family_name" placeholder="Nom" value="<?php echo $profil['family_name']; ?>" required>
        						<input type="text" name="first_name" placeholder="Prénom" value="<?php echo $profil['first_name']; ?>" required>
                  </div>
                  <div>
                    <input type="text" name="phone" placeholder="Téléphone" value="<?php echo (isset($profil['phone'])) ? $profil['phone'] : "" ; ?>" required>
                    <input required type="text" class="form-control" placeholder="Votre e-mail" name="email" value="<?php
                    if($connected == 1){
                      $req = $db->prepare('SELECT email FROM users WHERE id_user = :id_user');
                      $req->bindParam(":id_user", $_SESSION['id'], PDO::PARAM_INT);
                      $req->execute();
                      $res = $req->fetch();
                      echo ($res != 0) ? $res['email'] : "" ;
                      } ?>">
                  </div>

                  <input type="text" name="objet" placeholder="Objet du message" required>
                  <textarea rows="5" placeholder="Expliquez votre demande juridique" name="description" required></textarea>
                  <div class="checkboxModal">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="CGU" id="defaultCheck1" required>
                      <label class="form-check-label" for="defaultCheck1">
                        J'accepte les <a href="cg/CGU" target="_blank">conditions générales d'utilisation</a>
                      </label>
                    </div>
                  </div>
                  <input class="close_mod" type="submit" value="Valider">
                </form>
              </div>
            </div>
          </div>
        </div>

        <div id="phoneCabinet" class="modal_bg_users_likes">
          <div class="mod_content_phone_avocat">
            <div class="mod_header_phone_avocat">
              <a class="close_mod" data-modal="phoneCabinet"><img src="pictures/V2_white.svg" alt="Cancel"></a>
              <span>Contactez votre avocat !</span>
            </div>
            <div id="mod_main_phone_avocat" name="phoneCabinet">
              <div>
                <img id="img_phone_l" src="pictures/Téléphone.svg" alt="">
              </div>
              <div>
                <?=$info['phone'];?>
              </div>
            </div>
          </div>
        </div>
	</body>

</main>
  <script type="text/javascript" src="js/auto_complete.js"></script>
  <script type="text/javascript" src="js/map.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCim2EsoGwDMqkwK1CDuyl7c8nCDIVn97o&callback=initMap"defer></script>
<script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
<?php include('includes/scripts.php'); ?>


</html>
