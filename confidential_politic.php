<?php
include('includes/head.php');

if($connected!=1 || $_SESSION['status']<=1){
header('location:index.php');
}
$title="Gestion";
 ?>

 <!DOCTYPE html>
 <html lang="fr" dir="ltr">
     <?php include('includes/header_publications.php'); ?>
     <body>
         <main>
           <form class="conditionGestion" action="confidential_politic_process.php" method="post" enctype="multipart/form-data">
             <h1>Politique de confidentialité</h1>
             <input type="file" name="newPolitic">
             <input type="submit" value="Valider">
           </form>
         </main>
       <?php include('includes/footer.php'); ?>
     </body>
     <script src="js/modal.js" type="text/javascript"></script>
 </html>
