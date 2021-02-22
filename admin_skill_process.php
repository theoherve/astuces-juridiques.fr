<?php
include('includes/connexion_check.php');
include('includes/config.php');

if($connected!=1 || $_SESSION['status']<=2){
header('location:index.php');
}

$key=$_GET['key'];
if(!empty($key))
{
	if($key=='dom')
	{
		if(!empty($_POST['domain_id']) && $_POST['domain_id']!='0')
		{
			$check1=$db->PREPARE('SELECT name FROM sub_domains WHERE name = ?');
			$check1->execute([$_POST['input_subdomain']]);
			$check1=$check1->rowCount();
			if($check1==0)
			{
				$add_sub_dom=$db->PREPARE('INSERT INTO sub_domains(id_domain,name) VALUES(?,?)');
				$add_sub_dom->execute([$_POST['domain_id'],$_POST['input_subdomain']]);
			}	else {
				$error="cette compétence existe deja";
			}
		}	else{
			$error="aucun domaine selectionné";}
	}
	if($key=='skill')
	{
		if(!empty($_POST['sub_domain_id'])&&$_POST['sub_domain_id']!=0)
		{
			$check1=$db->PREPARE('SELECT name FROM skills WHERE name = ?');
			$check1->execute([$_POST['skill']]);
			$check1=$check1->rowCount();
			if($check1==0)
			{
				$add_sub_dom=$db->PREPARE('INSERT INTO skills(id_sub_domain,name) VALUES(?,?)');
				$add_sub_dom->execute([$_POST['sub_domain_id'],$_POST['skill']]);
			}	else {
				$error="cette compétence existe deja";
			}
		}	else{
			$error="aucun sous domaine selectionné";}
	}
	if($key=='add_lang')
	{
		if(!empty($_POST['input_language']))
		{
			$check1=$db->PREPARE('SELECT name FROM languages WHERE name = ?');
			$check1->execute([$_POST['input_language']]);
			$check1=$check1->rowCount();
			if($check1==0)
			{
				$add_lang=$db->PREPARE('INSERT INTO languages(name) VALUES(?)');
				$add_lang->execute([$_POST['input_language']]);
			}	else {
				$error="Ce language existe deja";
			}
		}
	}

	if($key=='delskill')
	{
		try{
		$del=$db->PREPARE('DELETE FROM skills WHERE id_sub_domain= ?');
		$del->execute([$_POST['sub_domain_id']]);

		$del=$db->PREPARE('DELETE FROM sub_domains WHERE id_sub_domain= ?');
		$del->execute([$_POST['sub_domain_id']]);
	}catch(Exception $e){
		?><script>
			alert("ce sous domaine est lié à au moins 1 compétence et/ou un article");
			document.location.href="administration_skills.php"
			</script>
		<?php
		$alerte=1;
	}
	}

	if($key=='dellang')
	{
		try{
			$del=$db->PREPARE('DELETE FROM languages WHERE id_language= ?');
			$del->execute([$_GET['id']]);
		}catch(Exception $e){
			?><script>
				alert("cette langue est lié à au moins 1 avocat");
				document.location.href="administration_skills.php"
				</script>
			<?php
			$alerte=1;
	}
	}

	if($key=='del')
	{
		try{
			$del=$db->PREPARE('DELETE FROM skills WHERE id_skill= ?');
			$del->execute([$_GET['id']]);
		}catch(Exception $e){
			?><script>
				alert("cette compétence est lié à au moins 1 avocat");
				document.location.href="administration_skills.php"
				</script>
			<?php
		$alerte=1;
	}
	}
	if($alerte!=1){
	header('location:administration_skills.php');
	}
}	else{
	header('location:index.php');
}
 ?>
