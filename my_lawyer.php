<?php
$title = "Recherche Avocat";
 ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include('includes/head.php'); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body id="my_lawyers">
        <?php include('includes/header.php'); ?>
        <main>
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
            <form action="#" method="post">
              <div id="my_lawyer_first_section_div_2">
                <div id="column_1">
                  <div id="column_1_1">
                    <select  class="form-control" required>
                      <option value="">Rechercher votre probléme juridique</option>
                      <option value="1">blablabla</option>
                      <option value="2">blablabla</option>
                      <option value="3">blablabla</option>
                    </select>
                  </div>
                  <div id="column_1_2">
                    <input type="text" class="form-control" placeholder="Rechercher par mots clés Ex: Valérie Desrosiers">
                  </div>
                </div>
                <div id="column_2">
                  <div id="column_2_1">
                      <input type="text" class="form-control" placeholder="Saisissez une ville">
                    </div>
                  <div id="column_2_2">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                      <label class="form-check-label" for="defaultCheck1">
                        Proposant l'aide juridictionnelle
                      </label>
                    </div>
                  </div>
                </div>
                <div id="column_3">
                  <button type="button" class="btn btn-primary">C'est parti</button>
                </div>
              </div>
            </form>
          </section>
          <section id="section_lawyer">
              <?php
              $chosen_ones = $db->prepare("SELECT *, id_language, name FROM lawyers INNER JOIN languages ON languages.id_language = lawyers.language_1");
              $chosen_ones->execute([]);
              WHILE($your_lawyers = $chosen_ones->fetch())
              { ?>

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
                <div id="preview_lawyer_x">
                  <div id="preview_lawyer_1">
                    <div id="img_profil_lawyer">
                      <img src="img/img_lawyers/222.png" alt="Avocat" height="230em">
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
                            <p><?php echo  ' '. $your_lawyers['address'] ?></p>
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
                              echo ' ' . $your_lawyers['name'];
                            } ?>
                          </li>
                          <li>
                            <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Taux horaire: ' . $your_lawyers['th']; ?>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <!-- $first['description'] -->
                    <div id="div_zone_description_area">
                      <div id="description_area">
                        <p>Donec vitae consectetur lorem. Phasellus rutrum laoreet ante vitae tincidunt. Praesent consectetur est ac tristique euismod. Vestibulum sed finibus justo, in sagittis nulla. Donec dapibus, augue id molestie pharetra, tortor nisl semper enim, ut hendrerit elit magna vel libero. Aenean accumsan, nunc vitae laoreet viverra, urna odio bibendum dolor, vel porta elit ipsum a risus. Nullam pulvinar nisi ut porttitor lacinia. Vestibulum eget nisl nec orci vehicula dapibus sit amet non nibh. Donec molestie ante leo, molestie porta leo bibendum ut. Nullam a risus ut purus tincidunt volutpat.
                        Donec vitae consectetur lorem. Phasellus rutrum laoreet ante vitae tincidunt. Praesent consectetur est ac tristique euismod. Vestibulum sed finibus justo, in sagittis nulla. Donec dapibus, augue id molestie pharetra, tortor nisl semper enim, ut hendrerit elit magna vel libero. Aenean accumsan, nunc vitae laoreet viverra, urna odio bibendum dolor, vel porta elit ipsum a risus. Nullam pulvinar nisi ut porttitor lacinia. Vestibulum eget nisl nec orci vehicula dapibus sit amet non nibh. Donec molestie ante leo, molestie porta leo bibendum ut. Nullam a risus ut purus tincidunt volutpat.</p>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
                } ?>
</div>
          </section>
        </main>
      <?php include('includes/footer.php'); ?>
    </body>
    <script type="text/javascript" src="js/lawyer.js"></script>
    <script src="js/modal.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
</html>
