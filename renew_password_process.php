<?php
include('includes/config.php');
$key=$_GET['key'];
$id=$_GET['id'];
if(!isset($key) || empty($key) || !isset($id) || empty($id)){
 header('location:index.php');
 exit;
}
$password=$_POST['password1'];
$password_check=$_POST['password2'];
$change=$db->PREPARE('SELECT email FROM users WHERE id_user=?');
$change->execute([$id]);
$final=$change->fetch();
$email=$final['email'];
$password_final = password_hash($password, PASSWORD_DEFAULT);
if(isset($password) AND !empty($password) AND isset($password_check) AND !empty($password_check))
{
  if(password_verify($email, $key))
  {
    if($password==$password_check)
    {
      if(strlen($password)>=7)
      {
        if(preg_match("<[0-9]>", $password))
        {
          $update=$db->PREPARE('UPDATE users SET password=? WHERE id_user=?');
          $update->execute([$password_final,$id]);
          $erreur='Le mot de passe à bien été modifié.';
          ?><script>alert('<?php echo($erreur) ?>');
           document.location.href="signup.php";
          </script><?php
        } else{
          $error= "Le mot de passe doit également etre composé d un chiffre";
        }
      } else{
        $error="le mot de passe doit faire au moins 7 caractéres";
      }
    } else{
      $error='les deux mots de passe doivent être identiques.';
    }
  } else{
    header('location:index.php');
  }
} else{
  $error='veuillez remplir tous les champs';
}
?><script>alert('<?php echo($error) ?>');
 document.location.href="renew_password.php?key=<?php echo $_GET['key'] ?>&id=<?php echo $_GET['id']?>"
</script><?php

?>
