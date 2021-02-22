<?php
include('includes/connexion_check.php');
include('includes/config.php');
function compressImage($source, $destination, $quality) {
  $info = getimagesize($source);

  if ($info['mime'] == 'image/jpeg')
    $image = imagecreatefromjpeg($source);

  elseif ($info['mime'] == 'image/gif')
    $image = imagecreatefromgif($source);

  elseif ($info['mime'] == 'image/png')
    $image = imagecreatefrompng($source);

  imagejpeg($image, $destination, $quality);
}
if(isset($_POST['validate'])){


  $requser=$db->prepare("SELECT * FROM users WHERE id_user= ?");
  $requser->execute(array($_SESSION['id']));

  while ($user=$requser->fetch())
  {
  	// -------------Modification du profil---------------

  	if(!empty($_POST['new_first_name']) AND $_POST['new_first_name'] != $user['first_name'])
  	   {
  	      $newfirstname = $_POST['new_first_name'];
  	      $insertfirstname = $db->prepare("UPDATE users SET first_name = ? where id_user= ?");
  	      $insertfirstname->execute(array($newfirstname,$_SESSION['id']));
  	      // header('location: profil.php');
  	   }
  	if(!empty($_POST['new_family_name']) AND $_POST['new_family_name'] != $user['family_name'])
  	   {
  	      $newfamilyname = $_POST['new_family_name'];
  	      $insertfamilyname = $db->prepare("UPDATE users SET family_name = ? where id_user= ?");
  	      $insertfamilyname->execute(array($newfamilyname,$_SESSION['id']));
  	      // header('location: profil.php');
  	   }
       if(!empty($_POST['new_description_public']) AND $_POST['new_description_public'] != $user['description_public'])
     	   {
     	      $newDesciptionPublic = $_POST['new_description_public'];
     	      $insertDescription = $db->prepare("UPDATE users SET description_public = ? where id_user= ?");
     	      $insertDescription->execute(array($newDesciptionPublic, $_SESSION['id']));
     	      // header('location: profil.php');
     	   }
     if(!empty($_POST['new_pseudo']) AND $_POST['new_pseudo'] != $user['pseudo'])
   	   {
   	      $newpseudo = $_POST['new_pseudo'];
   	      $insertpseudo = $db->prepare("UPDATE users SET pseudo = ? where id_user= ?");
   	      $insertpseudo->execute(array($newpseudo,$_SESSION['id']));
   	      // header('location: profil.php');
   	   }
     if(!empty($_POST['new_sexe']) AND $_POST['new_sexe'] != $user['sexe'])
   	   {
   	      $newsexe = $_POST['new_sexe'];
   	      $insertsexe = $db->prepare("UPDATE users SET sexe = ? where id_user= ?");
   	      $insertsexe->execute(array($newsexe,$_SESSION['id']));
   	      // header('location: profil.php');
   	   }
  	if(!empty($_POST['new_email']) AND $_POST['new_email'] != $user['email'])
  	   {
  	      $newemail = $_POST['new_email'];
  	      $insertemail = $db->prepare("UPDATE users SET email = ? where id_user= ?");
  	      $insertemail->execute(array($newemail,$_SESSION['id']));
  	      // header('location: profil.php');
  	   }
     if(!empty($_POST['new_birthday']) AND $_POST['new_birthday'] != $user['birthday'])
   	   {
   	      $newbirthday = $_POST['new_birthday'];
   	      $insertemail = $db->prepare("UPDATE users SET birthday = ? where id_user= ?");
   	      $insertemail->execute(array($newbirthday,$_SESSION['id']));
   	      // header('location: profil.php');
   	   }
  	if(!empty($_POST['new_password1']) AND !empty($_POST['new_password2']) AND $_POST['new_password1']==$_POST['new_password2'] AND $_POST['new_password1'] != $user['password'] AND $_POST['old_password'] == $user['password'])
  	   {
  	      $newpassword = $_POST['new_password1'];
  	      $insertpassword = $db->prepare("UPDATE users SET password = ? where id_user= ?");
  	      $insertpassword->execute(array($newpassword,$_SESSION['id']));
  	      // header('location: profil.php');
       }
  	// if(!empty($_POST['newadresse']) AND $_POST['newadresse'] != $user['adresse'])
  	//    {
  	//       $newgender = $_POST['newadresse'];
  	//       $insertgender = $db->prepare("UPDATE users SET address = ? where id_user= ?");
  	//       $insertgender->execute(array($newgender,$_SESSION['id']));
  	//       header('location: profil.php');
  	//    }
       // if(!empty($_POST['newzip']) AND $_POST['newzip'] != $user['zip_code'])
       //    {
       //       $newzip = $_POST['newzip'];
       //       $insertfirstname = $db->prepare("UPDATE users SET zip_code = ? where id_user= ?");
       //       $insertfirstname->execute(array($newzip,$_SESSION['id']));
       //       echo "ok";
       //       header('location: profil.php');
       //    }

 if(!empty($_FILES['profilePicture']['name']))
	   {
       // Getting file name
       $filename = "img_user_".$user['id_user'];
       // Valid extension
       $valid_ext = array('image/png','image/jpeg','image/jpg');
       // Location
       $location = "img/img_users/".$filename;
       // file extension
       $file_extension = $_FILES['profilePicture']['type'];
       $file_extension = strtolower($file_extension);

       // Check extension
       if(in_array($file_extension,$valid_ext)){
         // Compress Image
         $imgusername = "img_user_".$user['id_user'];
         $uploaddir = "img/img_users/".$imgusername;
         $delimgdir = "img/img_users/".$imgusername;
         $filetmpname = $_FILES['profilePicture']['tmp_name'];
         move_uploaded_file($filetmpname, $uploaddir);

         compressImage($location,$location,60);
         header('location: profil.php');
         exit;

       }else{
         header('location: profil.php?format');
         exit;
       }
     }else {
       header('location: profil.php');
     }
}


}else {
header('location: profil.php');
}


?>
