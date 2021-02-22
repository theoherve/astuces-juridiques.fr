<?php
  if(($_FILES['newCGU']['type'] == 'application/pdf')){
    $imgusername = "CGU";
    $uploaddir = "cg/".$imgusername;
    $delimgdir = "cg/".$imgusername;
    $filetmpname = $_FILES['newCGU']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
    header('location: index.php');
  }else{
    echo "le format d'image accepté est uniquement le pdf";
  }
?>
