<?php
include('includes/config.php');
$family_name=trim($_POST['family_name']);
$first_name=trim($_POST['first_name']);
$phone=trim($_POST['phone']);
$email=trim($_POST['email']);
$objet=trim($_POST['objet']);
$description=htmlspecialchars(trim(strip_tags($_POST['description'], '<br>')));
$description = preg_replace('/\s+/', ' ', trim($description));


$id_lawyer=$_GET['id_lawyer'];
if(!empty($family_name) AND !empty($first_name) AND !empty($phone) AND !empty($email) AND !empty($objet) AND !empty($description) AND isset($_POST['CGU']))
{
	if(!empty($id_lawyer))
	{
		$req_mail=$db->PREPARE('SELECT email,first_name FROM lawyers WHERE id_lawyer=?');
		$req_mail->execute([$id_lawyer]);
		$reqq=$req_mail->fetch();
		$lawyer_mail=$reqq['email'];
		$lawyer_nom=$reqq['first_name'];
		$to=$lawyer_mail;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "{\"params\":{\"PRENOM_AVOCAT\":\"$lawyer_nom\",\"NOM_USER\":\"$family_name\",\"PRENOM_USER\":\"$first_name\",\"TELEPHONE\":\"$phone\",\"MAIL\":\"$email\",\"TEXT\":\"$objet\",\"MESSAGE\":\"$description\"},\"sender\":{\"name\":\"Astuces Juridiques\",\"email\":\"avocat@astuces-juridiques.fr\"},\"to\":[{\"email\":\"$lawyer_mail\",\"name\":\"$lawyer_nom\"}],\"replyTo\":{\"email\":\"$email\",\"name\":\"$first_name\"},\"subject\":\"$objet\",\"templateId\":31}",
			CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"api-key: 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",
				"content-type: application/json"
			),
		));
		curl_exec($curl);
		curl_close($curl);


		?><script>
			alert("<?php echo "Le mail a été envoyé avec succès" ?>");
			document.location.href="display_one_lawyer.php?idl=<?php echo $id_lawyer ?>"
			</script>
		<?php
	}	else {
		header('index.php');
	}
}	else {
	$error="tous les champs doivent être remplis";
}
?><script>
	alert("<?php echo $error ?>");
	document.location.href="display_one_lawyer.php?idl=<?php echo $id_lawyer ?>"
	</script>
<?php
 ?>
