<?php
  if(($_FILES['newCGV']['type'] == 'application/pdf')){
    $imgusername = "CGV";
    $uploaddir = "cg/".$imgusername;
    $delimgdir = "cg/".$imgusername;
    $filetmpname = $_FILES['newCGV']['tmp_name'];

    unlink($delimgdir);
    move_uploaded_file($filetmpname, $uploaddir);
    header('location: index.php');
  }else{
    echo "le format d'image accepté est uniquement le pdf";
  }
?>
