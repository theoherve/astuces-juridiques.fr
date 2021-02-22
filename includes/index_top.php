<?php

if($_SERVER['REQUEST_URI']=="/index.php"){
  $_SERVER['REQUEST_URI'].="?";
}
/*$linkTreat = $_SERVER['REQUEST_URI'];
if(strpos ( $_SERVER['REQUEST_URI'] , "num_page=")){
   substr($_SERVER['REQUEST_URI'],strpos ( $_SERVER['REQUEST_URI'] , "num_page=")-1);
   echo $_SERVER['REQUEST_URI'];
}
*/

if(!isset($_GET['num_page'])){
  $num_page = 1;
  $actualPage = 1;
}else{
  $actualPage = $_GET['num_page'];
  $num_page = $_GET['num_page'];
}
$num_page = ($num_page-1)*5;

//request url faut enlever le tructruc

//deifnir ici la bonne requette selon
//private public or euro
if(isset($_GET['public']) &&isset($_GET['private']) && isset($_GET['euro'])){
  if(!empty($_GET['private']) && !empty($_GET['euro']) && !empty($_GET['public'])){
    //only private with sub domain and euro with sub domain and public with sub domain
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE (id_domain = 2 AND id_sub_domain = '.$_GET['private'].') OR (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].') AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE (id_domain = 2 AND id_sub_domain = '.$_GET['private'].') OR (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].') AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else if(!empty($_GET['private']) && !empty($_GET['euro'])){
    //only private with sub domain and euro with sub domain and public
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE (id_domain = 2 AND id_sub_domain = '.$_GET['private'].') OR id_domain = 1  OR (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].') AND status="2" AND release_date<=NOW())');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE (id_domain = 2 AND id_sub_domain = '.$_GET['private'].') OR id_domain = 1  OR (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].') AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else if(!empty($_GET['public']) && !empty($_GET['euro'])){
    //only private and euro with sub domain and public with sub domain
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 2 OR (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].') AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 2 OR (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].') AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else if(!empty($_GET['private']) && !empty($_GET['public'])){
    //only private with sub domain and euro  and public with sub domain
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE (id_domain = 2 AND id_sub_domain = '.$_GET['private'].') OR (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR id_domain = 3 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE (id_domain = 2 AND id_sub_domain = '.$_GET['private'].') OR (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR id_domain = 3 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else if(!empty($_GET['private'])){
    //only private with sub domain and euro and public
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE (id_domain = 2 AND id_sub_domain = '.$_GET['private'].') OR id_domain = 1 OR id_domain = 3 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE (id_domain = 2 AND id_sub_domain = '.$_GET['private'].') OR id_domain = 1 OR id_domain = 3 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else if(!empty($_GET['euro'])){
    //only euro with sub domain and private and public
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].') OR id_domain = 1 OR id_domain = 2 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].') OR id_domain = 1 OR id_domain = 2 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else if(!empty($_GET['public'])){
    //only public with sub domain and private and euro
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR id_domain = 3 OR id_domain = 2 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR id_domain = 3 OR id_domain = 2 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else{
    //only public and euro and private articles
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 2 OR id_domain = 1 OR id_domain = 3 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 2 OR id_domain = 1 OR id_domain = 3 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }
}else if(isset($_GET['private']) && isset($_GET['euro'])){
  if(!empty($_GET['private']) && !empty($_GET['euro'])){
    //only private with sub domain and euro with sub domain
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].') OR (id_domain = 2 AND id_sub_domain = '.$_GET['private'].')  AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].') OR (id_domain = 2 AND id_sub_domain = '.$_GET['private'].')  AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else if(!empty($_GET['private'])){
    //only private with sub domain and euro
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 3 OR (id_domain = 2 AND id_sub_domain = '.$_GET['private'].')  AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 3 OR (id_domain = 2 AND id_sub_domain = '.$_GET['private'].')  AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else if(!empty($_GET['private'])){
    //only euro with sub domain and private
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].') OR id_domain = 2 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].') OR id_domain = 2 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else{
    //only euro and private articles
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 2 OR id_domain = 3 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 2 OR id_domain = 3 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }
}else if(isset($_GET['private']) && isset($_GET['public'])){
  if(!empty($_GET['private']) && !empty($_GET['public'])){
    //only private with sub domain and public with sub domain
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR (id_domain = 2 AND id_sub_domain = '.$_GET['private'].')  AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR (id_domain = 2 AND id_sub_domain = '.$_GET['private'].')  AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else if(!empty($_GET['private'])){
    //only private with sub domain and public
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 1 OR (id_domain = 2 AND id_sub_domain = '.$_GET['private'].')  AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 1 OR (id_domain = 2 AND id_sub_domain = '.$_GET['private'].')  AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else if(!empty($_GET['private'])){
    //only public with sub domain and private
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR id_domain = 2 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR id_domain = 2 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else{
    //only public and private articles
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 1 OR id_domain = 2 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 1 OR id_domain = 2 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }
}else if(isset($_GET['euro']) && isset($_GET['public'])){
  if(!empty($_GET['euro']) && !empty($_GET['public'])){
    //only euro with sub domain and public with sub domain
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].')  AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].')  AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else if(!empty($_GET['euro'])){
    //only euro with sub domain and public
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 1 OR (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].')  AND status="2" AND release_date<=NOW() ');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 1 OR (id_domain = 3 AND id_sub_domain = '.$_GET['euro'].')  AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else if(!empty($_GET['euro'])){
    //only public with sub domain and euro
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR id_domain = 3 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE (id_domain = 1 AND id_sub_domain = '.$_GET['public'].') OR id_domain = 3 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else{
    //only public and euopeen articles
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 3 OR id_domain = 2 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 3 OR id_domain = 2 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }
}else if(isset($_GET['euro'])){
  if(!empty($_GET['euro'])){
    //only euro with sub domain
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 3 AND id_sub_domain = '.$_GET['euro'].' AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 3 AND id_sub_domain = '.$_GET['euro'].' AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else{
    //only euro articles
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 3 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 3 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }
}else if(isset($_GET['public'])){
  if(!empty($_GET['public'])){
    //only public with sub domain
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 1 AND id_sub_domain = '.$_GET['public'].' AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 1 AND id_sub_domain = '.$_GET['public'].' AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else{
    //only public articles
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 1 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 1 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }
}else if(isset($_GET['private'])){
  if(!empty($_GET['private'])){
    //only private with sub domain
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 2 AND id_sub_domain = '.$_GET['private'].' AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 2 AND id_sub_domain = '.$_GET['private'].' AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }else{
    //only private articles
    $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE id_domain = 2 AND status="2" AND release_date<=NOW()');
    $reqAstuces = $db->prepare('SELECT * FROM articles WHERE id_domain = 2 AND status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
  }
}else{
  //default research
  $countAstuces = $db->prepare('SELECT id_article FROM articles WHERE status="2" AND release_date<=NOW()');
  $reqAstuces = $db->prepare('SELECT * FROM articles WHERE status="2" AND release_date<=NOW() ORDER BY release_date DESC LIMIT :num_page, 5');
}
$reqAstuces->bindParam(':num_page', $num_page, PDO::PARAM_INT);
$reqAstuces->execute();
$astuces = $reqAstuces->fetchAll(PDO::FETCH_ASSOC);

$countAstuces->bindParam(':num_page', $num_page, PDO::PARAM_INT);
$countAstuces->execute();
$allAstuces = $countAstuces->rowCount();

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
