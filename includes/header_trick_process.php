<?php
include('config.php');
include('connexion_check.php');

if(empty($_SESSION['id']) || !isset($_SESSION['status'])){
	header('Location: ../index.php');
}else{
  if($_POST['CGU'] != 'on' || !isset($_POST['CGU'])) {
    echo "vous devez valider les conditions d'utilisation";
  }elseif(isset($_POST['objet']) && !empty($_POST['objet'])
		&&isset($_POST['the_tip']) && !empty($_POST['the_tip'])
    && isset($_POST['source']) && !empty($_POST['source'])
    && isset($_POST['author']) && !empty($_POST['author'])){

    $objet = htmlspecialchars(trim($_POST['objet']));
    $idMail = htmlspecialchars(trim($_POST['author']));
    $astuce = htmlspecialchars(trim($_POST['the_tip']));
    $source = htmlspecialchars(trim($_POST['source']));
    date_default_timezone_set('Europe/Paris');
    $dateNow = gmdate("Y-m-d H-i-s");


    $reqAuthor = $db->prepare("SELECT id_user FROM users WHERE email = :email");
    $reqAuthor->bindParam(':email', $idMail, PDO::PARAM_STR);
    $reqAuthor->execute();
    $idUser = $reqAuthor->fetch();
    $idAuthor = $idUser['id_user'];

    $insert = $db->prepare("INSERT INTO articles (objet, content, source, publication_date, id_author) VALUES (:objet, :content, :source, :publication_date, :id_author)");
    $insert->bindParam(':objet', $objet, PDO::PARAM_STR);
    $insert->bindParam(':content', $astuce, PDO::PARAM_STR);
    $insert->bindParam(':source', $source, PDO::PARAM_STR);
    $insert->bindParam(':publication_date', $dateNow);
    $insert->bindParam(':id_author', $idAuthor, PDO::PARAM_INT);
    $insert->execute();

		?><script>
			alert("Votre astuce a été envoyée. Merci!");
			document.location.href="../index.php"
			</script>
		<?php
  }else{
  	echo "vouq devez completer tous les champs";
  }
}


 ?>
