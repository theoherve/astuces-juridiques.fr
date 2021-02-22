<?php
include('includes/config.php');
include('includes/connexion_check.php');

if($connected!=1 || $_SESSION['status']<=2){
  header('location:index.php');
}

$all=$db->PREPARE('SELECT email FROM newsletters');
$all->execute();
$rows=$all->fetchall(PDO::FETCH_ASSOC);
$fileName = 'export-newsletter.csv';
header('Content-Type: application/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
$output= fopen('php://output', 'w');
$delimiter = ';';
$enclosure = '"';
$header=array("Email");
fputcsv($output,$header,$delimiter);

foreach($rows as $row){
  fputcsv($output, $row, $delimiter);
}
fclose($output);

?>
