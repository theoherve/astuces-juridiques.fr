<?php
$title = "Mon Avocat";
 ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<?php
        include('includes/head.php');
        header('Cache-Control: no cache'); //no cache
        // session_cache_limiter('private_no_expire'); // works
        // session_cache_limiter('public'); // works too
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <?php if(isset($_GET['sent'])){ ?>
        <script type="text/javascript">alert("Votre formulaire a été envoyé !");</script>
    <?php  } ?>
    <body id="my_lawyers">
        <?php include('includes/header.php'); ?>
        <main onclick="cancel()">
          <div id="main_lawyer_php">
          <section id="my_lawyer_first_section">
            <div id="my_lawyer_first_section_div_1">
              <div id="my_lawyer_first_section_div_1_1">
                <p>Trouvez l'avocat de vos besoins,<br>
                  et penchez la balance de votre côté</p>
              </div>
              <div id="my_lawyer_first_section_div_1_2">
                <button type="button" onclick="window.location.href='I_am_a_lawyer.php'"class="btn btn-primary">Je suis avocat ?</button>
              </div>
            </div>
            <div onclick="openCloseFilter_2()" class="dropbtnFilter" id="parent_filter_vos">
              <span id="filter_vos">Filtrer votre recherche</span>
              <img src="pictures/filterSelect.png" alt="Filtrer">
            </div>
            <form action="filter_lawyers.php" method="post" id="form_search_lawyers" style="display:none">
              <div id="my_lawyer_first_section_div_2">
                <div id="column_1">
                  <div class="div_dropdown_skills">
                    <input type="text" class="form-control" name="skill" id="input_dropdown_skills_search" autocomplete="off" placeholder="Saisissez une compétence" required>
                    <div id="div_dropdown_skills_res">


                    </div>
                  </div>
                </div>
                <div id="column_2">
                  <div id="column_2_1">
                      <input type="text" class="form-control" id="locationTextField" style="outline: none;"  placeholder="Saisissez une ville">
                    </div>
                </div>
                <div id="column_2_2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="legal_aid" name="legal_aid">
                    <label class="form-check-label" for="defaultCheck2">
                      Proposant l'aide juridictionnelle
                    </label>
                  </div>
                </div>
                <div id="column_3">
                  <input type="text" name="latitude" value="" id="latitude" style="display:none">
                  <input type="text" name="longitude" value="" id="longitude" style="display:none">
                  <div>
                    <button id="button_submit_lawyer" type="submit" onclick="" class="btn btn-primary">C'est parti</button>
                    <script type="text/javascript">
                      function submit_lawyers(){
                      document.forms["form_search_lawyers"].submit();
                      }
                      function wrong_skill_alert(){
                        window.alert("Renseigner une compétence répertoriée");
                      }
                    </script>
                  </div>
                </div>
              </div>
            </form>
            <script type="text/javascript">
              function openCloseFilter_2(){
                let content = document.getElementById('form_search_lawyers');
                let visibility= content.getAttribute('style');
                if(visibility=='display:none'){
                content.setAttribute("style", "display:flex, position:sticky");
                } else{
                content.setAttribute("style", "display:none");
                }
              }
            </script>
          </section>

          <section id="how_it_work">
            <div id="lawyer_process_icon_title">
              <h1>Comment ça marche ?</h1>
            </div>
            <div id="lawyer_process_icon">
              <div id="lawyer_process_icon_1">
                <img src="pictures/search.png" alt="search">
                <p>Rechercher votre<br> avocat</p>
              </div>
              <div id="lawyer_process_icon_2">
                <img src="pictures/filter.png" alt="filter">
                <p>Affiner votre recherche<br> selon vos préférences</p>
              </div>
              <div id="lawyer_process_icon_3">
                <img src="pictures/apointment.png" alt="apointment">
                <p>Prenez rendez-vous</p>
              </div>
              <div id="lawyer_process_icon_4">
                <img src="pictures/ask.png" alt="ask">
                <p>Posez votre question<br> juridique</p>
              </div>
            </div>
          </section>
          <section id="section_lawyer">
            <p id="alaune">À la une :</p>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="700000">
            <?php
            $countl=$db->PREPARE('SELECT id_lawyer FROM lawyers WHERE premium = ? AND status=?');
            $countl->execute([1,1]);
            $fcount=$countl->rowCount();
            ?>
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>

              <?php
                for($i=1;$i<$fcount;$i++)
                { ?>
                  <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>"></li>
                  <?php
                } ?>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <?php
                $firstt = $db->prepare("SELECT *, cities.name as city_name, id_language, languages.name as language_name FROM lawyers INNER JOIN languages ON languages.id_language = lawyers.language_1 INNER JOIN cities ON cities.id_city=lawyers.id_city WHERE premium=? AND status=? ORDER BY RAND() LIMIT 1");
                $firstt->execute([1,1]);
                WHILE($first=$firstt->fetch()){
                  $already_here=$first['id_lawyer'];
                  $oath_time = $first['oath'];
                  $oath = date('Y',strtotime($oath_time));
                  $oath2 = date('m',strtotime($oath_time));
                  $oath3 = date('d',strtotime($oath_time));
                  $now = date('Y');
                  $now2 = date('m');
                  $now3 = date('d');
                  $time_since_oath =  $now - $oath;
                  $month_since_oath = $now2 - $oath2;
                  $day_since_oath = $now3 - $oath3;
                  $id_lawyer = $first['id_lawyer'];
                  ?>
                  <div id="preview_lawyer">
                    <div id="preview_lawyer_1">
                      <div id="img_profil_lawyer">
                        <img src="pictures/pdp_users/img_1_user_<?php echo $first['id_lawyer']?>" alt="Avocat" height="230em">
                      </div>
                      <div id="button_profil_img_div">
                        <button type="button" class="btn btn-primary" onclick=window.location.href="/display_one_lawyer.php?idl=<?php echo $id_lawyer; ?>">Voir plus</button>
                      </div>
                    </div>
                    <div id="preview_lawyer_2">
                      <div id="lawyer_information">
                        <div id="preview_lawyer_21">
                          <div id="preview_lawyer_21_1">
                            <p id=identity><?php echo 'Maître' .' '. '<span class="family_name">' . $first['family_name'] . '</span>' .' '. $first['first_name']; ?></p>
                          </div>
                          <div id="preview_lawyer_21_2">
                            <div id="preview_lawyer_21_2_1">
                              <img  src="pictures/position.png" width="15em" alt="position">
                              </div>
                            <div id="preview_lawyer_21_2_2">
                              <p><?php echo  ' '. $first['address'].', '.$first['city_name'] ?></p>
                            </div>
                          </div>
                        </div>
                        <div id="line">
                        </div>
                        <div id="preview_lawyer_22">
                          <ul>
                            <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($time_since_oath > 0)
                              {
                                echo ' ' . 'A prété serment il y a ' . $time_since_oath . ' ans';
                              }elseif ($month_since_oath > 0)
                              {
                                echo ' ' . 'A prété serment il y a ' . $month_since_oath . ' mois';
                              }else
                              {
                                echo ' ' . 'A prété serment il y a ' . $day_since_oath . ' jours';
                              }?>
                            </li>
                            <li>
                              <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Paiement' . ' ' . $first['payement_type']; ?>
                            </li>
                          </ul>
                        </div>
                        <div id="preview_lawyer_23">
                          <ul>
                            <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($first['legal_aid']){
                              echo " Aide juridictionnelle";
                              }else{
                                echo ' ' . $first['language_name'];
                              } ?>
                            </li>
                            <li>
                              <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Taux horaire: ' . $first['th']; ?>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <!-- $first['description'] -->
                      <div id="div_zone_description_area" onclick=window.location.href="/display_one_lawyer.php?idl=<?php echo $id_lawyer; ?>">
                        <div id="description_area">
                          <?php echo $first['description']; ?>
                        </div>
                        <div id="div_gradient">

                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- version mobile -->
                  <div id="preview_lawyer_mobile">
                    <div id="preview_lawyer_1">
                      <div id="img_profil_lawyer">
                        <img src="pictures/pdp_users/img_1_user_<?php echo $first['id_lawyer']?>" alt="Avocat" height="230em">
                      </div>
                      <div id="preview_lawyer_1_2">
                        <div id="preview_lawyer_21_1">
                          <p id=identity><?php echo 'Maître' .' '. '<span class="family_name">' . $first['family_name'] . '</span>' .' '. $first['first_name']; ?></p>
                        </div>
                        <div id="preview_lawyer_21_2">
                          <div id="preview_lawyer_21_2_2">
                            <p><img  src="pictures/position.png" alt="position"><?php echo  ' '. $first['address'].', '.$first['city_name'] ?></p>
                          </div>
                        </div>
                        <div id="button_profil_img_div">
                          <button type="button" class="btn btn-primary" onclick=window.location.href="/display_one_lawyer.php?idl=<?php echo $id_lawyer; ?>">Voir plus</button>
                        </div>
                      </div>
                    </div>
                    <div id="preview_lawyer_2">
                      <div id="lawyer_information">
                        <div id="preview_lawyer_22">
                          <ul>
                            <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($time_since_oath > 0)
                              {
                                echo ' ' . 'A prété serment il y a ' . $time_since_oath . ' ans';
                              }elseif ($month_since_oath > 0)
                              {
                                echo ' ' . 'A prété serment il y a ' . $month_since_oath . ' mois';
                              }else
                              {
                                echo ' ' . 'A prété serment il y a ' . $day_since_oath . ' jours';
                              }?>
                            </li>
                            <li>
                              <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Paiement' . ' ' . $first['payement_type']; ?>
                            </li>
                          </ul>
                        </div>
                        <div id="preview_lawyer_23">
                          <ul>
                            <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($first['legal_aid']){
                              echo " Aide juridictionnelle";
                              }else{
                                echo ' ' . $first['language_name'];
                              } ?>
                            </li>
                            <li>
                              <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Taux horaire: ' . $first['th']; ?>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div id="div_zone_description_area">
                      <div id="description_area">
                        <?php echo $first['description']; ?>
                      </div>
                      <div id="div_gradient">

                      </div>
                    </div>
                  </div>
                  <ol class="carousel-indicators-mob">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>

                    <?php
                      for($i=1;$i<$fcount;$i++)
                      { ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>"></li>
                        <?php
                      } ?>
                  </ol>
                  <!-- Fin version mobile -->
                  <?php
                  } ?>
              </div>
              <?php
              $chosen_ones = $db->prepare("SELECT *, cities.name as city_name, id_language, languages.name as language_name FROM lawyers INNER JOIN languages ON languages.id_language = lawyers.language_1 INNER JOIN cities ON cities.id_city=lawyers.id_city WHERE premium=? AND status=? AND id_lawyer != ?");

              $chosen_ones->execute([1,1,$already_here]);
              WHILE($your_lawyers = $chosen_ones->fetch())
              { ?>
              <div class="carousel-item">
                <?php
                $oath_time = $your_lawyers['oath'];
                $oath = date('Y',strtotime($oath_time));
                $oath2 = date('m',strtotime($oath_time));
                $oath3 = date('d',strtotime($oath_time));
                $now = date('Y');
                $now2 = date('m');
                $now3 = date('d');
                $time_since_oath =  $now - $oath;
                $month_since_oath = $now2 - $oath2;
                $day_since_oath = $now3 - $oath3;
                $id_lawyer = $your_lawyers['id_lawyer'];
                ?>
                <div id="preview_lawyer">
                  <div id="preview_lawyer_1">
                    <div id="img_profil_lawyer">
                      <img src="pictures/pdp_users/img_1_user_<?php echo $your_lawyers['id_lawyer']?>" alt="Avocat" height="230em">
                    </div>
                    <div id="button_profil_img_div">
                      <button type="button" class="btn btn-primary"onclick=window.location.href="/display_one_lawyer.php?idl=<?php echo $your_lawyers['id_lawyer'] ?>">Voir plus</button>
                    </div>
                  </div>
                  <div id="preview_lawyer_2">
                    <div id="lawyer_information">
                      <div id="preview_lawyer_21">
                        <div id="preview_lawyer_21_1">
                          <p id=identity><?php echo 'Maître' .' '. '<span class="family_name">' . $your_lawyers['family_name'] . '</span>' .' '. $your_lawyers['first_name']; ?></p>
                        </div>
                        <div id="preview_lawyer_21_2">
                          <div id="preview_lawyer_21_2_1">
                            <img  src="pictures/position.png" width="15em" alt="position">
                            </div>
                          <div id="preview_lawyer_21_2_2">
                            <p><?php echo  ' '. $your_lawyers['address'].', '.$your_lawyers['city_name'] ?></p>
                          </div>
                        </div>
                      </div>
                      <div id="line">
                      </div>
                      <div id="preview_lawyer_22">
                        <ul>
                          <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($time_since_oath > 0)
                            {
                              echo ' ' . 'A prété serment il y a ' . $time_since_oath . ' ans';
                            }elseif ($month_since_oath > 0)
                            {
                              echo ' ' . 'A prété serment il y a ' . $month_since_oath . ' mois';
                            }else
                            {
                              echo ' ' . 'A prété serment il y a ' . $day_since_oath . ' jours';
                            }?>
                          </li>
                          <li>
                            <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Paiement' . ' ' . $your_lawyers['payement_type']; ?>
                          </li>
                        </ul>
                      </div>
                      <div id="preview_lawyer_23">
                        <ul>
                          <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($your_lawyers['legal_aid']){
                            echo " Aide juridictionnelle";
                            }else{
                              echo ' ' . $your_lawyers['language_name'];
                            } ?>
                          </li>
                          <li>
                            <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Taux horaire: ' . $your_lawyers['th']; ?>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <!-- $first['description'] -->
                    <div id="div_zone_description_area" onclick=window.location.href="/display_one_lawyer.php?idl=<?php echo $id_lawyer; ?>">
                      <div id="description_area">
                        <?php echo $your_lawyers['description']; ?>
                      </div>
                      <div id="div_gradient">

                      </div>
                    </div>
                  </div>
                </div>
                <!-- version mobile -->
                <div id="preview_lawyer_mobile">
                  <div id="preview_lawyer_1">
                    <div id="img_profil_lawyer">
                      <img src="pictures/pdp_users/img_1_user_<?php echo $your_lawyers['id_lawyer']?>" alt="Avocat" height="230em">
                    </div>
                    <div id="preview_lawyer_1_2">
                      <div id="preview_lawyer_21_1">
                        <p id=identity><?php echo 'Maître' .' '. '<span class="family_name">' . $your_lawyers['family_name'] . '</span>' .' '. $your_lawyers['first_name']; ?></p>
                      </div>
                      <div id="preview_lawyer_21_2">
                        <div id="preview_lawyer_21_2_2">
                          <p><img  src="pictures/position.png" width="15em" alt="position"><?php echo  ' '. $your_lawyers['address'].', '.$your_lawyers['city_name'] ?></p>
                        </div>
                      </div>
                      <div id="button_profil_img_div">
                        <button type="button" class="btn btn-primary" onclick=window.location.href="/display_one_lawyer.php?idl=<?php echo $your_lawyers['id_lawyer']; ?>">Voir plus</button>
                      </div>
                    </div>
                  </div>
                  <div id="preview_lawyer_2">
                    <div id="lawyer_information">
                      <div id="preview_lawyer_22">
                        <ul>
                          <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($time_since_oath > 0)
                            {
                              echo ' ' . 'A prété serment il y a ' . $time_since_oath . ' ans';
                            }elseif ($month_since_oath > 0)
                            {
                              echo ' ' . 'A prété serment il y a ' . $month_since_oath . ' mois';
                            }else
                            {
                              echo ' ' . 'A prété serment il y a ' . $day_since_oath . ' jours';
                            }?>
                          </li>
                          <li>
                            <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Paiement' . ' ' . $your_lawyers['payement_type']; ?>
                          </li>
                        </ul>
                      </div>
                      <div id="preview_lawyer_23">
                        <ul>
                          <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($your_lawyers['legal_aid']){
                            echo " Aide juridictionnelle";
                            }else{
                              echo ' ' . $your_lawyers['language_name'];
                            } ?>
                          </li>
                          <li>
                            <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Taux horaire: ' . $your_lawyers['th']; ?>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div id="div_zone_description_area">
                    <div id="description_area">
                      <?php echo $your_lawyers['description']; ?>
                    </div>
                    <div id="div_gradient">

                    </div>
                  </div>
                </div>
                <ol class="carousel-indicators-mob">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>

                  <?php
                    for($i=1;$i<$fcount;$i++)
                    { ?>
                      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>"></li>
                      <?php
                    } ?>
                </ol>
                <!-- Fin version mobile -->
                </div>
                <?php
                } ?>
              </div>
              <a class="carousel-control-prev" id="carousel_lawyer_left" href="#carouselExampleControls" role="button" data-slide="prev">
                <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                <!-- <span class="sr-only">Previous</span> -->
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M25 50C38.7854 50 50 38.7854 50 25C50 11.2146 38.7854 0 25 0C11.2146 0 0 11.2146 0 25C0 38.7854 11.2146 50 25 50ZM17.2771 23.5271L27.6938 13.1105C28.1 12.7042 28.6333 12.5 29.1667 12.5C29.7 12.5 30.2334 12.7042 30.6396 13.1105C31.4542 13.925 31.4542 15.2417 30.6396 16.0562L21.6958 25L30.6395 33.9438C31.4541 34.7583 31.4541 36.075 30.6395 36.8896C29.825 37.7041 28.5083 37.7041 27.6938 36.8896L17.2771 26.4729C16.4625 25.6583 16.4625 24.3417 17.2771 23.5271Z" fill="#3BA1E4"/>
                </svg>
              </a>
              <a class="carousel-control-next" id="carousel_lawyer_right" href="#carouselExampleControls" role="button" data-slide="next">
                <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span> -->
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M25 0C11.2146 0 0 11.2146 0 25C0 38.7854 11.2146 50 25 50C38.7854 50 50 38.7854 50 25C50 11.2146 38.7854 0 25 0ZM32.7229 26.4729L22.3062 36.8895C21.9 37.2958 21.3667 37.5 20.8333 37.5C20.3 37.5 19.7666 37.2958 19.3604 36.8895C18.5458 36.075 18.5458 34.7583 19.3604 33.9438L28.3042 25L19.3605 16.0562C18.5459 15.2417 18.5459 13.925 19.3605 13.1104C20.175 12.2959 21.4917 12.2959 22.3062 13.1104L32.7229 23.5271C33.5375 24.3417 33.5375 25.6583 32.7229 26.4729Z" fill="#3BA1E4"/>
                </svg>
              </a>
            </div>
          </section>
  </div>
        </main>
      <?php include('includes/footer.php'); ?>
    </body>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-3bOpbCXWZX8RQXpdEytRK4Y9AqHwejM&libraries=places&fields=geometry"></script>
    <script type="text/javascript" src="js/auto_complete.js"></script>
    <script type="text/javascript" src="js/auto_complete_skill.js"></script>
    <script src="js/modal.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
    <?php include('includes/scripts.php'); ?>
</html>
