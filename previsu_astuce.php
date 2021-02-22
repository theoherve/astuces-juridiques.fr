<?php
$title="Administration";
include('includes/head.php');

if($connected !=1 || $_SESSION['status']<=1){
header('location: index.php');
}

$req = $db->prepare('SELECT * FROM articles WHERE id_article=:id_astuce');
$req->bindParam(':id_astuce', $_GET['id_astuce'], PDO::PARAM_INT);
$req->execute();
$astuce = $req->fetch(PDO::FETCH_ASSOC);

$reqSubDomain = $db->prepare('SELECT name FROM sub_domains WHERE id_sub_domain=:id_sub_domain');
$reqSubDomain->bindParam(':id_sub_domain', $astuce['id_sub_domain'], PDO::PARAM_INT);
$reqSubDomain->execute();
$sub_domain = $reqSubDomain->fetch(PDO::FETCH_ASSOC);

 ?>

 <!DOCTYPE html>
 <html lang="fr" dir="ltr">
     <?php include('includes/header_publications.php'); ?>
     <body>
         <main>
           <div class="astuceContainer">
             <div class="astuceHeader" margin="yes">
               <a href=""><img src="pictures/emojis/report.png" alt="Warning"></a>
               <h2><?php echo $astuce['objet']; ?></h2>
               <a href=""><img src="pictures/favoris.png" alt="Favoris"></a>
             </div>
             <div class="astuceImg" margin="yes">
               <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="0">
                 <ol class="carousel-indicators">
                   <?php $filename1 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_1';
                   if(file_exists($filename1)){ ?>
                     <li data-target="#carouselExampleIndicators<?=$astuce['id_article'];?>" data-slide-to="0" class="active"></li>
                   <?php } ?>
                   <?php $filename2 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_2';
                   if(file_exists($filename2)){ ?>
                     <li data-target="#carouselExampleIndicators<?=$astuce['id_article'];?>" data-slide-to="1"></li>
                   <?php } ?>
                   <?php $filename3 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_3';
                   if(file_exists($filename3)){ ?>
                     <li data-target="#carouselExampleIndicators<?=$astuce['id_article'];?>" data-slide-to="2"></li>
                   <?php } ?>
                   <?php $filename4 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_4';
                   if(file_exists($filename4)){ ?>
                     <li data-target="#carouselExampleIndicators<?=$astuce['id_article'];?>" data-slide-to="3"></li>
                   <?php } ?>
                   <?php $filename5 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_5';
                   if(file_exists($filename5)){ ?>
                     <li data-target="#carouselExampleIndicators<?=$astuce['id_article'];?>" data-slide-to="4"></li>
                   <?php } ?>
                   <?php $filename6 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_6';
                   if(file_exists($filename6)){ ?>
                     <li data-target="#carouselExampleIndicators<?=$astuce['id_article'];?>" data-slide-to="5"></li>
                   <?php } ?>
                   <?php $filename7 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_7';
                   if(file_exists($filename7)){ ?>
                     <li data-target="#carouselExampleIndicators<?=$astuce['id_article'];?>" data-slide-to="6"></li>
                   <?php } ?>
                   <?php $filename8 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_8';
                   if(file_exists($filename8)){ ?>
                     <li data-target="#carouselExampleIndicators<?=$astuce['id_article'];?>" data-slide-to="7"></li>
                   <?php } ?>
                   <?php $filename9 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_9';
                   if(file_exists($filename9)){ ?>
                     <li data-target="#carouselExampleIndicators<?=$astuce['id_article'];?>" data-slide-to="8"></li>
                   <?php } ?>

                 </ol>
                 <div class="carousel-inner">
                   <?php $filename1 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_1';
                   if(file_exists($filename1)){ ?>
                     <div class="carousel-item active">
                       <center><img src="img/img_astuces/img_astuce_<?php echo $astuce['id_article'] ?>_1" alt="Photo Astuce 1" class="d-block w-100" style="width: 15em;"></center>
                     </div>
                   <?php } ?>
                   <?php $filename2 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_2';
                   if(file_exists($filename2)){ ?>
                     <div class="carousel-item">
                       <center><img src="img/img_astuces/img_astuce_<?php echo $astuce['id_article'] ?>_2" alt="Photo Astuce 2" class="d-block w-100" style="width: 15em;"></center>
                     </div>
                   <?php } ?>
                   <?php $filename3 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_3';
                   if(file_exists($filename3)){ ?>
                     <div class="carousel-item">
                       <center><img src="img/img_astuces/img_astuce_<?php echo $astuce['id_article'] ?>_3" alt="Photo Astuce 3" class="d-block w-100" style="width: 15em;"></center>
                     </div>
                   <?php } ?>
                   <?php $filename4 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_4';
                   if(file_exists($filename4)){ ?>
                     <div class="carousel-item">
                       <center><img src="img/img_astuces/img_astuce_<?php echo $astuce['id_article'] ?>_4" alt="Photo Astuce 4" class="d-block w-100" style="width: 15em;"></center>
                     </div>
                   <?php } ?>
                   <?php $filename5 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_5';
                   if(file_exists($filename5)){ ?>
                     <div class="carousel-item">
                       <center><img src="img/img_astuces/img_astuce_<?php echo $astuce['id_article'] ?>_5" alt="Photo Astuce 5" class="d-block w-100" style="width: 15em;"></center>
                     </div>
                   <?php } ?>
                   <?php $filename6 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_6';
                   if(file_exists($filename6)){ ?>
                     <div class="carousel-item">
                       <center><img src="img/img_astuces/img_astuce_<?php echo $astuce['id_article'] ?>_6" alt="Photo Astuce 6" class="d-block w-100" style="width: 15em;"></center>
                     </div>
                   <?php } ?>
                   <?php $filename7 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_7';
                   if(file_exists($filename7)){ ?>
                     <div class="carousel-item">
                       <center><img src="img/img_astuces/img_astuce_<?php echo $astuce['id_article'] ?>_7" alt="Photo Astuce 7" class="d-block w-100" style="width: 15em;"></center>
                     </div>
                   <?php } ?>
                   <?php $filename8 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_8';
                   if(file_exists($filename8)){ ?>
                     <div class="carousel-item">
                       <center><img src="img/img_astuces/img_astuce_<?php echo $astuce['id_article'] ?>_8" alt="Photo Astuce 8" class="d-block w-100" style="width: 15em;"></center>
                     </div>
                   <?php } ?>
                   <?php $filename9 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_9';
                   if(file_exists($filename9)){ ?>
                     <div class="carousel-item">
                       <center><img src="img/img_astuces/img_astuce_<?php echo $astuce['id_article'] ?>_9" alt="Photo Astuce 9" class="d-block w-100" style="width: 15em;"></center>
                     </div>
                   <?php } ?>
                 </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true" style="margin-right: 8em;"></span>
                  <span class="sr-only" style="margin-right: 8em;">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true" style="margin-left: 8em;"></span>
                  <span class="sr-only" style="margin-left: 8em;">Next</span>
                </a>
              </div>
             </div>
             <div class="astuceContent" margin="yes">
               <div class="ql-snow">
                 <div class="ql-editor">
                   <?php echo $astuce['content']; ?>
                 </div>
               </div>
             </div>
             <div class="astuceReaction" margin="yes">
               <div class="astuceSurpise">
                 <img src="pictures/emojis/chock.png" alt="Emoji chock">
                 <div class="statNumber">
                   0
                 </div>
               </div>
               <div class="astuceLaught">
                 <img src="pictures/emojis/laught.png" alt="Emoji laught">
                 <div class="statNumber">
                   0
                 </div>
               </div>
               <div class="astuceLove">
                 <img src="pictures/emojis/inlove.png" alt="Emoji in love">
                 <div class="statNumber">
                   0
                 </div>
               </div>
               <div class="astuceSmile">
                 <img src="pictures/emojis/smile.png" alt="Emoji smile">
                 <div class="statNumber">
                   0
                 </div>
               </div>
             </div>
             <div class="horizontalBar" margin="yes">
             </div>
             <div class="astuceSocial" margin="yes">
               <button type="button" id="textHeader11" name="comment">Commentaires</button>
               <div class="socialMedia">
                 <a href=""><img src="pictures/social_media/share.png" alt="Share"></a>
                 <a href=""><img src="pictures/social_media/fb.png" alt="Facebook"></a>
                 <a href=""><img src="pictures/social_media/ig.png" alt="Instagram"></a>
                 <a href=""><img src="pictures/social_media/tw.png" alt="Twitter"></a>
               </div>
             </div>
             <div class="astuceComment" margin="yes">
             </div>
             <div class="astuceFooter">
               <h5>#<?php echo $sub_domain['name']; ?></h5>
               <div>
                 <h5 style="display: inline;">Astuce proposée par : </h5>
                 <a href="" style="display: inline;"><?php echo $astuce['suggest']; ?></a>
               </div>
               <div>
                 <?php
                  $input = $astuce['release_date'];
                  $date = strtotime($input);
                  echo date('d/m/Y', $date);
                 ?>
               </div>
             </div>
           </div>
           <div class="buttonsPrevisu">
             <button type="button" id="textHeader11" name="validate" onclick="window.location.href='administration.php'">Mettre en attente</button>
             <a href="change_article_status.php?id_article=<?php echo $astuce['id_article'] . "&status=" . $astuce['status']?>" id="textHeader11">Mettre en ligne</a>
           </div>
         </main>
       <?php include('includes/footer.php'); ?>
     </body>
     <script src="js/modal.js" type="text/javascript"></script>
 </html>
