<?php
$reqPseudo = $db->prepare('SELECT id_user, pseudo FROM users WHERE id_user=:id_user');
$reqPseudo->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
$reqPseudo->execute();
$pseudo=$reqPseudo->fetch();

$reqAllNotifications = $db->prepare('SELECT * FROM notifications WHERE is_read=0 AND to_id_user=:to_id_user LIMIT 25');
$reqAllNotifications->bindParam(':to_id_user', $_SESSION['id'], PDO::PARAM_INT);
$reqAllNotifications->execute();
$allNotifications = $reqAllNotifications->rowCount();

$reqAllFavorites = $db->prepare('SELECT * FROM favorites WHERE id_user=:id_user');
$reqAllFavorites->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
$reqAllFavorites->execute();
$allFavorites = $reqAllFavorites->rowCount();

?>

<header>
  <div id="header1">
    <nav>
      <ul>
        <button type="button" class="btn_modal" id="textHeader11" data-modal="soumettreAstuces">Soumettre une astuce</button>
        <li><a href="../index.php"><img src="pictures/aj-logo-black.png" width="80vw"></a></li>
          <?php if(isset($_SESSION['id'])):?>
            <div>
              <div id="showProfil">
                <a onclick="openCloseMain()" id="pseudoHeader" class="dropbtn"><?php echo $pseudo['pseudo']; ?>, </a>
                <div class="iconeRight">
                  <div class="displayNotif" id="displayBadgeNotifications">
                    <?php echo (!empty($allNotifications)) ? "<div class=\"redRound\" id=\"divDisplayNotif\" onclick=\"openCloseNotification()\" class=\"dropbtn\">".$allNotifications."</div>" : "" ; ?>
                    <a onclick="openCloseNotification()"><img src="pictures/nav/notification.svg" id="imgHeader1" class="dropbtn"></a>
                  </div>
                  <a onclick="openCloseMain()"><img src="pictures/nav/fleche1.svg" id="imgHeader1" class="dropbtn"></a>
                </div>
                <?php if($_SESSION['status']>=1){
                  echo "<ul class=\"drop_down_content\" id=\"dropDownMainDiv\" style=\"margin-top: 4.7em;\">";
                }else{
                  echo "<ul class=\"drop_down_content\" id=\"dropDownMainDiv\">";
                } ?>
                  <li><a href="public_profile.php?id_user=<?php echo $pseudo['id_user'] ?>">Mon profil</a></li>
                  <li><hr></li>
                  <li><a href="profil.php">Gérer mon profil</a></li>
                  <li><hr></li>
                  <li><a href="favorites.php" id="favoritesNumber">Mes favoris (<?php echo $allFavorites; ?>)</a></li>
                  <?php if($_SESSION['status']>=1): ?>
                    <li><hr></li>
                    <li><a href="administration.php">Administration</a></li>
                  <?php endif; ?>
                  <li><hr></li>
                  <li><a href="signout.php">Me déconnecter</a></li>
                </ul>

                <div class="drop_down_content" id="dropDownNotificationDiv" name="notifications">
                </div>

              </div>
            </div>
          <?php else: ?>
            <div id="inscriptionconnexion">
              <li><a href="signup.php" id="textHeader12">Inscription</a></li>
              <li id="barHeader">|</li>
              <li><a href="signup.php" id="textHeader12">Connexion</a></li>
            </div>
          <?php endif; ?>
      </ul>
    </nav>
  </div>
  <div id="header2">
    <nav>
      <ul>
        <li><a href="../index.php" id="home"></a></li>
        <li><a href="random.php">Aléatoire</a></li>
        <li><a href="/lawyer.php">Mon avocat</a></li>
        <li><a href="blog.php">Blog</a></li>
        <div class="searchBar">
          <input class="form-control" type="text" name="searchBar" id="search-string" placeholder="Rechercher">
          <div id="result-search" style="z-index: 2;"></div>
        </div>
      </ul>
    </nav>
  </div>

  <div id="header3">
    <nav>
      <ul>
        <li><svg onclick="openCloseheader3()" class="dropbtn" viewBox="0 0 25 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 2C0 0.896 0.896 0 2 0H22.75C23.854 0 24.75 0.896 24.75 2C24.75 3.104 23.854 4 22.75 4H2C0.896 4 0 3.104 0 2ZM22.75 8.5H2C0.896 8.5 0 9.396 0 10.5C0 11.604 0.896 12.5 2 12.5H22.75C23.854 12.5 24.75 11.604 24.75 10.5C24.75 9.396 23.855 8.5 22.75 8.5ZM22.75 17H2C0.896 17 0 17.896 0 19C0 20.104 0.896 21 2 21H22.75C23.854 21 24.75 20.104 24.75 19C24.75 17.896 23.855 17 22.75 17Z" fill="white"/></svg></li>
        <li><a href="../index.php"><img src="../pictures/nav/aj-logo-white.png" name="logoHeader"></a></li>
        <?php if(isset($_SESSION['id'])):?>
        <li name="iconeRight">
          <div class="displayNotif" id="displayBadgeNotificationsMobile">
            <?php echo (!empty($allNotifications)) ? "<div class=\"redRound\" id=\"divDisplayNotif\" onclick=\"openCloseNotificationMobile()\" class=\"dropbtn\">".$allNotifications."</div>" : "" ; ?>
            <a onclick="openCloseNotificationMobile()"><img src="pictures/nav/notification.svg" id="imgHeader1" class="dropbtn"></a>
          </div>
          <a onclick="openCloseMainMobile()"><img src="pictures/nav/fleche1.svg" id="imgHeader2" class="dropbtn"></a>
            <?php if($_SESSION['status']>=1){?>
              <ul class="drop_down_content" id="dropDownMainDivMobile" style="margin-top: 9.9vw;">
            <?php }else{?>
              <ul class="drop_down_content" id="dropDownMainDivMobile">
            <?php } ?>
              <li><a href="public_profile.php?id_user=<?php echo $pseudo['id_user'] ?>">Mon profil</a></li>
              <li><hr></li>
              <li><a href="profil.php">Gérer mon profil</a></li>
              <li><hr></li>
              <li><a href="favorites.php" id="favoritesNumberMobile">Mes favoris (<?php echo $allFavorites; ?>)</a></li>
              <?php if($_SESSION['status']>=1): ?>
                <li><hr></li>
                <li><a href="administration.php">Administration</a></li>
              <?php endif; ?>
              <li><hr></li>
              <li><a href="signout.php">Me déconnecter</a></li>
            </ul>
            <div class="drop_down_content" id="dropDownNotificationDivMobile" name="notifications" style="margin-top: 9.9vw;"></div>
          </li>
      <?php endif; ?>
        <?php if(!isset($_SESSION['id'])): ?>
          <a href="signup.php" id="textHeader12"><img src="pictures/nav/profile.png" width="25" height="21"></a>
        <?php endif; ?>
      </ul>
    </nav>
  </div>

  <div class="drop_down_content_header3" id="header3hamburger">
    <div class="searchBar">
      <input class="form-control" type="text" name="searchBar" id="search-string-mobile" placeholder="Rechercher">
      <div id="result-search-mobile" style="z-index: 2;"></div>
    </div>
    <a href="../index.php" class="mobileMenu">Accueil</a>
    <a href="random.php" class="mobileMenu">Aléatoire</a>
    <a href="/lawyer.php" class="mobileMenu">Mon avocat</a>
    <a href="blog.php" class="mobileMenu">Blog</a>
    <button type="button" class="btn_modal" id="textHeader11" data-modal="soumettreAstuces">Soumettre une astuce</button>
  </div>

  <div id="soumettreAstuces" class="modal_bg_client">
    <div class="mod_content_client_header">
      <left><a class="close_mod" data-modal="soumettreAstuces"><img src="pictures/croix.svg" alt="Cancel" style="width: 1em;margin-left: 0.5em;margin-top: 0.5em;" class="close_mod" data-modal="soumettreAstuces"></a></left>
      <div class="mod_main_client">
        <div id="modalClient">
          <form method="post" action="/includes/header_trick_process.php">
            <center><h3>Soumettre une astuce</h3></center>
            <p>Vous voulez partager une astuce juridique en faveur de la communauté ?</p>

            <input type="text" name="objet" placeholder="Objet de votre astuce" maxlength="70" required>

            <input required type="text" class="form-control" placeholder="Votre email" name="author" value="<?php
            if($connected == 1){
              $req = $db->prepare('SELECT email FROM users WHERE id_user = :id_user');
              $req->bindParam(":id_user", $_SESSION['id'], PDO::PARAM_INT);
              $req->execute();
              $res = $req->fetch();
              echo $res['email'];
              } ?>">

            <textarea rows="5" name="the_tip" placeholder="Description de l'astuce" required></textarea>
            <input type="text" name="source" placeholder="Source de votre astuce" required>
            <div class="checkboxModal">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="CGU" id="CGUSousmettreAstuce" required>
                <label class="form-check-label" for="CGUSousmettreAstuce">
                  J'accepte les <a href="cg/CGU" target="_blank">conditions générales d'utilisation</a>
                </label>
              </div>
            </div>
            <input class="close_mod" type="submit" id="buttonForm" value="Valider">
          </form>
        </div>
      </div>
    </div>
  </div>
</header>
