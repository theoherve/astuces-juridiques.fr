<?php
include('includes/config.php');
include('includes/connexion_check.php');
if($connected!=1 || $_SESSION['status']<=2){
header('location:index.php');
}
$all=$db->PREPARE('SELECT id_lawyer, family_name, first_name, email, phone FROM lawyers');
$all->execute();
$rows=$all->fetchall(PDO::FETCH_ASSOC);
$fileName = 'mysql-export.csv';
header('Content-Type: application/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
$output= fopen('php://output', 'w');
$delimiter = ';';
$enclosure = '"';
$header=array("Id","Family_name","First_name","Email","Telephone");
fputcsv($output,$header,$delimiter);

foreach ($rows as $row) {
    fputcsv($output, $row, $delimiter);
}
fclose($output);
?>
