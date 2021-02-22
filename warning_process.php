<?php
include('includes/config.php');
include('includes/connexion_check.php');

if(empty($_SESSION['id']) || !isset($_SESSION['status'])){?>
	<script>
		alert("Vous devez être connecté pour envoyer un revirement jurisprudentiel");
		document.location.href="index.php?num_page=<?php echo $_GET['num_page']?>"
		</script><?php
if($_POST['CGU'] != 'on' || !isset($_POST['CGU'])) {
	echo "vous devez valider les conditions d'utilisation";
	header('location:index.php');
	}
}else{
  if(isset($_POST['objet']) && !empty($_POST['objet'])
		&&isset($_POST['description']) && !empty($_POST['description'])
    // && isset($_POST['first_name']) && !empty($_POST['first_name'])
    // && isset($_POST['family_name']) && !empty($_POST['family_name'])
    && isset($_POST['email']) && !empty($_POST['email'])
    && isset($_POST['id_article']) && !empty($_POST['id_article'])){

    $objet = htmlspecialchars(trim($_POST['objet']));
    $idMail = htmlspecialchars(trim($_POST['email']));
    // $family_name = htmlspecialchars(trim($_POST['family_name']));
    // $first_name = htmlspecialchars(trim($_POST['first_name']));
    $description = htmlspecialchars(trim($_POST['description']));
    date_default_timezone_set('Europe/Paris');
    $dateNow = gmdate("Y-m-d H-i-s");
    $id_article = htmlspecialchars(trim($_POST['id_article']));

    $reqAuthor = $db->prepare('SELECT id_user FROM users WHERE email=:email');
    $reqAuthor->bindParam(':email', $idMail, PDO::PARAM_STR);
    $reqAuthor->execute();
    $idUser = $reqAuthor->fetch();
    $id_user = $idUser['id_user'];

    $insert = $db->prepare('INSERT INTO warnings (id_article, id_user, description, publication_date, title) VALUES (:id_article, :id_user, :description, :publication_date,:title)');
    $insert->bindParam(':id_article', $id_article, PDO::PARAM_INT);
    $insert->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $insert->bindParam(':description', $description, PDO::PARAM_STR);
    $insert->bindParam(':publication_date', $dateNow);
		$insert->bindParam(':title', $objet, PDO::PARAM_STR);
    $insert->execute();

		?><script>
			alert("Votre alerte a été envoyée. Merci!");
			document.location.href="index.php?num_page=<?php echo $_GET['num_page']?>"
			</script>
		<?php

  }else{
    echo "l'envoie n'a pas fonctionné";
  }
}


 ?>
