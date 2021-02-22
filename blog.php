<?php
$title="Blog";
include('includes/head.php');
$count = 0;
$reqBlogs = $db->prepare('SELECT * FROM documentations');
$reqBlogs->execute();
$blogs = $reqBlogs->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <body>
    <?php include('includes/header.php'); ?>
    <main>
      <div class="blogContainer">
        <div class="blogTitle">
          <h3>Penchez la balance de votre côté</h3>
        </div>
        <div class="blogContent">
          <?php foreach ($blogs as $blog): ?>
            <?php $count += 1; ?>
            <div class="blog" style="background-image: url('img/img_blog/img_blog_<?php echo $blog['id_documentation']?>');" <?php echo ($count===1) ? "name=\"first\"" : "" ; ?> onclick="window.location.href='article_blog.php?id_documentation=<?php echo $blog['id_documentation']; ?>'">
              <div class="blogText">
                <!-- <center><h2><?php echo $blog['title'];?></h2></center> -->
                <h3 style="font-weight: bold;"><?php echo $blog['title'];?></h3>
                <h5><?php echo $blog['sub_title'];?></h5>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </main>
    <?php include('includes/footer.php'); ?>
  </body>
  <script src="js/modal.js" type="text/javascript"></script>
  <?php include('includes/scripts.php'); ?>
</html>
