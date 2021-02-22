<?php
include('includes/config.php');
include('includes/connexion_check.php');
if(isset($_POST['valid_form_connexion']))
{
  include 'API/Mailin.php';
                                        
  if(!empty($_POST['id'] AND !empty($_POST['password'])))
  {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $check= $db->PREPARE('SELECT id_user, email, pseudo, password, status, token FROM users WHERE email = ? OR pseudo = ?');
    $check-> execute(array($id, $id));
    $info_check = $check->fetch();

    if($id==$info_check['email'] OR $id==$info_check['pseudo'])
    {
      if(password_verify($password, $info_check['password']))
      {
        if($info_check['token']==1)
        {
          if(isset($_POST['remember_me']) AND $_POST['remember_me']=='on'){
            setcookie('email',$info_check['email'],time()+365*24*3600,null,null,false,true);
            setcookie('password',$info_check['password'],time()+365*24*3600,null,null,false,true);
          }
          $_SESSION['id']=$info_check['id_user'];
          $_SESSION['status']=$info_check['status'];
          $_SESSION['email']=$info_check['email'];
          header('location: index.php');
          exit;
        } else{
          $erreur = "mail";
        }
      } else{
        $erreur ="password";
      }
    } else{
      $erreur ="nofound";
    }

  } else{
    $erreur ="forms";
  }
  header('location:signup.php?error='.$erreur);
} else{
  header('location:signup.php');
}



 ?>
