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
           <form class="conditionGestion" action="cgv_gestion_process.php" method="post" enctype="multipart/form-data">
             <h1>Condition général de vente</h1>
             <input type="file" name="newCGV">
             <input type="submit" value="Valider">
           </form>
         </main>
       <?php include('includes/footer.php'); ?>
     </body>
     <script src="js/modal.js" type="text/javascript"></script>
 </html>
