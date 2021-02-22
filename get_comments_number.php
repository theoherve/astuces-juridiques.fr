<?php
include('includes/config.php');
include('includes/connexion_check.php');

$reqAllComments = $db->prepare('SELECT id_comment FROM comments WHERE id_article=:id_article');
$reqAllComments->bindParam(':id_article', $_GET['id_article'], PDO::PARAM_INT);
$reqAllComments->execute();
$allComments = $reqAllComments->rowCount();

$reqAllComments = $db->prepare('SELECT id_answer_comment FROM answers_comments WHERE id_article=:id_article');
$reqAllComments->bindParam(':id_article', $_GET['id_article'], PDO::PARAM_INT);
$reqAllComments->execute();
$allAnswsersComments = $reqAllComments->rowCount();
$allAllComments = $allComments+$allAnswsersComments;

echo "Commentaires (".$allAllComments.")";

?>
