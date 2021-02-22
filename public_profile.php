<?php
$title="Profil";
require('includes/head.php');

$reqUser = $db->prepare('SELECT * FROM users WHERE id_user=:id_user');
$reqUser->bindParam(':id_user', $_GET['id_user'], PDO::PARAM_INT);
$reqUser->execute();
$profil=$reqUser->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
	<?php require('includes/header.php'); ?>
	<body>
		<main>
			<div class="publicProfile">
				<div>
					<h1><?php echo $profil['pseudo']; ?></h1>
				</div>
				<div>
					<?php
					$filename = 'img/img_users/img_user_'.$profil['id_user'];
					if(file_exists($filename)){ ?>
							<img src="img/img_users/img_user_<?php echo $profil['id_user']?>" for="profilePicture" alt="photo de profil">
					<?php }else{ ?>
						<img src="pictures/nav/profile.png" for="profilePicture" alt="photo de profil">
					<?php } ?>
				</div>
				<div>
					<a href="mailto:<?php echo $profil['email'];?>" id="textHeader11">Envoyer un email</a>
				</div>
				<div name="desc">
					<label for="description"><h3>Description :</h3></label>
					<div id="description">
						<?php echo $profil['description_public']; ?>
					</div>
				</div>
			</div>
		</main>
		<?php include('includes/footer.php') ?>
	</body>
	<?php include('includes/scripts.php') ?>
</html>
