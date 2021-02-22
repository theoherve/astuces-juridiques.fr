<?php
include('includes/config.php');
include('includes/connexion_check.php');
?>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<?php

// ------
$key='go';
$idl='none';
if(isset($_GET['id'])){
$idl=$_GET['id'];
}
$exit=2;
$family_name=$_POST['family_name'];
$first_name=$_POST['first_name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$id_city=$_POST['zip_code'];
$oath=$_POST['oath'];
$legal_aids=$_POST['legal_aids'];
$language_1=$_POST['language_1'];
$language_2=$_POST['language_2'];
$language_3=$_POST['language_3'];
$paiment_type=$_POST['paiement_type'];
$th=$_POST['th'];
$presentation_lawyer=$_POST['pres_lawyer'];
$division_juridique=$_POST['pres_qj'];
$paypal_link=$_POST['paypal_link'];
$competence_1=$_POST['competence_1'];
$competence_2=$_POST['competence_2'];
$competence_3=$_POST['competence_3'];
$competence_4=$_POST['competence_4'];
$competence_5=$_POST['competence_5'];
$competence_6=$_POST['competence_6'];
$competence_7=$_POST['competence_7'];
$competence_8=$_POST['competence_8'];
$competence_9=$_POST['competence_9'];
$competence_10=$_POST['competence_10'];
$competence_11=$_POST['competence_11'];
$competence_12=$_POST['competence_12'];
$link_cab=$_POST['link_cab'];
$gender=$_POST['gender'];
$date=date("Y-m-d H:i:s");
$longitude=$_POST['lng'];
$latitude=$_POST['lat'];

	if(empty($family_name) || empty($first_name) || empty($email) || empty($phone) || empty($address) || empty($id_city) || empty($language_1))
	{
		if($idl=='none')
		{
			$exit=1;
		}
	}
	//-----verif
if($exit!=1)
{
	if($idl=='none'){
		$check=$db->PREPARE('SELECT id_lawyer FROM lawyers WHERE email=? AND first_name=? AND family_name= ?');
		$check->execute([$email,$first_name,$family_name]);
		$count=$check->rowCount();
		$info_v=$check->fetch();
		$info=$info_v['id_lawyer'];
		} else{
			$key='nocreate';
			$count=1;
		}
		//----fin
		if($count==0){
		$key='create';
		}
		if($key=='create')
		{
			echo "create";
			$city=$db->PREPARE('SELECT id_city FROM cities WHERE zip_code=?');
			$city->execute([$id_city]);
			$zip=$city->fetch();
			$id_city=$zip['id_city'];

			$cre=$db->PREPARE('INSERT INTO lawyers(first_name,family_name,email,phone,address,id_city,creation_date) VALUES(?,?,?,?,?,?,?)');
			$cre->execute([$first_name,$family_name,$email,$phone,$address,$id_city,$date]);

			$check=$db->PREPARE('SELECT id_lawyer FROM lawyers WHERE email=? AND first_name=? AND family_name= ? AND phone=? AND address=? AND id_city=?');
			$check->execute([$email,$first_name,$family_name,$phone,$address,$id_city]);
			$checkv=$check->fetch();
			$idl=$checkv['id_lawyer'];
		}
		if($language_1==1)
		{
				$lang_check=$db->PREPARE('SELECT id_language FROM languages WHERE name="Français"');
				$lang_check->execute();
				$lang=$lang_check->fetch();
				$language_1=$lang['id_language'];
		}
		//----alter

		if(!empty($_POST['family_name']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET family_name =? WHERE id_lawyer= ?');
			$maj->execute([$family_name,$idl]);
		}
		if(!empty($_POST['first_name']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET first_name =? WHERE id_lawyer= ?');
			$maj->execute([$first_name,$idl]);
		}
		if(!empty($_POST['email']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET email =? WHERE id_lawyer= ?');
			$maj->execute([$email,$idl]);
		}
		if(!empty($_POST['phone']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET phone =? WHERE id_lawyer= ?');
			$maj->execute([$phone,$idl]);
		}
		if(!empty($_POST['address']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET address =? WHERE id_lawyer= ?');
			$maj->execute([$address,$idl]);
		}
		if(!empty($_POST['zip_code']))
		{
			$city=$db->PREPARE('SELECT id_city FROM cities WHERE zip_code=?');
			$city->execute([$_POST['zip_code']]);
			$zip=$city->fetch();
			$id_city=$zip['id_city'];
			$maj=$db->PREPARE('UPDATE lawyers SET id_city =? WHERE id_lawyer= ?');
			$maj->execute([$id_city,$idl]);

		}
		if(!empty($_POST['gender']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET gender =? WHERE id_lawyer= ?');
			$maj->execute([$gender,$idl]);
		}
		if(!empty($_POST['oath']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET oath =? WHERE id_lawyer= ?');
			$maj->execute([$oath,$idl]);
		}
		if(!empty($_POST['legal_aids']))
		{
			if($legal_aids==2){
				$legal_aids=0;
			}
			$maj=$db->PREPARE('UPDATE lawyers SET legal_aid =? WHERE id_lawyer= ?');
			$maj->execute([$legal_aids,$idl]);
		}
		if(!empty($_POST['language_1']))
		{
			if($language_1==-1){
				$language_1=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET language_1 =? WHERE id_lawyer= ?');
				$maj->execute([$language_1,$idl]);
			}	else{
				echo $language_1;
				$maj=$db->PREPARE('UPDATE lawyers SET language_1 =? WHERE id_lawyer= ?');
				$maj->execute([$language_1,$idl]);
			}
		}
		if(!empty($_POST['language_2']))
		{
			if($language_2==-1){
				$language_2=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET language_2 =? WHERE id_lawyer= ?');
				$maj->execute([$language_2,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET language_2 =? WHERE id_lawyer= ?');
				$maj->execute([$language_2,$idl]);
			}
		}
		if(!empty($_POST['language_3']))
		{
			if($language_3==-1){
				$language_3=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET language_3 =? WHERE id_lawyer= ?');
				$maj->execute([$language_3,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET language_3 =? WHERE id_lawyer= ?');
				$maj->execute([$language_3,$idl]);
			}
		}
		if(!empty($_POST['paiement_type']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET payement_type =? WHERE id_lawyer= ?');
			$maj->execute([$paiment_type,$idl]);
		}
		if(!empty($_POST['th']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET th  =? WHERE id_lawyer= ?');
			$maj->execute([$th,$idl]);
		}
		if(!empty($_POST['pres_lawyer']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET description =? WHERE id_lawyer= ?');
			$maj->execute([$presentation_lawyer,$idl]);
		}
		if(!empty($_POST['pres_qj']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET question_j =? WHERE id_lawyer= ?');
			$maj->execute([$division_juridique,$idl]);
		}
		if(!empty($_POST['paypal_link']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET paypal =? WHERE id_lawyer= ?');
			$maj->execute([$paypal_link,$idl]);
		}
		if(!empty($_POST['competence_1']))
		{
			if($competence_1==-1){
				$competence_1=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET competence_1 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_1,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET competence_1 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_1,$idl]);
			}
		}
		if(!empty($_POST['competence_2']))
		{
			if($competence_2==-1){
				$competence_2=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET competence_2 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_2,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET competence_2 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_2,$idl]);
			}
		}
		if(!empty($_POST['competence_3']))
		{
			if($competence_3==-1){
				$competence_3=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET competence_3 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_3,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET competence_3 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_3,$idl]);
			}
		}
		if(!empty($_POST['competence_4']))
		{
			if($competence_4==-1){
				$competence_4=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET competence_4 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_4,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET competence_4 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_4,$idl]);
			}
		}
		if(!empty($_POST['competence_5']))
		{
			if($competence_5==-1){
				$competence_5=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET competence_5 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_5,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET competence_5 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_5,$idl]);
			}
		}
		if(!empty($_POST['competence_6']))
		{
			if($competence_6==-1){
				$competence_6=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET competence_6 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_6,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET competence_6 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_6,$idl]);
			}
		}
		if(!empty($_POST['competence_7']))
		{
			if($competence_7==-1){
				$competence_7=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET competence_7 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_7,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET competence_7 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_7,$idl]);
			}
		}
		if(!empty($_POST['competence_8']))
		{
			if($competence_8==-1){
				$competence_8=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET competence_8 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_8,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET competence_8 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_8,$idl]);
			}
		}
		if(!empty($_POST['competence_9']))
		{
			if($competence_9==-1){
				$competence_9=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET competence_9 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_9,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET competence_9 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_9,$idl]);
			}
		}
		if(!empty($_POST['competence_10']))
		{
			if($competence_10==-1){
				$competence_10=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET competence_10 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_10,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET competence_10 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_10,$idl]);
			}
		}
		if(!empty($_POST['competence_11']))
		{
			if($competence_11==-1){
				$competence_11=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET competence_11 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_11,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET competence_11 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_11,$idl]);
			}
		}
		if(!empty($_POST['competence_12']))
		{
			if($competence_12==-1){
				$competence_12=NULL;
				$maj=$db->PREPARE('UPDATE lawyers SET competence_12 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_12,$idl]);
			}	else{
				$maj=$db->PREPARE('UPDATE lawyers SET competence_12 =? WHERE id_lawyer= ?');
				$maj->execute([$competence_12,$idl]);
			}
		}
		if(!empty($_POST['link_cab']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET link_cab =? WHERE id_lawyer= ?');
			$maj->execute([$link_cab,$idl]);
		}
		if(!empty($_POST['lat']) AND !empty($_POST['lng']))
		{
			$maj=$db->PREPARE('UPDATE lawyers SET lat =?, lng=? WHERE id_lawyer= ?');
			$maj->execute([$latitude,$longitude,$idl]);
		}	else{
			echo "out";
		}
		// echo "<pres>";
		// print_r($_POST);
		// echo "</pres>";
		// echo "++++";

		if(!empty($_FILES['picture']['name']))
			{
        if($_FILES['picture']['size']<3000000)
            {
                if(($_FILES['picture']['type']=='image/jpeg') || ($_FILES['picture']['type']=='image/jpg') || ($_FILES['picture']['type']=='image/png'))
                {
                $img_user = "img_1_user_".$idl;
                $uploaddir = "pictures/pdp_users/".$img_user;
                $delimgdir = "pictures/pdp_users/".$img_user;
                $filetmpname = $_FILES['picture']['tmp_name'];

                unlink($delimgdir);
                move_uploaded_file($filetmpname, $uploaddir);
                }    else{
                    echo "les formats d'images accepts sont uniquement jpeg, jpg et png";
                }

            }    else{
                echo "le poids du fichier doit être inférieur à 3 Mo";
            }

				}

	// header('location:administration_lawyers.php');
	header('location:check_display_lawyer.php?idl='.$idl);
}	else {
	$erreur="vous devez obligatoirement renseigner les champs personnels de l avocat.";
	?><script>
		alert("<?php echo $erreur ?>");
		document.location.href="administration_add_lawyer.php";
		</script>
	<?php
}
 ?>
