<?php
include "includes/config.php";
  if(isset($_GET['searchString'])){
    $searchString = (String) trim($_GET['searchString']);
    $req = $db->prepare('SELECT pseudo FROM users WHERE  pseudo = :searchString');
    $req->bindParam(":searchString", $searchString);
    $req->execute();
    $req = $req->fetchALL();
    if (empty($req)) {
      if(!ctype_alnum($searchString)){
        ?><h6 style="color: red" id="message_pseudo">Caracters interdit</h6><?php
      }else if(strlen($searchString) > 14){
        ?><h6 style="color: red" id="message_pseudo">Pseudo trop long</h6><?php

      }else{
        ?><h6  id="message_pseudo">Pseudo disponnible</h6><?php
      }
    }else{
      ?><h6 id="message_pseudo" style="color: red">Pseudo existe deja</h6><?php
    }
  }

  if(isset($_GET['searchStringP'])){
    $searchString = (String) trim($_GET['searchStringP']);
    if(strlen($searchString) <= 6 ){
      ?><h6 id="message_mdp">Mot de passe trop court!</h6><?php
    }else{
    }
  }

  if(isset($_GET['searchStringF'])){
    if(!ctype_alpha($_GET['searchStringF'])){
      ?><h6 id="message_first_name">Caractère interdit</h6><?php
    }else{
    }
  }
  if(isset($_GET['searchStringFN'])){
    if(!ctype_alpha($_GET['searchStringFN'])){
      ?><h6 id="message_family_name">Caractère interdit</h6><?php
    }else{
    }
  }

?>
