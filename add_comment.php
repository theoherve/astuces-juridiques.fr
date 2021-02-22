<?php
include('includes/config.php');
include('includes/connexion_check.php');

if(empty($_SESSION['id'])){
	header('Location: index.php');
}

function filterComment(string $comment){
	preg_replace('#(<script>)#i', '&lt;script&gt;', $comment);
	preg_replace('#(</script>)#i', '&lt;/script&gt;', $comment);
	preg_replace('#(<style>)#i', '&lt;style&gt;', $comment);
	preg_replace('#(</style>)#i', '&lt;/style&gt;', $comment);
	preg_replace('#(<object>)#i', '&lt;object&gt;', $comment);
	preg_replace('#(</object>)#i', '&lt;/object&gt;', $comment);
	preg_replace('#(<frame>)#i', '&lt;frame&gt;', $comment);
	preg_replace('#(</frame>)#i', '&lt;/frame&gt;', $comment);
	preg_replace('#(<img>)#i', '&lt;img&gt;', $comment);
	preg_replace('#(</img>)#i', '&lt;/img&gt;', $comment);
	preg_replace('#(<frameset>)#i', '&lt;frameset&gt;', $comment);
	preg_replace('#(</frameset>)#i', '&lt;/frameset&gt;', $comment);
	preg_replace('#(<iframe>)#i', '&lt;iframe&gt;', $comment);
	preg_replace('#(</iframe>)#i', '&lt;/iframe&gt;', $comment);
	preg_replace('#(<video>)#i', '&lt;video&gt;', $comment);
	preg_replace('#(</video>)#i', '&lt;/video&gt;', $comment);
	preg_replace('#(<audio>)#i', '&lt;audio&gt;', $comment);
	preg_replace('#(</audio>)#i', '&lt;/audio&gt;', $comment);
	preg_replace('#(<button>)#i', '&lt;button&gt;', $comment);
	preg_replace('#(</button>)#i', '&lt;/button&gt;', $comment);
	preg_replace('#(<source>)#i', '&lt;source&gt;', $comment);
	return $comment;
}

$id_user = $_SESSION['id'];
$id_article = $_POST['id_article'];
date_default_timezone_set('Europe/Paris');
$publication_date = gmdate("Y-m-d H:i:s");
$comment = filterComment($_POST['comment']);

$insert=$db->prepare('INSERT INTO comments (id_user, publication_date, text, id_article) VALUES (:id_user, :publication_date, :text, :id_article)');
$insert->bindParam(':id_user', $id_user, PDO::PARAM_INT);
$insert->bindParam(':publication_date', $publication_date);
$insert->bindParam(':text', $comment, PDO::PARAM_STR);
$insert->bindParam(':id_article', $id_article, PDO::PARAM_INT);
$insert->execute();

?>
