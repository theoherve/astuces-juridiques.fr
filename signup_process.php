<?php
session_start();
include('includes/config.php');

define('SITE_KEY', '6LfRR7AZAAAAALv2zLmCJdlBR_z7l6ZnYcwtRgfC');
define('SECRET_KEY', '6LfRR7AZAAAAAOkHckTyOhTCPWW5pO_xGq7BCqA5');

if(isset($_POST['valid_form_inscription']))
{
	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['familyname']);

	// $firstname = preg_replace("/[^a-zA-Z0-9\s]/", "", $firstname);
	// $lastname = preg_replace("/[^a-zA-Z0-9\s]/", "", $lastname);

	$mail =  $_POST['email'];
	$password1 =  trim($_POST['password1']);
	$password2 =  $_POST['password2'];
  $password = password_hash($password1, PASSWORD_DEFAULT);
  $emailhash = password_hash($mail, PASSWORD_DEFAULT);
  $pseudo = trim($_POST['pseudo']);
	// $pseudo = preg_replace("/[^a-zA-Z0-9\s]/", "", $pseudo);

//---------- reCAPTCHA ------------
		function getCaptcha($SecretKey){
				$Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
				$Return = json_decode($Response);
				return $Return;
		}
		$Return = getCaptcha($_POST['g-recaptcha-response']);
    //var_dump($Return);
    if($Return->success == true && $Return->score > 0.5)
 	{

// ---------- Fin du re CAPTCHA ----------

		if(!empty($_POST['firstname']) AND !empty($_POST['familyname']) AND !empty($_POST['email']) AND !empty($_POST['password1']) AND!empty($_POST['password2']) AND!empty($_POST['pseudo']))
		{
			if (!empty($_POST['Check_cu']))
			{
				if(trim(ctype_alpha($firstname)))
				{
					if(trim(ctype_alpha($lastname)))
					{
							if($password1 == $password2)
							{
	              if(strlen($password1)>6)
	              {
	                      if(ctype_alnum($pseudo))
	                      {
	                        if(strlen($pseudo)<15)
	                        {
	                          $verif_exist= $db->PREPARE ('SELECT email, pseudo FROM users WHERE email = ? OR pseudo = ?');
	                          $verif_exist -> execute(array($mail, $pseudo));
	                          $verif = $verif_exist->fetch();
	                          if($verif['email']!=$mail)
	                          {
	                            if($verif['pseudo']!=$pseudo)
	                            {
	                                $to = ($mail);
																	$prenom_to_mail = $_POST['firstname'];
																	$pseudo_to_mail = $_POST['pseudo'];
	                                $subject = "Activez votre compte Astuces-Juridiques";
	                                $link = "http://51.178.140.232/activate-email.php?k=$emailhash&i=$pseudo";


																	$curl = curl_init();
																	curl_setopt_array($curl, array(
																	  CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
																	  CURLOPT_RETURNTRANSFER => true,
																	  CURLOPT_ENCODING => "",
																	  CURLOPT_MAXREDIRS => 10,
																	  CURLOPT_TIMEOUT => 30,
																	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
																	  CURLOPT_CUSTOMREQUEST => "POST",
																	  CURLOPT_POSTFIELDS => "{\"params\":{\"VALIDATE_LINK\":\"$link\",\"PSEUDO\":\"$pseudo_to_mail\",\"PRENOM\":\"$prenom_to_mail\"},\"sender\":{\"name\":\"Astuces Juridiques\",\"email\":\"contact@astuces-juridiques.com\"},\"to\":[{\"email\":\"$to\",\"name\":\"$prenom_to_mail\"}],\"replyTo\":{\"email\":\"contact@astuces-juridiques.com\",\"name\":\"Astuces Juridiques\"},\"subject\":\"$subject\",\"templateId\":24}",
																	  CURLOPT_HTTPHEADER => array(
																	    "accept: application/json",
																	    "api-key: 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",
																	    "content-type: application/json"
																	  ),
																	));
																	curl_exec($curl);
																	curl_close($curl);

	                								$createuser = $db->prepare("INSERT INTO users(first_name, family_name, email, password, pseudo, newsletter, sub_date) VALUES(?,?,?,?,?,?, NOW())");
	                								$createuser->execute(array($firstname,$lastname,$mail,$password,$pseudo,1));
																	 ?>
																	 <script type="text/javascript">
																	 	alert("Super ! \nUn mail de confirmation vous a été envoyé pour accéder et valider votre compte ! :) \nN'oubliez pas de vérifier vos indésirables.");
																		document.location.href="index.php";
																	 </script>
																	 <?php
																	 exit;
	                            } else{
	                              $erreur ="usedPseudo";
	                            }
	                          } else{
	                            $erreur ="usedMail";
	                          }
	                        } else{
	                          $erreur ="pseudoLength";
	                          }
	                      } else{
	                         $erreur ="badPseudo";
	                      }
	              } else{
	                 $erreur ="passwordShort";
	              }
							}	else{
								 $erreur ="PasswordMatch";
							}
					}	else {
						 $erreur = "badFamilyName";
					}
				}	else {
					 $erreur = "badName";
				}
			}	else{
				 $erreur="userAgr";
			}
		} 	else {
			 $erreur = "forms";
		}
	  header('Location: signup.php?error='.$erreur);
	}
}	else{
header('Location: signup.php');
}

?>
