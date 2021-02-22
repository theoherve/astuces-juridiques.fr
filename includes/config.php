<?php
try
{
  $user = "theo";
  $password = "prisen";
  $db = new PDO("mysql:host=localhost;port=3306;dbname=astuces_juridiques", $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}
?>
