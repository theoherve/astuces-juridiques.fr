<?php
$title="Administration";
include('includes/head.php');

if($connected!=1 || $_SESSION['status']<=2){
header('location:index.php');
}
 ?>

<!DOCTYPE html>
<html>
<?php ?>
<body>
  <?php include('includes/header_users.php'); ?>
  <main>
  	<div id="allusers">
  		<H1>Utilisateurs</H1>

  		<table class="table">
  			<thead>
  				<tr>
  					<th scope="col">ID</th>
  					<th scope="col">Pseudo</th>
  					<th scope="col">Prénom</th>
  					<th scope="col">Nom</th>
  					<th scope="col">Email</th>
            <th scope="col">privilège</th>
  				</tr>
  			</thead>
  			<tbody>
  				<?php
  					$allusers= $db->prepare("SELECT * FROM users WHERE token='1' ORDER BY pseudo");
  					$allusers->execute();
            $count=$allusers->rowCount();
            echo "Total: ".$count;
  					while ($user=$allusers->fetch())
  					{?>
  						<tr onclick="window.location.href='administration_users.php?id=<?php echo $user['id_user']?>'">
  							<th scope="row"><?php echo $user['id_user']?></th>
  							<td><?php echo $user['pseudo']?></td>
  							<td><?php echo $user['first_name']?></td>
  							<td><?php echo $user['family_name']?></td>
  							<td><?php echo $user['email']?></td>
                <td><?php if($user['status']==0){
                  echo "Aucun";
                } else if($user['status']==1){
                  echo "Rédacteur";
                } else if($user['status']==2){
                  echo "Administrateur";
                } else if($user['status']==3){
                  echo "Bruce lee";
                }?></td>
  						</tr>
  						<?php
  					} ?>
  					</tbody>
  				</table>
  	</div>

  	<div id="controluser">

      <?php
  if(isset($_GET['id'])){
  $id= $_GET['id'];
  }
  if(empty($id)){
  $id='';
  }
      ?>
  		<h1>Gestion de profil </h1>
  		 <form method="POST" action="gestion_user_process.php" enctype="multipart/form-data">
  		 	<div class="form-group">
              <input type="text" class="form-control" placeholder="IDutilisateur" value="<?php echo $id ?>" name="id_user">
           </div>
           <div class="form-row">
              <div class="form-group col">
                 <input type="text" class="form-control" name="newfirstname" placeholder="Prénom">
              </div>
              <div class="form-group col">
                 <input type="text" class="form-control" name="newfamilyname" placeholder="Nom">
              </div>
           </div>
           <div class="form-group">
              <input type="email" class="form-control" placeholder="Email" name="newemail">
           </div>
           <div class="form-group">
              <input type="text" class="form-control" placeholder="Pseudo" name="newpseudo">
            </div>
           <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="status">
               <option selected>Attributions des rôles</option>
               <option value="0">Aucun</option>
               <option value="1">Rédacteur</option>
               <option value="2">Administrateur</option>
               <option value="3">Bruce Lee</option>
             </select>
           <div class="form-group" id="modifier_button_all_user">
              <button type="submit" name="form_modinscription" class="btn btn-primary btn-lg btn-block">Modifier</button>
           </div>
           <div class="form-group">
              <button id="suppuser" type="button" onclick="window.location.href='delete_user.php?id_user=<?php echo $id ?>&action=del'" class=" btn btn-danger btn-lg btn-block">Supprimer</button>
           </div>
      </form>
  	</div>
    <button id="button_export" type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location.href='export_users.php'">Export CSV des utilisateurs</button>
    <button id="button_export_users" type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location.href='export_users_newletter.php'">Export CSV newsletter</button>
  </main>
  <?php include('includes/footer.php'); ?>
</body>
</html>
