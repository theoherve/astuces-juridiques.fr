<?php
$title="Administration";
include('includes/head.php');

if($connected!=1 || $_SESSION['status']<=1){
header('location:index.php');
}
 ?>

 <!DOCTYPE html>
 <html lang="fr">
     <?php include('includes/header_lawyers.php'); ?>
        <body>
         <main>
          <div class="gestion_lawyers_parents">

          </div>
          <div id="gestion_avocat">
          <center><h1>Gestion avocats</h1></center>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Nom/Prénom</th>
                <th scope="col">Email</th>
                <th scope="col"> Date de création</th>
                <th scope="col">Abonnement</th>
                <th scope="col">Statut</th>
                <th scope="col">Premium</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $alllawyers=$db->PREPARE('SELECT id_lawyer, premium, first_name, family_name, email, creation_date, abonnement, status FROM lawyers ORDER BY family_name');
            $alllawyers->execute();
            $count=$alllawyers->rowCount();
            echo "Total: ".$count;
            WHILE($lawyer=$alllawyers->fetch())
            {
              ?>
                <tr>
                  <td onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $lawyer['id_lawyer'] ?>'"><?php echo $lawyer['family_name'].' '.$lawyer['first_name'] ?></td>
                  <td onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $lawyer['id_lawyer'] ?>'"><?php echo $lawyer['email'] ?></td>
                  <td onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $lawyer['id_lawyer'] ?>'"><?php echo $lawyer['creation_date'] ?></td>
                  <td><?php
                    if($lawyer['abonnement']==1)
                    {
                      ?><button type="button" class="btn btn-success" onclick="window.location.href='alter_lawyers_2.php?key=abo&act=0&id=<?php echo $lawyer['id_lawyer']?>'">Actif</button><?php
                    } else {
                      ?><button type="button" class="btn btn-danger" onclick="window.location.href='alter_lawyers_2.php?key=abo&act=1&id=<?php echo $lawyer['id_lawyer']?>'">Inactif</button><?php
                    }?>
                  </td>
                  <td><?php
                    if($lawyer['status']==1)
                    {
                      ?><button type="button" class="btn btn-light" onclick="window.location.href='alter_lawyers_2.php?key=vis&act=0&id=<?php echo $lawyer['id_lawyer']; ?>'">Visible</button><?php
                    } else {
                      ?><button type="button" class="btn btn-dark" onclick="window.location.href='alter_lawyers_2.php?key=vis&act=1&id=<?php echo $lawyer['id_lawyer']; ?>'">Invisible</button><?php
                    }?>
                  </td>
                  <td><?php
                    if($lawyer['premium']==1)
                    {
                      ?><button type="button" class="btn btn-warning" onclick="window.location.href='alter_lawyers_2.php?key=prem&act=0&id=<?php echo $lawyer['id_lawyer']; ?>'">Premium</button><?php
                    } else {
                      ?><button type="button" class="btn btn-dark" onclick="window.location.href='alter_lawyers_2.php?key=prem&act=1&id=<?php echo $lawyer['id_lawyer']; ?>'">Standard</button><?php
                    }?>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='alter_lawyers_2.php?key=delete&act=0&id=<?php echo $lawyer['id_lawyer']; ?>'">Supprimer</button>
                  </td>
                </tr>
              <?php
            }?>
          </table>
          </div>
          <div id="gestion_lawyers_premium">
            <center><h1>Premium</h1></center>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nom/Prénom</th>
                  <th scope="col">Email</th>
                  <th scope="col"> Date de création</th>
                  <th scope="col">Premium</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $alllawyers=$db->PREPARE('SELECT id_lawyer, premium, first_name, family_name, email, creation_date, abonnement, status FROM lawyers  WHERE premium = ? ORDER BY family_name');
              $alllawyers->execute([1]);
              WHILE($lawyer=$alllawyers->fetch())
              {
                ?>
                  <tr>
                    <td onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $lawyer['id_lawyer'] ?>'"><?php echo $lawyer['family_name'].' '.$lawyer['first_name'] ?></td>
                    <td onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $lawyer['id_lawyer'] ?>'"><?php echo $lawyer['email'] ?></td>
                    <td onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $lawyer['id_lawyer'] ?>'"><?php echo $lawyer['creation_date'] ?></td>
                    <td><?php
                    if($lawyer['premium']==1)
                    {
                      ?><button type="button" class="btn btn-warning" onclick="window.location.href='alter_lawyers_2.php?key=prem&act=0&id=<?php echo $lawyer['id_lawyer']; ?>'">Premium</button><?php
                    } else {
                      ?><button type="button" class="btn btn-dark" onclick="window.location.href='alter_lawyers_2.php?key=prem&act=1&id=<?php echo $lawyer['id_lawyer']; ?>'">Standard</button><?php
                    }?>
                    </td>
                  </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div id="div_export_avocats">
          <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location.href='export_lawyers.php'">export CSV des avocats </button>
        </div>
       </main>
       <?php include('includes/footer.php'); ?>
     </body>
     <script src="js/modal.js" type="text/javascript"></script>
 </html>
