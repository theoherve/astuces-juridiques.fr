<?php

include('includes/config.php');
include('includes/connexion_check.php');

if($connected!=1 || $_SESSION['status']<=1){
header('location:index.php');
}


$id=$_GET['id'];
$key=$_GET['key'];
$act=$_GET['act'];

if(!empty($id)){
	if(!empty($key)){
		if(isset($act)){
			if($key=='abo'){
				$up=$db->PREPARE('UPDATE lawyers SET abonnement = ? WHERE id_lawyer=?');
				$up->execute([$act,$id]);
			}	elseif ($key=='vis'){
				$up=$db->PREPARE('UPDATE lawyers SET status = ? WHERE id_lawyer=?');
				$up->execute([$act,$id]);
			}	elseif($key=='prem'){
				$up=$db->PREPARE('UPDATE lawyers SET premium = ? WHERE id_lawyer=?');
				$up->execute([$act,$id]);
			}	elseif($key=='delete'){
				$up=$db->PREPARE('DELETE FROM lawyers WHERE id_lawyer=?');
				$up->execute([$id]);

				$img_user = "img_1_user_".$id;
				$delimgdir = "pictures/pdp_users/".$img_user;
				unlink($delimgdir);
			}
		}
	}
}
header('location:administration_lawyers.php');
 ?>
