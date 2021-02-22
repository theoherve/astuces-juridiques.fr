<?php
$title="Administration";
include('includes/head.php');


if($connected!=1 || $_SESSION['status']<=1){
// header('location:index.php');
echo "oooooo";
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <body>
     <?php include('includes/header_blog.php');?>

     <main>
        <div id="div_alter_blog">
          <h3>Modifier un article</h3>
          <form method="post" action="alter_blog_process.php?id=<?php echo $_GET['id'] ?>" id="blog" enctype="multipart/form-data">
            <?php
            $req=$db->prepare('SELECT * FROM documentations WHERE id_documentation=?');
            $req->execute([$_GET['id']]);
            $placeholder=$req->fetch();
             ?>
            <div class="form-group">
              <label for="title">Titre :</label>
              <input type="text" name="title" placeholder="<?php echo $placeholder['title'] ?>" class="form-control" id="title">
            </div>
            <div class="form-group">
              <label for="sub_title">Sous-titre :</label>
              <input type="text" name="sub_title" placeholder="<?php echo $placeholder['sub_title'] ?>" class="form-control" id="sub_title">
            </div>
            <div class="form-group">
              <label for="img">Image :</label>
              <input type="file" name="miniature" accept="image/jpeg,image/jpg,image/png" id="img">
            </div>
            <label for="content">Contenu :</label>
            <textarea class="summernote" name="content"><?php echo $placeholder['content'] ?></textarea>
              <script>
                $(document).ready(function() {
                    $('.summernote').summernote({
                    height: 300,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: true                  // set focus to editable area after initializing summernote
                  });
                });
              </script>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Modifier</button>
          </form>
        </div>
     </main>
     <?php include('includes/footer.php'); ?>
  </body>
  <script src="js/quilljs.js" type="text/javascript"></script>
  <!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</html>
