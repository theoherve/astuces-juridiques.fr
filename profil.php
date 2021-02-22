<?php
$title="Profil";
require('includes/head.php');

if(empty($_SESSION['id'])){
	header('Location: /');
}elseif(!isset($_GET['id'])){
	$id_user = $_SESSION['id'];
}else{
	$id_user = $_GET['id'];
}

$req = $db->prepare('SELECT * FROM users WHERE id_user=:id_user');
$req->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
$req->execute();
$profil=$req->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['format'])) {
	?><script>alert("les formats d'images acceptés sont uniquement jpeg, jpg et png")</script><?php
}
if (isset($_GET['size'])) {
	?><script>alert("le poids du fichier doit être inférieur à 3 Mo")</script><?php
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
	<?php require('includes/header.php'); ?>
	<body>
		<main>
			<div id="modifProfil">
				<div class="profilePicture">
					<?php
					$filename = 'img/img_users/img_user_'.$profil['id_user'];
					if(file_exists($filename)){ ?>
					    <img src="img/img_users/img_user_<?php echo $profil['id_user']?>" for="profilePicture" alt="photo de profil">
					<?php }else{ ?>
						<img src="pictures/nav/profile.png" for="profilePicture" alt="photo de profil">
					<?php } ?>
					<!-- <img src="img/img_users/img_user_<?php echo $profil['id_user']?>" alt="photo de profil"> -->
					<!-- <img src="" class="profilePicture" alt="Logo de modification"> -->
					<label for="profilePicture">Modifier la photo de profil</label>
					<input type="file" name="profilePicture" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="profilePicture" form="modifProfilForm">
					<button type="submit" form="modifProfilForm" name="validate" class="modifProfilButton">Charger la photo</button>
				</div>

				<div class="barProfil">
				</div>

				<form method="POST" action="profile_process.php" enctype="multipart/form-data" id="modifProfilForm">
					<center><h1>Votre profil</h1></center>

					<div>
						<input type="text" name="new_family_name" placeholder="Nom" value="<?php echo $profil['family_name']; ?>">
						<input type="text" name="new_first_name" placeholder="Prénom" value="<?php echo $profil['first_name']; ?>">
					</div>

					<div>
						<input type="text" name="new_pseudo" placeholder="Pseudo" value="<?php echo $profil['pseudo']; ?>" disabled style="background-color:#d9d9d9">
						<select name="new_sexe">
							<?php if ($profil['sexe'] != null && $profil['sexe'] == 'homme'): ?>
								<option value=<?php echo $profil['sexe']?> selected><?php echo $profil['sexe'];?></option>
								<option value="femme">femme</option>
							<?php elseif ($profil['sexe'] != null && $profil['sexe'] == 'femme'): ?>
								<option value=<?php echo $profil['sexe']?> selected><?php echo $profil['sexe'];?></option>
								<option value="homme">homme</option>
							<?php else: ?>
								<option value="" selected disabled hidden>Sexe</option>
								<option value="homme">homme</option>
								<option value="femme">femme</option>
							<?php endif; ?>
						</select>
					</div>

					<input type="text" name="new_email" placeholder="Adresse mail" value="<?php echo $profil['email']; ?>" disabled style="background-color:#d9d9d9">
					<input type="date" name="new_birthday" placeholder="Date de naissance" value="<?php echo $profil['birthday']; ?>">

					<textarea name="new_description_public" rows="5" placeholder="Votre description"><?php echo $profil['description_public']; ?></textarea>

					<input name="old_password" type="password" placeholder="Entrer votre mot de passe">
					<input name="new_password1" type="password" placeholder="Nouveau mot de passe">
					<input name="new_password2" type="password" placeholder="Confirmation Mot de passe">

					<!-- <div class="profilCheckbox">
						<input name="newsletter" class="checkbox" type="checkbox" id="newsletter" style="/*display: none;*/" onchange="checkBox(this)" <?php echo ($profil['newsletter'])?'checked':''; ?>>
						<label for="newsletter">J'accepte de recevoir les newsletters</label>
					</div> -->

					<button type="submit" name="validate" class="modifProfilButton">Enregistrer les modifications</button>
				</form>
			</div>
		</main>
		<?php include('includes/footer.php') ?>
	</body>
	<?php include('includes/scripts.php') ?>
</html>
