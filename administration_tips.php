<?php
$title="Administration";
include('includes/head.php');

if($connected != 1 || $_SESSION['status'] <= 1){
header('location:index.php');
}
 ?>

 <!DOCTYPE html>
 <html lang="fr">
     <?php include('includes/header_tips.php'); ?>
     <body>
         <main>
           <?php
           $ingenuity = $db->prepare("SELECT id_article, id_sub_domain, content, objet, publication_date, articles.status as art_status, release_date, id_author, source, email FROM articles INNER JOIN users ON articles.id_author = users.id_user WHERE articles.status = 0 ORDER BY id_article DESC");
           $ingenuity->execute();
           $trick_lists = $ingenuity->fetchAll();
           ?>


           <div id="div_admin_tips_purpose">
             <table class="table table-hover">
               <h2 class="tab_title">Astuces proposées</h2>
               <thead>
                 <tr id="trick_menu">
                   <td scope="col" class="first_one">Objet</td>
                   <td scope="col">Date d'envoie</td>
                   <td class="middle_one" scope="col">Consulter</td>
                   <td scope="col">Supprimer</td>
                </tr>
               </thead>
               <tbody>
               <?php foreach ($trick_lists as $trick_list){
                 $objet = $trick_list['objet'];
                 $email = $trick_list['email'];
                 $source = $trick_list['source'];
                 $content = $trick_list['content'];
                 $id = $trick_list['id_article'];
                 ?>
                 <tr>
                   <input type="hidden" id="num" value="<?php echo $trick_list['id_article']; ?>">
                   <th scope="row" class="first_one" id="num"><?php echo $trick_list['objet']; ?></th>
                      <?php
                        $datey=$trick_list['publication_date'];
                        $dateyy=date('d-m-Y  H:i:s',strtotime($datey));
                       ?>
                   <td><?php echo $dateyy; ?></td>
                   <td><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#trick_display<?=$trick_list['id_article'];?>" id="pointer_consult">Consulter</button></td>
                   <td><button type="button" class="btn btn-danger" onclick=window.location.href="delete_astuce.php?id=<?php echo $id; ?>">Supprimer</button></td>
                 </tr>

                 <!-- Modal astuces-->
                 <div class="modal fade" id="trick_display<?=$trick_list['id_article'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                     <div class="modal-content">
                       <div class="modal-header">
                         <h4 class="modal-title" id="trick_displayed_title"><?php echo $objet; ?></h4>

                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                         </button>
                       </div>
                       <div class="modal-body">
                         <p> <?php echo $content; ?><br></p>
                         <p>Sources :<br><?php echo $source; ?><br></p>
                         <p class="modal-title">Auteur : <?php echo $email; ?></p>
                       </div>
                       <div class="modal-footer">
                         <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                       </div>
                     </div>
                   </div>
                 </div>

                 <?php } ?>
              </tbody>
             </table>
            </div>

            <?php
            $warning = $db->prepare("SELECT email, id_warning, title, articles.objet as article_title, warnings.id_article, warnings.id_user, description, source, articles.id_article, content, objet, warnings.publication_date FROM warnings INNER JOIN articles ON articles.id_article = warnings.id_article INNER JOIN users ON warnings.id_user = users.id_user ORDER BY id_warning DESC");
            $warning->execute();
            $reverses = $warning->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div id="div_admin_tips_revirement">
             <table class="table table-hover">
               <h2 class="tab_title">Revirement jurisprudentiel</h2>
               <thead>
                 <tr id="trick_menu">
                   <td scope="col">Titre de l'article</td>
                   <td scope="col">Problème</td>
                   <td scope="col">Supprimer</td>
                </tr>
               </thead>
               <tbody>
                 <?php foreach ($reverses as $reverse){ ?>

                 <tr>
                   <td><a class="text-primary" data-toggle="modal" data-target="Modal_Warning_Article"><?php echo $reverse['article_title']; ?></a></td>
                   <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Warning_Problem<?=$reverse['id_warning']?>">Consulter</button></td>
                   <td><button type="button" class="btn btn-danger" onclick="window.location.href='delete_revirement.php?id=<?php echo $reverse['id_warning']; ?>'">Supprimer</button></td>
                 </tr>

                 <!-- modal Warnings -->
                 <div class="modal fade" id="Modal_Warning_Problem<?=$reverse['id_warning']?>" tabindex="-1" role="dialog" aria-labelledby="Modal_Warning_Problem_Title" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                     <div class="modal-content">
                       <div class="modal-header">
                         <h5 class="modal-title" id="Modal_Warning_Problem_Title">Objet : <?php echo $reverse['title']; ?></h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                       <div class="modal-body">
                         <p>Message : </br><?php echo $reverse['description']; ?></p></br>  
                         <p>Par: <?php echo $reverse['email']; ?></p>
                       </div>
                       <div class="modal-footer">
                         <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                       </div>
                     </div>
                   </div>
                 </div>

               <?php } ?>
               </tbody>
              </table>
            </div>
         </main>
       <?php include('includes/footer.php'); ?>
     </body>
     <script src="js/modal.js" type="text/javascript"></script>
     <?php include('includes/scripts.php'); ?>
 </html>
