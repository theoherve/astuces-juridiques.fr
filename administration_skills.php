<?php
$title="Administration";

include('includes/head.php');

if($connected!=1 || $_SESSION['status']<=1){
header('location:index.php');
}
 ?>

 <!DOCTYPE html>
 <html lang="fr">
     <?php include('includes/header_skills.php'); ?>
     <body>
         <main>
          <center><h1 id="h1_cpt">Gestion des compétences</h1></center>
        <div id="add_sub_domains">
        <center><h2>Sous-domaines</h2></center>
          <form action="admin_skill_process.php?key=dom" method="post">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputState">Domaine</label>
                <select id="inputState" name="domain_id" class="form-control">
                  <option value="0" selected>Sélectionnez un domaine</option>
                  <?php
                  $req1=$db->PREPARE('SELECT * FROM domains');
                  $req1->execute();
                  WHILE($infodom=$req1->fetch()){
                   ?>
                  <option value="<?php echo $infodom['id_domain']; ?>"><?php echo $infodom['name']?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="subdomain">Intégration domaines</label>
                <input type="text" placeholder="entrez un sous domaine" class="form-control" name="input_subdomain">
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-lg btn-block">valider !</button>
              </div>
            </div>
          </form>
        </div>
        <div id="del_skills">
        <center><h2>Suppression sous-domaine</h2></center>
          <form action="admin_skill_process.php?key=delskill" method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputState">Sous-domaines</label>
                <select id="inputState" name="sub_domain_id" class="form-control">
                  <option value="0" selected>Sélectionnez un sous domaine:</option>
                  <?php
                  $req2=$db->PREPARE('SELECT * FROM sub_domains');
                  $req2->execute();
                  WHILE($infosub=$req2->fetch()){
                   ?>
                  <option value="<?php echo $infosub['id_sub_domain']?>"><?php echo $infosub['name']?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-danger btn-lg btn-block">Supprimer</button>
              </div>
            </div>
          </form>
        </div>
        <div id="add_skills">
        <center><h2>Compétences</h2></center>
          <form action="admin_skill_process.php?key=skill" method="post">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputState">Sous-domaines</label>
                <select id="inputState" name="sub_domain_id" class="form-control">
                  <option value="0" selected>Sélectionnez un sous domaine</option>
                  <?php
                  $req2=$db->PREPARE('SELECT * FROM sub_domains');
                  $req2->execute();
                  WHILE($infosub=$req2->fetch()){
                   ?>
                  <option value="<?php echo $infosub['id_sub_domain']?>"><?php echo $infosub['name']?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="skill">Intégrer un sous-domaines</label>
                <input type="text" placeholder="entrez une compétence" class="form-control" name="skill">
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-lg btn-block">valider !</button>
              </div>
            </div>
          </form>
        </div>
        <div id="display_lawyers_skills">
        <center><h2>Tableau de bord</h2></center>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Compteur</th>
                <th scope="col">Domaine</th>
                <th scope="col">Sous Domaine</th>
                <th scope="col">Compétence</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $sort_1=$db->PREPARE('SELECT id_domain, name FROM domains ORDER BY name');
              $sort_1->execute();
              WHILE($dom=$sort_1->fetch()){
              ?>
              <?php
              $sort_2=$db->PREPARE('SELECT id_sub_domain, name FROM sub_domains WHERE id_domain=? ORDER BY name');
              $sort_2->execute(array($dom['id_domain']));
              WHILE($sub_dom=$sort_2->fetch()){
              ?>
              <?php
              $sort_3=$db->PREPARE('SELECT id_skill, name FROM skills WHERE id_sub_domain=? ORDER BY name');
              $sort_3->execute(array($sub_dom['id_sub_domain']));
              WHILE($skill=$sort_3->fetch()){
               ?>
              <tr>
               <td><?php
                  $req_count=$db->PREPARE('SELECT id_lawyer FROM lawyers WHERE competence_1=? OR competence_2=? OR competence_3=? OR competence_4=? OR competence_5=? OR competence_6=? OR competence_7=? OR competence_8=? OR competence_9=? OR competence_10=? OR competence_11=? OR competence_12=?');
                  $req_count->execute([$skill['id_skill'],$skill['id_skill'],$skill['id_skill'],$skill['id_skill'],$skill['id_skill'],$skill['id_skill'],$skill['id_skill'],$skill['id_skill'],$skill['id_skill'],$skill['id_skill'],$skill['id_skill'],$skill['id_skill']]);
                  $count=$req_count->rowCount();
                  if($count!=0){
                ?><p><?php echo $count; ?></p><?php
                  }else{
                    ?><p style="color:red"><?php echo $count; ?></p><?php
                  }

                ?></td>
                <td><?php echo $dom['name'] ?></td>
                <td><?php echo $sub_dom['name']?></td>
                <td><?php echo $skill['name']?></td>
                <td><button type="button" onclick="window.location.href='admin_skill_process.php?key=del&id=<?php echo $skill['id_skill'] ?>'" class="btn btn-danger">Supprimer</button></td>
                <?php } ?>
                <?php } ?>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>

        <div id="add_languages">
        <center><h2>Ajouter une langue</h2></center>
          <form action="admin_skill_process.php?key=add_lang" method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="subdomain">Ajoutez une langue</label>
                <input type="text" placeholder="entrez une langue" class="form-control" name="input_language">
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">valider !</button>
              </div>
            </div>
          </form>
        </div>

        <div id="display_lawyers_skills">
        <center><h2>Ensemble des langues</h2></center>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Langues</th>
                <th scope="col">Avocats la maîtrisant</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $sort_9=$db->PREPARE('SELECT name, id_language FROM languages ORDER BY name');
              $sort_9->execute();
              WHILE($lang=$sort_9->fetch()){
              ?>
              <?php
              // $sort_x=$db->PREPARE('SELECT id_lawyer FROM lawyers WHERE id_language = ?');
              // $sort_x->execute($lan['id_language']);
              // $sort_x->rowCount();
              ?>
              <tr>
                <td><?php echo $lang['name'] ?></td>
                <td>X</td>
                <td><button type="button" onclick="window.location.href='admin_skill_process.php?key=dellang&id=<?php echo $lang['id_language'] ?>'" class="btn btn-danger">Supprimer</button></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
         </main>
       <?php include('includes/footer.php'); ?>
     </body>
     <script src="js/modal.js" type="text/javascript"></script>
 </html>
