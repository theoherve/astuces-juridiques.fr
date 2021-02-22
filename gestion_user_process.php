<?php
include('includes/config.php');

if(isset($_POST['form_modinscription']))
{
	if(!empty($_POST['id_user']))
	{
		$id=$_POST['id_user'];
		if(!empty($_POST['newfirstname']))
		   {
		      $newfirstname = $_POST['newfirstname'];
		      $insertfirstname = $db->prepare("UPDATE users SET first_name = ? where id_user= ?");
		      $insertfirstname->execute(array($newfirstname,$id));
		      header('location: administration_users.php');
		   }
		if(!empty($_POST['newfamilyname']))
		   {
		      $newfamilyname = $_POST['newfamilyname'];
		      $insertfamilyname = $db->prepare("UPDATE users SET family_name = ? where id_user= ?");
		      $insertfamilyname->execute(array($newfamilyname,$id));
		      header('location: administration_users.php');
		   }
		if(!empty($_POST['newemail']))
		   {
		      $newemail = $_POST['newemail'];
		      $insertemail = $db->prepare("UPDATE users SET email = ? where id_user= ?");
		      $insertemail->execute(array($newemail,$id));
		      header('location: administration_users.php');
		   }
		if(!empty($_POST['newpseudo']))
		   {
		      $newpseudo = $_POST['newpseudo'];
		      $insertpseudo = $db->prepare("UPDATE users SET pseudo = ? where id_user= ?");
		      $insertpseudo->execute(array($newpseudo,$id));
		      header('location: administration_users.php');
		   }
			 if(!empty($_POST['status']))
					{
						 $status = $_POST['status'];
						 $up = $db->prepare("UPDATE users SET status = ? where id_user= ?");
						 $up->execute(array($status,$id));
						 header('location: administration_users.php');
					}
  }	else{
			echo "vous n'avez pas renseigné l'id de l'utilisateur à modifier";
 	}
}	else{
	header('location:index.php');
}
?>
