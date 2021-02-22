<?php

include('includes/config.php');
include('includes/connexion_check.php');

// print_r($_POST);

var_dump($_FILES);

$imagetype = [
	'image/png',
	'image/jpg',
	'image/jpeg'
];

if(empty($_SESSION['id']) || !isset($_SESSION['status']) || $_SESSION['status']<3){
	header('Location: index.php');
}else{

	if(isset($_POST['title'])
	  && isset($_POST['sub_title'])
	  && isset($_POST['content'])
	  && !empty($_FILES['miniature'])){

	  	if(in_array($_FILES['miniature']['type'],$imagetype)){

				$title = htmlspecialchars(trim($_POST['title']));
				$sub_title = htmlspecialchars(trim($_POST['sub_title']));
				$content = $_POST['content'];

		    $insert = $db->prepare('INSERT INTO documentations (title, sub_title, content) VALUES (	\':title\', \':sub_title\', \':content\')');

				$insert->bindParam(':title', $title, PDO::PARAM_STR);
				$insert->bindParam(':sub_title', $sub_title, PDO::PARAM_STR);
				$insert->bindParam(':content', $content, PDO::PARAM_STR);
				$insert->execute();


				$id_documentation = $db->lastInsertId();
				$imgdocname = "img_blog_".$id_documentation;
	  		$uploaddir = "img/img_blog/".$imgdocname;
	  		$delimgdir = "img/img_blog/".$imgdocname;
	  		$filetmpname = $_FILES['miniature']['tmp_name'];

	  		unlink($delimgdir);
	  		move_uploaded_file($filetmpname, $uploaddir);

				header('Location: blog.php');

	  }else{
	  		echo "les formats d'images acceptés sont uniquement le jpeg, jpg et png";
	  }
	}
}
?>
