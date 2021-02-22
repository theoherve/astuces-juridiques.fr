<?php
$title="Article de blog";
include('includes/head.php');

$reqBlog = $db->prepare('SELECT * FROM documentations WHERE id_documentation=:id_documentation');
$reqBlog->bindParam(':id_documentation', $_GET['id_documentation'], PDO::PARAM_INT);
$reqBlog->execute();
$blog = $reqBlog->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <body>
    <?php include('includes/header.php'); ?>
    <main>
      <div class="articleBlogContainer">
        <center><h1><?php echo $blog['title']; ?></h1></center>
        <img src="img/img_blog/img_blog_<?php echo $blog['id_documentation']; ?>" alt="Image de blog">
        <div class="ql-snow">
          <div class="ql-editor" style="margin: 0% 18%; height: auto; padding:0px;">
            <?php echo $blog['content']; ?>
          </div>
        </div>
      </div>
    </main>
    <?php include('includes/footer.php'); ?>
  </body>
  <?php include('includes/scripts.php'); ?>
</html>
