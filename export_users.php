<?php
include('includes/config.php');
include('includes/connexion_check.php');
if($connected!=1 || $_SESSION['status']<=2){
header('location:index.php');
}
$all=$db->PREPARE('SELECT id_user, first_name, family_name FROM users');
$all->execute();
$rows=$all->fetchall(PDO::FETCH_ASSOC);
$fileName = 'mysql-export.csv';
header('Content-Type: application/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
$output= fopen('php://output', 'w');
$delimiter = ';';
$enclosure = '"';
$header=array("Id","First_name","Family_name");
fputcsv($output,$header,$delimiter);

foreach ($rows as $row) {
    fputcsv($output, $row, $delimiter);
}
fclose($output);
?>
