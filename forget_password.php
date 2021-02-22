<?php
include('includes/config.php');
 ?>
<?php
$email=$_POST['email'];
$emailhash = password_hash($email, PASSWORD_DEFAULT);

if(!empty($_POST['email'])){
  $check_email=$db->PREPARE('SELECT id_user, pseudo, first_name FROM users WHERE email = ?');
  $check_email->execute(array($_POST['email']));
  $check=$check_email->fetch();
  $count=$check_email->rowCount();
  if($count!=0){
    $id_user_to_link = $check['id_user'];
    $pseudo_to_link = $check['pseudo'];
    $name_user_to_link = $check['first_name'];
    $to = ($email);
    $subject = "Réinitialisation de votre mot de passe";
    $link_to_mail = "http://51.178.140.232/renew_password.php?key=$emailhash&id=$id_user_to_link";

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\"params\":{\"VALIDATE_LINK\":\"$link_to_mail\",\"PSEUDO\":\"$pseudo_to_link\",\"PRENOM\":\"$name_user_to_link\"},\"sender\":{\"name\":\"Astuces Juridiques\",\"email\":\"contact@astuces-juridiques.com\"},\"to\":[{\"email\":\"$to\",\"name\":\"$name_user_to_link\"}],\"replyTo\":{\"email\":\"contact@astuces-juridiques.com\",\"name\":\"Astuces Juridiques\"},\"subject\":\"$subject\",\"templateId\":29}",
      CURLOPT_HTTPHEADER => array(
        "accept: application/json",
        "api-key: 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",
        "content-type: application/json"
      ),
    ));
    curl_exec($curl);
    curl_close($curl);



    $error="Un mail pour réinitialiser le mot de passe vous à été envoyé. \nSi vous ne le trouver pas, consultez vos courriers indésirables";
    ?><script>
      alert("<?php echo $error ?>");
      document.location.href="signup.php"
      </script>
    <?php
  } else{
    $error="Cet email n existe pas parmis nos utilisateurs !";
    ?><script>
      alert("<?php echo $error ?>");
      document.location.href="signup.php"
      </script>
    <?php
  }
} else{
  echo "pas de mail";
}
 ?>
