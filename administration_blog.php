<?php
$title="Administration";
include('includes/head.php');


if($connected!=1 || $_SESSION['status']<=1){
header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
   <body>
     <?php include('includes/header_blog.php');?>
       <main>
         <div id="table_trick">
           <table class="table table-hover">
             <thead>
               <h2>Blog juridique</h2>
               <tr id="trick_menu">            <!-- !!!! -->
                 <td scope="col">Titre</td>
                 <td scope="col">Visualiser</td>
                 <td scope="col">Modifier</td>
                 <td scope="col">Supprimer</td>
               </tr>
             </thead>
             <tbody>
               <?php
                $juris_tuto = $db->prepare("SELECT * FROM documentations");
                $juris_tuto->execute();
                $blogs = $juris_tuto->fetchAll(PDO::FETCH_ASSOC);
                foreach($blogs as $blog){?>
               <tr>
                 <th><?php echo $blog['title']; ?></th>
                 <th><button id="consult_point" type="button" data-toggle="modal" data-target="#modalBlog<?=$blog['id_documentation']?>" class="btn btn-primary">Consulter</button></th>
                 <th><button type="button" class="btn btn-warning"  onclick="window.location.href='admin_alter_blog.php?id=<?=$blog['id_documentation']?>'">Modifier</button></th>

                 <th><button type="button" onclick="window.location.href='/delete_blog.php?id=<?=$blog['id_documentation']?>'" class="btn btn-danger">Supprimer</button></th>
               </tr>
            </tbody>

            <div class="modal fade" id="modalBlog<?=$blog['id_documentation']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-bg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="trick_displayed_title"><?php echo $blog['title']; ?></h4><br>
                    <h5 class="modal-title"><?php echo $blog['sub_title']; ?></h5>
                  </div>
                  <div class="modal-body">
                    <div class="ql-snow">
                      <div class="ql-editor">
                        <img src="img/img_blog/img_blog_<?php echo $blog['id_documentation']; ?>" alt="image du blog">
                        <?php echo $blog['content']; ?>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
            </div>

              <?php } ?>
           </table>
          </div>

       </main>
       <?php include('includes/footer.php'); ?>
   </body>
   <script type="text/javascript" src=visu_trick.js></script>
   <script src="js/modal.js" type="text/javascript"></script>
   <script src="js/quilljs.js" type="text/javascript"></script>
</html>
