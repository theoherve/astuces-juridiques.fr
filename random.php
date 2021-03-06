<?php
$title="Aléatoire";
include('includes/head.php');

if(!isset($_GET['num_page'])){
  $num_page = 1;
  $actualPage = 1;
}else{
  $actualPage = $_GET['num_page'];
  $num_page = $_GET['num_page'];
}
$num_page = ($num_page-1)*5;
if($_SERVER['REQUEST_URI']=="/random.php"){
  $_SERVER['REQUEST_URI'].="?";
}


$reqCountAstuces = $db->prepare('SELECT id_article FROM articles WHERE status="2" AND release_date<=NOW()');
$reqCountAstuces->execute();
$allAstuces = $reqCountAstuces->rowCount();

$reqAstuces = $db->prepare('SELECT * FROM articles WHERE status="2" AND release_date<=NOW() ORDER BY RAND() DESC LIMIT :num_page, 5');
$reqAstuces->bindParam(':num_page', $num_page, PDO::PARAM_INT);
$reqAstuces->execute();
$astuces = $reqAstuces->fetchAll(PDO::FETCH_ASSOC);

$reqUsers = $db->prepare('SELECT * FROM users WHERE id_user=:id_user');
$reqUsers->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
$reqUsers->execute();
$profil=$reqUsers->fetch(PDO::FETCH_ASSOC);

