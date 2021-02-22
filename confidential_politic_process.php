<?php
  if(($_FILES['newPolitic']['type'] == 'application/pdf')){
    $imgusername = "politiqueDeConfidentialite";
    $uploaddir = "cg/".$imgusername;
    $delimgdir = "cg/".$imgusername;
    $filetmpname = $_FILES['newPolitic']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
    header('location: index.php');
  }else{
    echo "le format d'image accepté est uniquement le pdf";
  }
?>
