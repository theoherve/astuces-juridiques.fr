<?php
include('includes/config.php');
include('includes/connexion_check.php');

print_r($_POST);
print_r($_FILES);

$imagetype = [
	'image/png',
	'image/jpg',
	'image/jpeg'
];

if(empty($_SESSION['id']) || !isset($_SESSION['status']) || $_SESSION['status']<=2){
	header('Location: index.php');
}else{

  if(isset($_POST['objet']) && !empty($_POST['objet'])
    && isset($_POST['id_sub_domain']) && !empty($_POST['id_sub_domain'])
    && isset($_POST['the_tip']) && !empty($_POST['the_tip'])
    && isset($_POST['suggest']) && !empty($_POST['suggest'])
    && isset($_POST['releaseDateTime']) && !empty($_POST['releaseDateTime'])){

      if(in_array($_FILES['picture1']['type'],$imagetype)){
        // print_r($_POST);
        // print_r($_FILES);

				$reqIdDomain = $db->prepare('SELECT * FROM sub_domains WHERE id_sub_domain=:id_sub_domain');
				$reqIdDomain->bindParam(':id_sub_domain', $_POST['id_sub_domain'], PDO::PARAM_INT);
				$reqIdDomain->execute();
				$id_domain_fetch = $reqIdDomain->fetch(PDO::FETCH_ASSOC);

        $objet = htmlspecialchars(trim($_POST['objet']));
        $content = $_POST['the_tip'];
        $suggest = htmlspecialchars(trim($_POST['suggest']));
        $url = htmlspecialchars(trim($_POST['url']));
				date_default_timezone_set('Europe/Paris');
        $release_date = $_POST['releaseDateTime'];
        $publication_date = gmdate("Y-m-d H:i:s");
        $status = '1';
        $id_sub_domain = htmlspecialchars(trim($_POST['id_sub_domain']));
				$id_domain = $id_domain_fetch['id_domain'];
        $id_author = $_SESSION['id'];

        $insert = $db->prepare('INSERT INTO articles (objet, content, suggest, url, release_date, publication_date, status, id_sub_domain, id_domain, id_author) VALUES (:objet, :content, :suggest, :url, :release_date, :publication_date, :status, :id_sub_domain, :id_domain, :id_author)');

        $insert->bindParam(':objet', $objet, PDO::PARAM_STR);
        $insert->bindParam(':content', $content);
        $insert->bindParam(':suggest', $suggest, PDO::PARAM_STR);
        $insert->bindParam(':url', $url, PDO::PARAM_STR);
        $insert->bindParam(':release_date', $release_date);
        $insert->bindParam(':publication_date', $publication_date);
        $insert->bindParam(':status', $status, PDO::PARAM_STR);
        $insert->bindParam(':id_sub_domain', $id_sub_domain, PDO::PARAM_INT);
				$insert->bindParam(':id_domain', $id_domain, PDO::PARAM_INT);
        $insert->bindParam(':id_author', $id_author, PDO::PARAM_STR);
        $insert->execute();

        if(isset($_FILES['picture1']) && !empty($_FILES['picture1'])) {
          $count = 1;
          $id_astuce = $db->lastInsertId();
          $imgdocname = "img_astuce_" . $id_astuce . "_" . $count;
          $uploaddir = "img/img_astuces/" . $imgdocname;
          $delimgdir = "img/img_astuces/" . $imgdocname;
          $filetmpname = $_FILES['picture1']['tmp_name'];

          unlink($delimgdir);
          move_uploaded_file($filetmpname, $uploaddir);
        }

        if(isset($_FILES['picture2']) && !empty($_FILES['picture2'])) {
          $count = 2;
          $id_astuce = $db->lastInsertId();
          $imgdocname = "img_astuce_" . $id_astuce . "_" . $count;
          $uploaddir = "img/img_astuces/" . $imgdocname;
          $delimgdir = "img/img_astuces/" . $imgdocname;
          $filetmpname = $_FILES['picture2']['tmp_name'];

          unlink($delimgdir);
          move_uploaded_file($filetmpname, $uploaddir);
        }

        if(isset($_FILES['picture3']) && !empty($_FILES['picture3'])) {
          $count = 3;
          $id_astuce = $db->lastInsertId();
          $imgdocname = "img_astuce_" . $id_astuce . "_" . $count;
          $uploaddir = "img/img_astuces/" . $imgdocname;
          $delimgdir = "img/img_astuces/" . $imgdocname;
          $filetmpname = $_FILES['picture3']['tmp_name'];

          unlink($delimgdir);
          move_uploaded_file($filetmpname, $uploaddir);
        }

				if(isset($_FILES['picture4']) && !empty($_FILES['picture4'])) {
          $count = 4;
          $id_astuce = $db->lastInsertId();
          $imgdocname = "img_astuce_" . $id_astuce . "_" . $count;
          $uploaddir = "img/img_astuces/" . $imgdocname;
          $delimgdir = "img/img_astuces/" . $imgdocname;
          $filetmpname = $_FILES['picture4']['tmp_name'];

          unlink($delimgdir);
          move_uploaded_file($filetmpname, $uploaddir);
        }

        if(isset($_FILES['picture5']) && !empty($_FILES['picture5'])) {
          $count = 5;
          $id_astuce = $db->lastInsertId();
          $imgdocname = "img_astuce_" . $id_astuce . "_" . $count;
          $uploaddir = "img/img_astuces/" . $imgdocname;
          $delimgdir = "img/img_astuces/" . $imgdocname;
          $filetmpname = $_FILES['picture5']['tmp_name'];

          unlink($delimgdir);
          move_uploaded_file($filetmpname, $uploaddir);
        }

        if(isset($_FILES['picture6']) && !empty($_FILES['picture6'])) {
          $count = 6;
          $id_astuce = $db->lastInsertId();
          $imgdocname = "img_astuce_" . $id_astuce . "_" . $count;
          $uploaddir = "img/img_astuces/" . $imgdocname;
          $delimgdir = "img/img_astuces/" . $imgdocname;
          $filetmpname = $_FILES['picture6']['tmp_name'];

          unlink($delimgdir);
          move_uploaded_file($filetmpname, $uploaddir);
        }

				if(isset($_FILES['picture7']) && !empty($_FILES['picture7'])) {
          $count = 7;
          $id_astuce = $db->lastInsertId();
          $imgdocname = "img_astuce_" . $id_astuce . "_" . $count;
          $uploaddir = "img/img_astuces/" . $imgdocname;
          $delimgdir = "img/img_astuces/" . $imgdocname;
          $filetmpname = $_FILES['picture7']['tmp_name'];

          unlink($delimgdir);
          move_uploaded_file($filetmpname, $uploaddir);
        }

        if(isset($_FILES['picture8']) && !empty($_FILES['picture8'])) {
          $count = 8;
          $id_astuce = $db->lastInsertId();
          $imgdocname = "img_astuce_" . $id_astuce . "_" . $count;
          $uploaddir = "img/img_astuces/" . $imgdocname;
          $delimgdir = "img/img_astuces/" . $imgdocname;
          $filetmpname = $_FILES['picture8']['tmp_name'];

          unlink($delimgdir);
          move_uploaded_file($filetmpname, $uploaddir);
        }

        if(isset($_FILES['picture9']) && !empty($_FILES['picture9'])) {
          $count = 9;
          $id_astuce = $db->lastInsertId();
          $imgdocname = "img_astuce_" . $id_astuce . "_" . $count;
          $uploaddir = "img/img_astuces/" . $imgdocname;
          $delimgdir = "img/img_astuces/" . $imgdocname;
          $filetmpname = $_FILES['picture9']['tmp_name'];

          unlink($delimgdir);
          move_uploaded_file($filetmpname, $uploaddir);
        }

        header('Location: previsu_astuce.php?id_astuce=' . $id_astuce . '');

      }else{
        echo "koo";
      }
    }
}

 ?>