$id_reaction = [
  'surprise' => 1,
  'laught' => 2,
  'inlove' => 3,
  'smile' => 4
];
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <body>
    <?php include('includes/header.php'); ?>
    <main>

      <?php foreach ($astuces as $astuce):
        $reqSubDomain = $db->prepare('SELECT name FROM sub_domains WHERE id_sub_domain=:id_sub_domain');
        $reqSubDomain->bindParam(':id_sub_domain', $astuce['id_sub_domain'], PDO::PARAM_INT);
        $reqSubDomain->execute();
        $sub_domain = $reqSubDomain->fetch(PDO::FETCH_ASSOC);

        $reqFavorites = $db->prepare('SELECT * FROM favorites WHERE id_article=:id_article AND id_user=:id_user');
        $reqFavorites->bindParam(':id_article', $astuce['id_article'], PDO::PARAM_INT);
        $reqFavorites->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
        $reqFavorites->execute();
        $favorite = $reqFavorites->fetch();
        ?>

        <div class="astuceContainer">
          <div class="astuceHeader" margin="yes">
            <a type="button" class="btn_modal" data-modal="Warning<?php echo $astuce['id_article'];?>"><img src="pictures/emojis/report.png" alt="Warning"></a>
            <center><h2><?php echo $astuce['objet']; ?></h2></center>
            <?php if($connected == 1){ ?>
              <?php if(empty($favorite)){ ?>
                <a onclick="change_favoris_status(<?php echo $astuce['id_article'] . ',' . $_SESSION['id'];?>)"><div id="imgFavoris<?php echo $astuce['id_article']?>"><img src="pictures/favoris.png" alt="Favoris" style="cursor: pointer;"></div></a>
              <?php }else{ ?>
                <a onclick="change_favoris_status(<?php echo $astuce['id_article'] . ',' . $_SESSION['id'];?>)"><div id="imgFavorisDone<?php echo $astuce['id_article']?>"><img src="pictures/favoris_done.png" alt="Favoris" style="cursor: pointer;"></div></a>
              <?php } ?>
            <?php }else { ?>
              <a href="signup.php"><img src="pictures/favoris.png" alt="Favoris"></a>
            <?php } ?>
          </div>
          <div class="astuceImg" margin="yes">
            <!-- <a type="button" class="btn_modal" data-modal="allImg<?php echo $astuce['id_article'];?>"> -->
              <div id="carouselExampleIndicators<?=$astuce['id_article']?>" class="carousel slide" data-ride="carousel" data-interval="0">
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
               <a class="carousel-control-prev" href="#carouselExampleIndicators<?=$astuce['id_article']?>" role="button" data-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true" style="margin-right: 6em;"></span>
                 <span class="sr-only" style="margin-right: 6em;">Previous</span>
               </a>
               <a class="carousel-control-next" href="#carouselExampleIndicators<?=$astuce['id_article']?>" role="button" data-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true" style="margin-left: 6em;"></span>
                 <span class="sr-only" style="margin-left: 6em;">Next</span>
               </a>
             </div>
            <!-- </a> -->
          </div>
          <div class="astuceContent" margin="yes">
            <div class="ql-snow">
              <div class="ql-editor" style="height: auto;">
                <?php echo $astuce['content']; ?>
              </div>
            </div>
          </div>
          <div class="astuceReaction" margin="yes">
            <?php
            $reqReactions1 = $db->prepare('SELECT id_react_article FROM reacts_articles WHERE id_article=:id_article  AND id_reaction=:id_reaction');
            $reqReactions1->bindParam(':id_article', $astuce['id_article'], PDO::PARAM_INT);
            $reqReactions1->bindParam(':id_reaction', $id_reaction['surprise'], PDO::PARAM_INT);
            $reqReactions1->execute();
            $allReactions1 = $reqReactions1->rowCount();
            ?>
            <div class="astuceSurpise">
              <?php if($connected == 1): ?>
                <a onclick="add_del_reaction(<?php echo $astuce['id_article'] . "," . $id_reaction['surprise'] . "," . $_SESSION['id']?>)"><img src="pictures/emojis/chock.png" alt="Emoji chock" style="cursor: pointer;"></a>
              <?php else: ?>
                <a href="signup.php"><img src="pictures/emojis/chock.png" alt="Emoji chock"></a>
              <?php endif; ?>
              <div id="statNumber1<?php echo $astuce['id_article'] ?>" class="statNumber1">
                <?php
                if (empty($allReactions1)) {
                  echo "0";
                }else {
                  echo $allReactions1;
                }
                ?>
              </div>
            </div>
            <?php
            $reqReactions2 = $db->prepare('SELECT id_react_article FROM reacts_articles WHERE id_article=:id_article  AND id_reaction=:id_reaction');
            $reqReactions2->bindParam(':id_article', $astuce['id_article'], PDO::PARAM_INT);
            $reqReactions2->bindParam(':id_reaction', $id_reaction['laught'], PDO::PARAM_INT);
            $reqReactions2->execute();
            $allReactions2 = $reqReactions2->rowCount();
            ?>
            <div class="astuceLaught">
              <?php if($connected == 1): ?>
                <a onclick="add_del_reaction(<?php echo $astuce['id_article'] . "," . $id_reaction['laught'] . "," . $_SESSION['id']?>)"><img src="pictures/emojis/laught.png" alt="Emoji laught" style="cursor: pointer;"></a>
              <?php else: ?>
                <a href="signup.php"><img src="pictures/emojis/laught.png" alt="Emoji laught"></a>
              <?php endif; ?>
              <div id="statNumber2<?php echo $astuce['id_article'] ?>" class="statNumber2">
                <?php
                if (empty($allReactions2)) {
                  echo "0";
                }else {
                  echo $allReactions2;
                }
                ?>
              </div>
            </div>
            <?php
            $reqReactions3 = $db->prepare('SELECT id_react_article FROM reacts_articles WHERE id_article=:id_article  AND id_reaction=:id_reaction');
            $reqReactions3->bindParam(':id_article', $astuce['id_article'], PDO::PARAM_INT);
            $reqReactions3->bindParam(':id_reaction', $id_reaction['inlove'], PDO::PARAM_INT);
            $reqReactions3->execute();
            $allReactions3 = $reqReactions3->rowCount();
            ?>
            <div class="astuceLove">
              <?php if($connected == 1): ?>
                <a onclick="add_del_reaction(<?php echo $astuce['id_article'] . "," . $id_reaction['inlove'] . "," . $_SESSION['id']?>)"><img src="pictures/emojis/inlove.png" alt="Emoji in love" style="cursor: pointer;"></a>
              <?php else: ?>
                <a href="signup.php"><img src="pictures/emojis/inlove.png" alt="Emoji in love"></a>
              <?php endif; ?>
              <div id="statNumber3<?php echo $astuce['id_article'] ?>" class="statNumber3">
                <?php
                if (empty($allReactions3)) {
                  echo "0";
                }else {
                  echo $allReactions3;
                }
                ?>
              </div>
            </div>
            <?php
            $reqReactions4 = $db->prepare('SELECT id_react_article FROM reacts_articles WHERE id_article=:id_article  AND id_reaction=:id_reaction');
            $reqReactions4->bindParam(':id_article', $astuce['id_article'], PDO::PARAM_INT);
            $reqReactions4->bindParam(':id_reaction', $id_reaction['smile'], PDO::PARAM_INT);
            $reqReactions4->execute();
            $allReactions4 = $reqReactions4->rowCount();
            ?>
            <div class="astuceSmile">
              <?php if($connected == 1): ?>
                <a onclick="add_del_reaction(<?php echo $astuce['id_article'] . "," . $id_reaction['smile'] . "," . $_SESSION['id']?>)"><img src="pictures/emojis/smile.png" alt="Emoji smile" style="cursor: pointer;"></a>
              <?php else: ?>
                <a href="signup.php"><img src="pictures/emojis/smile.png" alt="Emoji smile"></a>
              <?php endif; ?>
              <div id="statNumber4<?php echo $astuce['id_article'] ?>" class="statNumber4">
                <?php
                if (empty($allReactions4)) {
                  echo "0";
                }else {
                  echo $allReactions4;
                }
                ?>
              </div>
            </div>
          </div>
          <div class="horizontalBar" margin="yes">
          </div>
          <div class="astuceSocial" margin="yes">
            <?php
            $reqAllComments = $db->prepare('SELECT id_comment FROM comments WHERE id_article=:id_article');
            $reqAllComments->bindParam(':id_article', $astuce['id_article'], PDO::PARAM_INT);
            $reqAllComments->execute();
            $allComments = $reqAllComments->rowCount();

            $reqAllComments = $db->prepare('SELECT id_answer_comment FROM answers_comments WHERE id_article=:id_article');
            $reqAllComments->bindParam(':id_article', $astuce['id_article'], PDO::PARAM_INT);
            $reqAllComments->execute();
            $allAnswsersComments = $reqAllComments->rowCount();
            $allAllComments = $allComments+$allAnswsersComments;
            ?>
            <a id="buttonComment" onclick="openClose(<?php echo $astuce['id_article'] ?>)" style="cursor: pointer;">Commentaires <?php echo "(" . $allAllComments . ")"; ?></a>
            <div class="socialMedia">
              <a href=""><img src="pictures/social_media/ig.png" alt="Instagram"></a>
              <a href=""><img src="pictures/social_media/share.png" alt="Share"></a>
              <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://51.178.140.232/astuce.php?id_article=43&picture=http://51.178.140.232/pictures/rs.png"><img src="pictures/social_media/fb.png" alt="Facebook"></a>
              <!-- <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://www.astuces-juridiques.fr%2F&picture=http://51.178.140.232/pictures/rs.png"><img src="pictures/social_media/fb.png" alt="Facebook"></a> -->
              <a target="_blank" href="https://twitter.com/intent/tweet?url=http%3A%2F%2Fastuces-juridiques.fr%2Fastuce.php?id_user=43"><img src="pictures/social_media/tw.png" alt="Twitter"></a>
              <!-- <a target="_blank" href="https://twitter.com/intent/tweet?url=http%3A%2F%2F51.178.140.232%2Fastuce.php?id_article=43&text=Découvrez+vos+droits+à+travers+des+illustrations+sérieuses,+claires+et+humoristiques&hashtags=astucesjuridiques,droitpenal"><img src="pictures/social_media/tw.png" alt="Twitter"></a> -->
              <!-- <a target="_blank" href="http://twitter.com/share?url=https://bit.ly/3d4dMew&text=Découvrez+vos+droits+à+travers+des+illustrations+sérieuses,+claires+et+humoristiques&picture=http://51.178.140.232/pictures/rs.png"><img src="pictures/social_media/tw.png" alt="Twitter"></a> -->
            </div>
          </div>
          <div class="astuceComment" margin="yes" id="divComments<?php echo $astuce['id_article']?>">
            <div id="divComment<?php echo $astuce['id_article']?>" name="comments"></div>
            <div class="inputCommentFade"></div>
            <div class="inputComment">
              <!-- <input type="text" name="comment" placeholder="Écrire un commentaire" id="inputComment<?php echo $astuce['id_article']?>" onkeydown="enter(event, <?php echo $astuce['id_article'] . ',' . $_SESSION['id'];?>)"> -->
              <div contenteditable="true" name="comment" id="inputComment<?php echo $astuce['id_article']?>" onkeydown="enter(event, <?php echo $astuce['id_article'] . ',this,' . $_SESSION['id'];?>)" data-placeholder="Écrire un commentaire" style="white-space: pre;"></div>
              <button type="button" name="button" onclick="add_comment(<?php echo $astuce['id_article'] . ',this.previousElementSibling, ' . $_SESSION['id'] ?>)">Publier</button>
            </div>
          </div>
          <div class="astuceFooter">
            <h5>#<?php echo $sub_domain['name']; ?></h5>
            <div>
              <h5 style="display: inline;">Astuce proposée par : </h5>
              <a href="<?php echo $astuce['url']; ?>" style="display: inline;"><?php echo $astuce['suggest']; ?></a>
            </div>
            <div>
              <?php
               $input = $astuce['release_date'];
               $date = strtotime($input);
               echo date('d/m/Y', $date);
              ?>
            </div>
          </div>
          <div class="astuceFooter2">
            <div name="firstAstuceFooter2">
              <span style="margin-right:0.5em;">Astuce proposée par : </span>
              <a href="<?=$astuce['url']?>"><?=$astuce['suggest']?></a>
            </div>
            <div name="secondAstuceFooter2">
              <span>#<?php echo $sub_domain['name']; ?></span>
              <div>
                <?php
                 $input = $astuce['release_date'];
                 $date = strtotime($input);
                 echo date('d/m/Y', $date);
                ?>
              </div>
            </div>
          </div>
        </div>
        <div id="allImg<?php echo $astuce['id_article'];?>" class="modal_bg">
          <div class="mod_content">
            <div class="mod_header">
              <h3>Illustrations</h3>
            </div>
              <div class="mod_main">
                <div id="carouselExampleIndicators<?=$astuce['id_article']?>" class="carousel slide" data-ride="carousel" data-interval="0">
                 <ol class="carousel-indicators">
                   <?php $filename1 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_1';
                   if(file_exists($filename1)){ ?>
                     <li data-target="#carouselExampleIndicators<?=$astuce['id_article']?>" data-slide-to="0" class="active"></li>
                   <?php } ?>
                   <?php $filename2 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_2';
                   if(file_exists($filename2)){ ?>
                     <li data-target="#carouselExampleIndicators<?=$astuce['id_article']?>" data-slide-to="1"></li>
                   <?php } ?>
                   <?php $filename3 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_3';
                   if(file_exists($filename3)){ ?>
                     <li data-target="#carouselExampleIndicators<?=$astuce['id_article']?>" data-slide-to="2"></li>
                   <?php } ?>
                 </ol>
                 <div class="carousel-inner">
                   <?php $filename1 = 'img/img_astuces/img_astuce_'.$astuce['id_article'] . '_1';
                   if(file_exists($filename1)){ ?>
                     <div class="carousel-item active">
                       <center><img src="img/img_astuces/img_astuce_<?php echo $astuce['id_article'] ?>_1" alt="Photo Astuce 1" class="d-block w-100" style="width: 15em;"></center>
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
                 </div>
                 <a class="carousel-control-prev" href="#carouselExampleIndicators<?=$astuce['id_article']?>" role="button" data-slide="prev">
                   <span class="carousel-control-prev-icon" aria-hidden="true" style="margin-right: 8em;"></span>
                   <span class="sr-only" style="margin-right: 8em;">Previous</span>
                 </a>
                 <a class="carousel-control-next" href="#carouselExampleIndicators<?=$astuce['id_article']?>" role="button" data-slide="next">
                   <span class="carousel-control-next-icon" aria-hidden="true" style="margin-left: 8em;"></span>
                   <span class="sr-only" style="margin-left: 8em;">Next</span>
                 </a>
               </div>
             </div>
            <div class="mod_footer">
              <button class="close_mod" data-modal="allImg<?php echo $astuce['id_article'];?>">Retour</button>
            </div>
          </div>
        </div>

        <div id="Warning<?php echo $astuce['id_article'];?>" class="modal_bg_client">
          <div class="mod_content_client">
            <left><a class="close_mod" data-modal="Warning<?php echo $astuce['id_article'];?>"><img src="pictures/croix.svg" alt="Cancel" style="width: 1em; margin-left: 1em; margin-top:1em;"></a></left>
            <div class="mod_main_client">
              <div id="modalClient">
                <form method="post" action="warning_process.php" id="warning<?php echo $astuce['id_article'];?>">
                  <center><h1>Revirement jurisprudentiel</h1></center>
                  <div>
                    <input type="text" name="family_name" placeholder="Nom" value="<?php echo $profil['family_name']; ?>" required>
        						<input type="text" name="first_name" placeholder="Prénom" value="<?php echo $profil['first_name']; ?>" required>
                  </div>
                  <input required type="text" class="form-control" placeholder="Votre e-mail" name="email" value="<?php
                  if($connected == 1){
                    $req = $db->prepare('SELECT email FROM users WHERE id_user = :id_user');
                    $req->bindParam(":id_user", $_SESSION['id'], PDO::PARAM_INT);
                    $req->execute();
                    $res = $req->fetch();
                    echo $res['email'];
                    } ?>">
                  <input type="text" name="objet" placeholder="Objet du message" required>
                  <textarea rows="5" placeholder="Message (Indiquez obligatoirement vos sources)" name="description" required></textarea>
                  <small>On parle de revirement jurisprudentiel quand le sens ou l’interprétation de la loi change dans le temps.
                    <br>Ex : Autrefois, l’adultère entraînait systématiquement un divorce pour faute, aujourd’hui, pas nécessairement.
                    <center><br>« Les vices d’autrefois sont les moeurs d’aujourd’hui » Sénèque</center>
                  </small>
                  <input type="text" name="id_article" style="display: none;" value="<?php echo $astuce['id_article']; ?>" >
                  <input class="close_mod" type="submit" value="Valider">
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <?php
      $totalPages = ceil($allAstuces / 5);
      ?>

      <div class="paginationIndex">
        <?php
        if($totalPages == 0 || $totalPages == 1){
          echo "<a class=\"indexActive\" href=".$_SERVER['REQUEST_URI']."&num_page="."1>" . (1) . "</a>";
        }else if($actualPage == 1){
          echo "<a class=\"indexActive\" href=".$_SERVER['REQUEST_URI']."&num_page=".$actualPage.">" . $actualPage . "</a>";
          echo "...";
          echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."&num_page=".$totalPages.">" . $totalPages . "</a>";
          echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."&num_page=".($actualPage+1) .">" . ">" . "</a>";
        }else if($actualPage != 1 && $actualPage != $totalPages){
          echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."&num_page=".($actualPage-1) .">" . "<" . "</a>";
          echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."&num_page=". 1 .">" . 1 . "</a>";
          echo "...";
          echo "<a class=\"indexActive\" href=".$_SERVER['REQUEST_URI']."&num_page=".$actualPage.">" . $actualPage . "</a>";
          echo "...";
          echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."&num_page=".$totalPages.">" . $totalPages . "</a>";
          echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."&num_page=".($actualPage+1) .">" . ">" . "</a>";
        }else{
          echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."&num_page=".($actualPage-1) .">" . "<" . "</a>";
          echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."&num_page=". 1 .">" . 1 . "</a>";
          echo "...";
          echo "<a class=\"indexActive\" href=".$_SERVER['REQUEST_URI']."&num_page=".$actualPage.">" . $actualPage . "</a>";
        }

        ?>
      </div>
    </main>
    <?php include('includes/footer.php'); ?>
  </body>
  <script src="js/comment.js" type="text/javascript"></script>
  <script src="js/favoris.js" type="text/javascript"></script>
  <script src="js/reactions.js" type="text/javascript"></script>
  <script src="js/modal.js" type="text/javascript"></script>
  <script src="js/quilljs.js" type="text/javascript"></script>
  <?php include('includes/scripts.php'); ?>
</html>
