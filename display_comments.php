<?php
include('includes/config.php');
include('includes/connexion_check.php');
date_default_timezone_set('Europe/Paris');

$id_article = $_GET['id_article'];
$position = 0;

$reqComments = $db->prepare('SELECT * FROM comments WHERE  id_article=:id_article');
$reqComments->bindParam(':id_article', $id_article, PDO::PARAM_INT);
$reqComments->execute();
$comments = $reqComments->fetchAll(PDO::FETCH_ASSOC);

if(empty($comments)){
  // echo "<h1>Il n'y a aucun commentaire</h1>";
}else{
  foreach ($comments as $comment) {
    $reqUser = $db->prepare('SELECT id_user, pseudo FROM users WHERE id_user=:id_user');
    $reqUser->bindParam(':id_user', $comment['id_user'], PDO::PARAM_INT);
    $reqUser->execute();
    $user = $reqUser->fetch();

    $reqIdArticle = $db->prepare('SELECT id_article FROM comments WHERE id_comment=:id_comment');
    $reqIdArticle->bindParam(':id_comment', $comment['id_comment'], PDO::PARAM_INT);
    $reqIdArticle->execute();
    $id_article = $reqIdArticle->fetch();

    $reqAllLikesUser = $db->prepare('SELECT id_comment_like FROM comments_likes WHERE id_comment=:id_comment AND id_user=:id_user');
		$reqAllLikesUser->bindParam(':id_comment', $comment['id_comment'], PDO::PARAM_INT);
    $reqAllLikesUser->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
		$reqAllLikesUser->execute();
		$allLikesUser = $reqAllLikesUser->rowCount();

		$reqAllLikes = $db->prepare('SELECT id_comment_like FROM comments_likes WHERE id_comment=:id_comment');
		$reqAllLikes->bindParam(':id_comment', $comment['id_comment'], PDO::PARAM_INT);
		$reqAllLikes->execute();
		$allLikes = $reqAllLikes->rowCount();

    $reqAnswersComments = $db->prepare('SELECT * FROM answers_comments WHERE id_comment=:id_comment AND id_article=:id_article');
		$reqAnswersComments->bindParam(':id_comment', $comment['id_comment'], PDO::PARAM_INT);
    $reqAnswersComments->bindParam(':id_article', $id_article['id_article'], PDO::PARAM_INT);
		$reqAnswersComments->execute();
		$answersComments = $reqAnswersComments->fetchAll(PDO::FETCH_ASSOC);

    // print_r($reqAnswersComments->debugDumpParams());

    $publication_date = $comment['publication_date'];
    $year = gmdate('Y', strtotime($publication_date));
    $month = gmdate('m', strtotime($publication_date));
    $day = gmdate('d', strtotime($publication_date));
    $hour = gmdate('H', strtotime($publication_date));
    $min = gmdate('i', strtotime($publication_date));
    $seconde = gmdate('s', strtotime($publication_date));
    $nowYear = gmdate('Y');
    $nowMonth = gmdate('m');
    $nowDay = gmdate('d');
    $nowHour = gmdate('H');
    $nowHour-= 2;
    $nowMin = gmdate('i');
    $nowSeconde = date('s');
    $sinceYear =  $nowYear - $year;
    $monthSince = $nowMonth - $month;
    $daySince = $nowDay - $day;
    $hourSince = $nowHour - $hour;
    $minSince = $nowMin - $min;
    $secondeSince = $nowSeconde - $seconde;

		if($position == 0){?>
      <div class="commentAndAnswer">
  			<div class="commentLeft" id="comment<?=$comment['id_comment']?>">
          <div class="CommentColumnLeft">
  			     <div name="horizontal">
  			          <div name="divOneComment"><small><a href="public_profile.php?id_user=<?=$user['id_user']?>">@<?=$user['pseudo']?></a></small><br><span><?=$comment['text']?></span></div>
      <?php if(isset($_SESSION['id'])){
        echo "<a onclick=\"change_like_status('" . $user['pseudo'] . "'" . ',' . $id_article['id_article'] . ',' . $comment['id_comment'] . ")\" style=\"cursor: pointer;\">";
      }?>
      <div id="like<?=$comment['id_comment']?>" style="color: white; margin-left: 1em;"> <?php echo (!empty($allLikesUser)) ? "<img src=\"pictures/likeLeftBlue.png\" alt=\"Like\"> " : "<img src=\"pictures/likeLeftGrey.png\" alt=\"Like\">";
      if(isset($_SESSION['id'])){
        echo "</a>";
      }?>
          <a type="button" class="btn_modal" name="usersLikes" data-modal="usersLikes<?=$id_article['id_article']?>" onclick="usersLikes(<?=$id_article['id_article']. ','. $comment['id_comment']?>)"><?=$allLikes?></a></div>
			   </div>
         <div class="answerLine">
			<?php echo "<p onclick=\"answer('" . $user['pseudo'] . "'" . ',' . $id_article['id_article'] . ',' . $comment['id_comment'] . ',' . $_SESSION['id'] . ")\" style=\"display: inline-block;\">Répondre</p>";
      if($sinceYear > 0){
        echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $sinceYear . " ans ";
        if(isset($_SESSION['id']) && $_SESSION['status']>=2){
          echo "<p onclick=\"delComment(".$comment['id_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
        }
        echo "</div>";
      }elseif($monthSince > 0){
        echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $monthSince . " mois ";
        if(isset($_SESSION['id']) && $_SESSION['status']>=2){
          echo "<p onclick=\"delComment(".$comment['id_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
        }
        echo "</div>";
      }elseif($daySince > 0){
        echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $daySince . " jours ";
        if(isset($_SESSION['id']) && $_SESSION['status']>=2){
          echo "<p onclick=\"delComment(".$comment['id_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
        }
        echo "</div>";
      }elseif($hourSince > 0){
        echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $hourSince . " heures ";
        if(isset($_SESSION['id']) && $_SESSION['status']>=2){
          echo "<p onclick=\"delComment(".$comment['id_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
        }
        echo "</div>";
      }elseif($minSince > 0){
        echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $minSince . " minutes ";
        if(isset($_SESSION['id']) && $_SESSION['status']>=2){
          echo "<p onclick=\"delComment(".$comment['id_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
        }
        echo "</div>";
      }elseif($secondeSince > 0){
        echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $secondeSince . " secondes ";
        if(isset($_SESSION['id']) && $_SESSION['status']>=2){
          echo "<p onclick=\"delComment(".$comment['id_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
        }
        echo "</div>";
      }
          echo "</div>";
        echo "</div>";
      echo "</div>";
      if(!empty($answersComments)){
        foreach($answersComments as $answerComment){

          $reqUserAnswer = $db->prepare('SELECT id_user, pseudo FROM users WHERE id_user=:id_user');
          $reqUserAnswer->bindParam(':id_user', $answerComment['id_user'], PDO::PARAM_INT);
          $reqUserAnswer->execute();
          $userAnswer = $reqUserAnswer->fetch();

          $publication_date = $answerComment['publication_date'];
          $year = gmdate('Y', strtotime($publication_date));
          $month = gmdate('m', strtotime($publication_date));
          $day = gmdate('d', strtotime($publication_date));
          $hour = gmdate('H', strtotime($publication_date));
          $min = gmdate('i', strtotime($publication_date));
          $seconde = gmdate('s', strtotime($publication_date));
          $nowYear = gmdate('Y');
          $nowMonth = gmdate('m');
          $nowDay = gmdate('d');
          $nowHour = gmdate('H');
          $nowHour-= 2;
          $nowMin = gmdate('i');
          $nowSeconde = date('s');
          $sinceYear =  $nowYear - $year;
          $monthSince = $nowMonth - $month;
          $daySince = $nowDay - $day;
          $hourSince = $nowHour - $hour;
          $minSince = $nowMin - $min;
          $secondeSince = $nowSeconde - $seconde;
          ?>
          <div class="commentLeft" id="answer_comment<?=$answerComment['id_answer_comment']?>">
          <div class="CommentColumnLeftAnswer"><?php
          echo "<div name=\"horizontal\">";
    			echo "<div name=\"divOneComment\" style=\": left;\"><small><a href=\"public_profile.php?id_user=" . $userAnswer['id_user'] ."\">@" . $userAnswer['pseudo'] .  "</a></small><br><span>" . $answerComment['content'] . "</span></div>";
          //if(isset($_SESSION['id'])){
            //echo "<a onclick=\"change_like_status('" . $userAnswer['pseudo'] . "'" . ',' . $id_article['id_article'] . ',' . $comment['id_comment'] . ")\" style=\"cursor: pointer;\">";
          //}
          //echo "<div id=\"like" . $comment['id_comment'] . "\" style=\"color: white; margin-left: 1em; margin-bottom: 1em;\">"; echo (!empty($allLikesUser)) ? "<img src=\"pictures/likeLeftBlue.png\" alt=\"Like\"> " : "<img src=\"pictures/likeLeftGrey.png\" alt=\"Like\"> ";
          // if(isset($_SESSION['id'])){
          //   echo "</a>";
          // }
          // echo "<a type=\"button\" class=\"btn_modal\" name=\"usersLikes\" data-modal=\"usersLikes" . $id_article['id_article'] . "\" onclick=\"usersLikes(" . $id_article['id_article'] . ")\">" . $allLikes . "</a></div>";
    			echo "</div>";
          echo "<div class=\"answerLine\">";
    			echo "<p onclick=\"answer('" . $userAnswer['pseudo'] . "'" . ',' . $id_article['id_article'] . ',' . $comment['id_comment'] . ',' . $_SESSION['id'] . ")\" style=\"display: inline-block;\">Répondre</p>";
          if($sinceYear > 0){
            echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $sinceYear . " ans ";
            if(isset($_SESSION['id']) && $_SESSION['status']>=2){
              echo "<p onclick=\"delAnswerComment(".$answerComment['id_answer_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
            }
            echo "</div>";
          }elseif($monthSince > 0){
            echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $monthSince . " mois ";
            if(isset($_SESSION['id']) && $_SESSION['status']>=2){
              echo "<p onclick=\"delAnswerComment(".$answerComment['id_answer_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
            }
            echo "</div>";
          }elseif($daySince > 0){
            echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $daySince . " jours ";
            if(isset($_SESSION['id']) && $_SESSION['status']>=2){
              echo "<p onclick=\"delAnswerComment(".$answerComment['id_answer_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
            }
            echo "</div>";
          }elseif($hourSince > 0){
            echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $hourSince . " heures ";
            if(isset($_SESSION['id']) && $_SESSION['status']>=2){
              echo "<p onclick=\"delAnswerComment(".$answerComment['id_answer_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
            }
            echo "</div>";
          }elseif($minSince > 0){
            echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $minSince . " minutes ";
            if(isset($_SESSION['id']) && $_SESSION['status']>=2){
              echo "<p onclick=\"delAnswerComment(".$answerComment['id_answer_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
            }
            echo "</div>";
          }elseif($secondeSince > 0){
            echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $secondeSince . " secondes ";
            if(isset($_SESSION['id']) && $_SESSION['status']>=2){
              echo "<p onclick=\"delAnswerComment(".$answerComment['id_answer_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
            }
            echo "</div>";
          }
            echo "</div>";
          echo "</div>";
        echo "</div>";
        }
      }?>
    </div>
    </div><?php
			$position = 1;
		}else{?>
      <div class="commentAndAnswer">
			     <div class="commentRight" id="comment<?=$comment['id_comment']?>">
             <div class="CommentColumnRight">
		           <div name="horizontal"><?php
      echo "<div id=\"like" . $comment['id_comment'] . "\" style=\"color: white; margin-right: 1em;\">";
      echo "<a type=\"button\" class=\"btn_modal\" name=\"usersLikes\" data-modal=\"usersLikes" . $id_article['id_article'] . "\" onclick=\"usersLikes(" . $id_article['id_article'] . ',' . $comment['id_comment'] .")\">" . $allLikes . "</a>";
      if(isset($_SESSION['id'])){
        echo "<a onclick=\"change_like_status_right('" . $user['pseudo'] . "'" . ',' . $id_article['id_article'] . ',' . $comment['id_comment'] . ")\" style=\"cursor: pointer;\">";
      }
      echo (!empty($allLikesUser)) ? " <img src=\"pictures/likeRightBlue.png\" alt=\"Like\">" : " <img src=\"pictures/likeRightGrey.png\" alt=\"Like\">";
      if(isset($_SESSION['id'])){
        echo "</a>";
      }
      echo "</div>";
			echo "<div name=\"divOneComment\"><small><a href=\"public_profile.php?id_user=" . $user['id_user'] ."\">@" . $user['pseudo'] .  "</a></small><br><span>" . $comment['text'] . "</span></div>";
			echo "</div>";
      echo "<div class=\"answerLine\">";
			echo "<p onclick=\"answer('" . $user['pseudo'] . "'" . ',' . $id_article['id_article'] . ',' . $comment['id_comment'] . ',' . $_SESSION['id'] . ")\" style=\"display: inline-block;\">Répondre</p>";
      if($sinceYear > 0){
        echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $sinceYear . " ans ";
        if(isset($_SESSION['id']) && $_SESSION['status']>=2){
          echo "<p onclick=\"delComment(".$comment['id_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
        }
        echo "</div>";
      }elseif ($monthSince > 0) {
        echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $monthSince . " mois ";
        if(isset($_SESSION['id']) && $_SESSION['status']>=2){
          echo "<p onclick=\"delComment(".$comment['id_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
        }
        echo "</div>";
      }elseif($daySince > 0){
        echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $daySince . " jours ";
        if(isset($_SESSION['id']) && $_SESSION['status']>=2){
          echo "<p onclick=\"delComment(".$comment['id_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
        }
        echo "</div>";
      }elseif($hourSince > 0){
        echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $hourSince . " heures ";
        if(isset($_SESSION['id']) && $_SESSION['status']>=2){
          echo "<p onclick=\"delComment(".$comment['id_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
        }
        echo "</div>";
      }elseif($minSince > 0){
        echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $minSince . " minutes ";
        if(isset($_SESSION['id']) && $_SESSION['status']>=2){
          echo "<p onclick=\"delComment(".$comment['id_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
        }
        echo "</div>";
      }elseif($secondeSince > 0){
        echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $secondeSince . " secondes ";
        if(isset($_SESSION['id']) && $_SESSION['status']>=2){
          echo "<p onclick=\"delComment(".$comment['id_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
        }
        echo "</div>";
      }
          echo "</div>";
        echo "</div>";
      echo "</div>";
      if(!empty($answersComments)){
        foreach($answersComments as $answerComment){

          $reqUserAnswer = $db->prepare('SELECT id_user, pseudo FROM users WHERE id_user=:id_user');
          $reqUserAnswer->bindParam(':id_user', $answerComment['id_user'], PDO::PARAM_INT);
          $reqUserAnswer->execute();
          $userAnswer = $reqUserAnswer->fetch();

          $publication_date = $answerComment['publication_date'];
          $year = gmdate('Y', strtotime($publication_date));
          $month = gmdate('m', strtotime($publication_date));
          $day = gmdate('d', strtotime($publication_date));
          $hour = gmdate('H', strtotime($publication_date));
          $min = gmdate('i', strtotime($publication_date));
          $seconde = gmdate('s', strtotime($publication_date));
          $nowYear = gmdate('Y');
          $nowMonth = gmdate('m');
          $nowDay = gmdate('d');
          $nowHour = gmdate('H');
          $nowHour-= 2;
          $nowMin = gmdate('i');
          $nowSeconde = date('s');
          $sinceYear =  $nowYear - $year;
          $monthSince = $nowMonth - $month;
          $daySince = $nowDay - $day;
          $hourSince = $nowHour - $hour;
          $minSince = $nowMin - $min;
          $secondeSince = $nowSeconde - $seconde;
          ?>
          <div class="commentRight" id="answer_comment<?=$answerComment['id_answer_comment']?>">
            <div class="CommentColumnRightAnswer">
              <div name="horizontal"><?php
          // echo "<div id=\"like" . $comment['id_comment'] . "\" style=\"color: white; margin-right: 1em; margin-bottom: 1em;\">";
          // echo "<a type=\"button\" class=\"btn_modal\" name=\"usersLikes\" data-modal=\"usersLikes" . $id_article['id_article'] . "\" onclick=\"usersLikes(" . $id_article['id_article'] . ")\">" . $allLikes . "</a>";
          // if(isset($_SESSION['id'])){
          //   echo "<a onclick=\"change_like_status_right('" . $user['pseudo'] . "'" . ',' . $id_article['id_article'] . ',' . $comment['id_comment'] . ")\" style=\"cursor: pointer;\">";
          // }
          // echo (!empty($allLikesUser)) ? " <img src=\"pictures/likeRightBlue.png\" alt=\"Like\">" : " <img src=\"pictures/likeRightGrey.png\" alt=\"Like\">";
          // if(isset($_SESSION['id'])){
          //   echo "</a>";
          // }
          // echo "</div>";
    			echo "<div name=\"divOneComment\"><small><a href=\"public_profile.php?id_user=" . $userAnswer['id_user'] ."\">@" . $userAnswer['pseudo'] .  "</a></small><br><span>" . $answerComment['content'] . "</span></div>";
    			echo "</div>";
          echo "<div class=\"answerLine\">";
    			echo "<p onclick=\"answer('" . $userAnswer['pseudo'] . "'" . ',' . $id_article['id_article'] . ',' . $comment['id_comment'] . ',' . $_SESSION['id'] . ")\" style=\"display: inline-block;\">Répondre</p>";
          if($sinceYear > 0){
            echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $sinceYear . " ans ";
            if(isset($_SESSION['id']) && $_SESSION['status']>=2){
              echo "<p onclick=\"delAnswerComment(".$answerComment['id_answer_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
            }
            echo "</div>";
          }elseif ($monthSince > 0) {
            echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $monthSince . " mois ";
            if(isset($_SESSION['id']) && $_SESSION['status']>=2){
              echo "<p onclick=\"delAnswerComment(".$answerComment['id_answer_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
            }
            echo "</div>";
          }elseif($daySince > 0){
            echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $daySince . " jours ";
            if(isset($_SESSION['id']) && $_SESSION['status']>=2){
              echo "<p onclick=\"delAnswerComment(".$answerComment['id_answer_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
            }
            echo "</div>";
          }elseif($hourSince > 0){
            echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $hourSince . " heures ";
            if(isset($_SESSION['id']) && $_SESSION['status']>=2){
              echo "<p onclick=\"delAnswerComment(".$answerComment['id_answer_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
            }
            echo "</div>";
          }elseif($minSince > 0){
            echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $minSince . " minutes ";
            if(isset($_SESSION['id']) && $_SESSION['status']>=2){
              echo "<p onclick=\"delAnswerComment(".$answerComment['id_answer_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
            }
            echo "</div>";
          }elseif($secondeSince > 0){
            echo "<div style=\"display: inline-block; color: white;\">| Il y a " . $secondeSince . " secondes ";
            if(isset($_SESSION['id']) && $_SESSION['status']>=2){
              echo "<p onclick=\"delAnswerComment(".$answerComment['id_answer_comment'].",".$id_article['id_article'].")\" style=\"display: inline-block;\">X</p>";
            }
            echo "</div>";
          }
          echo "</div>";
          echo "</div>";
          echo "</div>";
        }
      }
      echo "</div>";
			$position = 0;
		}
  }
}
?>
