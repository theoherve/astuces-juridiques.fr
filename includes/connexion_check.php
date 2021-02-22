<?php
// header('Cache-Control: no cache'); //no cache
// session_cache_limiter('private_no_expire'); // works
// session_cache_limiter('public'); // works too
session_start();
$connected = isset($_SESSION['email']) ? true : false;
if(isset($_SESSION['status']))
{
	$status = $_SESSION['status'];
}
?>
