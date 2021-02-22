<?php
//print_r();
//exit;
if(isset($_POST["Droit_privé"]) AND isset($_POST["Droit_public"]) AND isset($_POST["Droit_européen"])){
  if(!empty($_POST["subPrivate"]) AND !empty($_POST["subPublic"]) AND !empty($_POST["subEuropéen"])){
    header("Location: index.php?euro=".$_POST["subEuropéen"]."&private=".$_POST["subPrivate"]."&public=".$_POST["subPublic"]);
    exit;
  }else if(!empty($_POST["subPrivate"]) AND !empty($_POST["subPublic"])){
    header("Location: index.php?euro&private=".$_POST["subPrivate"]."&public=".$_POST["subPublic"]);
    exit;
  }else if(!empty($_POST["subPrivate"]) AND !empty($_POST["subEuropéen"])){
    header("Location: index.php?public&private=".$_POST["subPrivate"]."&euro=".$_POST["subEuropéen"]);
    exit;
  }else if(!empty($_POST["subPublic"]) AND !empty($_POST["subEuropéen"])){
    header("Location: index.php?private&euro=".$_POST["subEuropéen"]."&public=".$_POST["subPublic"]);
    exit;
  }else if(!empty($_POST["subPublic"])){
    header("Location: index.php?private&euro&public=".$_POST["subPublic"]);
    exit;
  }else if(!empty($_POST["subPrivate"])){
    header("Location: index.php?public&euro&private=".$_POST["subPrivate"]);
    exit;
  }else if(!empty($_POST["subEuropéen"])){
    header("Location: index.php?public&private&euro=".$_POST["subEuropéen"]);
    exit;
  }else{
    header("Location: index.php?public&private&euro");
  }
}else if(isset($_POST["Droit_privé"]) AND isset($_POST["Droit_public"])){
  if(!empty($_POST["subPrivate"]) AND !empty($_POST["subPublic"])){
    header("Location: index.php?private=".$_POST["subPrivate"]."&public=".$_POST["subPublic"]);
    exit;
  }else if(!empty($_POST["subPrivate"])){
    header("Location: index.php?private=".$_POST["subPrivate"]."&public");
    exit;
  }else if(!empty($_POST["subPublic"])){
    header("Location: index.php?private&public=".$_POST["subPublic"]);
    exit;
  }else{
    header("Location: index.php?public&private");
    exit;
  }
}else if(isset($_POST["Droit_public"]) AND isset($_POST["Droit_européen"])){
  if(!empty($_POST["subEuropéen"]) AND !empty($_POST["subPublic"])){
    header("Location: index.php?public=".$_POST["subPublic"]."&euro=".$_POST["subEuropéen"]);
    exit;
  }else if(!empty($_POST["subPublic"])){
    header("Location: index.php?euro&public=".$_POST["subPublic"]);
    exit;
  }else if(!empty($_POST["subEuropéen"])){
    header("Location: index.php?public&euro=".$_POST["subEuropéen"]);
    exit;
  }else{
    header("Location: index.php?public&euro");
    exit;
  }
}else if(isset($_POST["Droit_privé"]) AND isset($_POST["Droit_européen"])){
  if(!empty($_POST["subEuropéen"]) AND !empty($_POST["subPrivate"])){
    header("Location: index.php?private=".$_POST["subPrivate"]."&euro=".$_POST["subEuropéen"]);
    exit;
  }else if(!empty($_POST["subPrivate"])){
    header("Location: index.php?euro&private=".$_POST["subPrivate"]);
    exit;
  }else if(!empty($_POST["subEuropéen"])){
    header("Location: index.php?private&euro=".$_POST["subEuropéen"]);
    exit;
  }else{
    header("Location: index.php?private&euro");
    exit;
  }
}else if(isset($_POST["Droit_privé"])){
  if(!empty($_POST["subPrivate"])){
    header("Location: index.php?private=".$_POST["subPrivate"]);
    exit;
  }else{
    header("Location: index.php?private");
    exit;
  }
}else if(isset($_POST["Droit_public"])){
  if(!empty($_POST["subPublic"])){
    header("Location: index.php?public=".$_POST["subPublic"]);
    exit;
  }else{
    header("Location: index.php?public");
    exit;
  }
}else if(isset($_POST["Droit_européen"])){
  if(!empty($_POST["subEuropéen"])){
    header("Location: index.php?euro=".$_POST["subEuropéen"]);
    exit;
  }else{
    header("Location: index.php?euro");
    exit;
  }
}else{
  header("Location: index.php");
  exit;
}
?>
