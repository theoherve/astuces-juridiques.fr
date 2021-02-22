<?php

$req = $db->prepare('SELECT pseudo FROM users WHERE id_user=:id_user');
$req->bindParam(':id_user',$_SESSION['id'],PDO::PARAM_INT);
$req->execute();
$pseudo=$req->fetch(PDO::FETCH_ASSOC);

if($_SESSION['status'] < 1 ){
  header('Location: index.php');
}
?>

<header>
  <div id="header1">
    <nav>
      <ul>
        <button type="button" class="btn_modal" id="textHeader11" data-modal="soumettrePublication">Utilisateurs</button>
        <li><a href="../index.php"><img src="pictures/aj.png" width="100px"></a></li>
          <?php if(isset($_SESSION['id'])):?>
            <div>
              <div id="showProfil" class="dropbtn" onclick="dropDown(this.parentNode)">
                <a onclick="dropDown(this.parentNode)" id="pseudoHeader" class="dropbtn"><?php echo $pseudo['pseudo']; ?>, </a>
                <a onclick="dropDown(this.parentNode)"><img src="pictures/nav/profile.png" id="imgHeader1" class="dropbtn"></a>
                <ul class="drop_down_content">
                  <li><a href="profil.php">Gérer mon profil</a></li>
                  <?php if($_SESSION['status']>=1): ?>
                    <li><hr></li>
                    <li><a href="administration.php">Administration</a></li>
                  <?php endif; ?>
                  <li><hr></li>
                  <li><a href="signout.php">Me déconnecter</a></li>
                </ul>
              </div>
            </div>
          <?php else: ?>
            <div id="inscriptionconnexion">
              <li><a href="signup.php" id="textHeader12">Connexion</a></li>
              <li id="barHeader">|</li>
              <li><a href="signup.php" id="textHeader12">Inscription</a></li>
            </div>
          <?php endif; ?>
      </ul>
    </nav>
  </div>
  <div id="header2">
    <nav>
      <ul>
        <li><a href="../index.php" id="home"></a></li>
        <li><a href="administration.php">Publications</a></li>
        <li><a href="administration_lawyers.php">Avocats</a></li>
        <li><a href="administration_skills.php">Compétences</a></li>
        <li><a href="administration_users.php">Utilisateurs</a></li>
        <li><a href="administration_blog.php">Blog</a></li>
        <li><a href="administration_tips.php">Astuces</a></li>
        <div class="searchBar">
          <input class="form-control" type="text" name="searchBar" id="search-string" value="" placeholder="Rechercher">
          <div id="result-search" style="z-index: 2;"></div>
          <script >
            $(document).ready(function(){
              $('#search-string').keydown(function(){
                $('#result-search').html('');


                var searchString = $(this).val();
                if(searchString != ""){
                  $.ajax({
                      type: 'GET',
                      url: 'includes/recherche.php',
                      data: 'searchString=' + encodeURIComponent(searchString),
                      success: function(data){
                        if(data != ""){
                          $('#result-search').html('');
                          $('#result-search').append(data);
                        }else{
                        }
                      }
                    });
                 }
              });
            });


            function cancelSearch(){
              let divResult = document.getElementById('result-search');
              let divResp = document.getElementById('search-string');
            	if(event.target.id!="search-string" && event.target.id!="resAvocat" && event.target.id!="resAstuces" && event.target.id!="resBlog"){
                divResult.style.display= "none";
                divResp.value= "";
                $('#result-search').html('');
            	}else{
                divResult.style.display="block";
              }
            };
          </script>
        </div>
      </ul>
    </nav>
  </div>
</header>
