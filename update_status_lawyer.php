<?php
include('includes/connexion_check.php');
include('includes/config.php');

if($connected!=1 || $_SESSION['status']<=2){
header('location:index.php');
}

$idl=$_GET['idl'];
$status=$_GET['status'];

if(!empty($status)){
  echo "status ok";
  echo "---->";
  if(!empty($idl)){

    if($status=='ok'){
      $status=1;
      $req=$db->PREPARE('UPDATE lawyers SET status= ? WHERE id_lawyer= ?');
      $req->execute([$status,$idl]);
      $req=$db->PREPARE('UPDATE lawyers SET abonnement= ? WHERE id_lawyer= ?');
      $req->execute([1,$idl]);
      echo "online";
    } else{
      $status=NULL;
      $req=$db->PREPARE('UPDATE lawyers SET status= ? WHERE id_lawyer= ?');
      $req->execute([$status,$idl]);
      echo "offline";
    }
    header('location:administration_lawyers.php');

  } else{
    header('location:administration_lawyers.php');
  }
}else{
  header('location:administration_lawyers.php');
}
?>
