<?php
include('connexion_check.php');
include('config.php');

$reqNewsletter = $db->prepare("SELECT newsletter, token FROM users WHERE id_user=:id_user");
$reqNewsletter->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
$reqNewsletter->execute();
$newsletter = $reqNewsletter->fetch(PDO::FETCH_ASSOC);

if($connected == '1' && $_GET['token'] == '1'){
  if($_GET['newsletter'] == 0){
    $requestUpdate = $db-> PREPARE("UPDATE users SET newsletter = 1 WHERE id_user=:id_user");
    $requestUpdate->bindParam(':id_user', $_GET['id_user']);
    $requestUpdate->execute();
    echo "<button type=\"button\" id=\"newslettersButtonUnsubscribe\" class=\"footer_validator\" onclick=\"change_newsletter_status_unsubscribe(" . $_SESSION['id'] . "," . 1 . "," . $newsletter['token'] . ")\">Se désinscrire</button>";

  }else{
    $requestUpdate = $db-> PREPARE("UPDATE users SET newsletter = 0 WHERE id_user=:id_user");
    $requestUpdate->bindParam(':id_user', $_GET['id_user']);
    $requestUpdate->execute();
    echo "<button type=\"button\" id=\"newslettersButtonSubscribe\" class=\"footer_validator\" onclick=\"change_newsletter_status_subscribe(" . $_SESSION['id'] . "," . 0 . "," . $newsletter['token'] . ")\">S'inscrire</button>";
  }
}else{
  $email = htmlspecialchars(trim($_POST['email']));
  $insert=$db->prepare('INSERT INTO newsletters (email) VALUES (:email)');
  $insert->bindParam(':email', $email, PDO::PARAM_STR);
  $insert->execute();
  header('location: ../index.php');
}

?>
