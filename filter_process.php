<?php

include('includes/config.php');

if(isset($_POST['pb_juris']) && !empty($_POST['pb_juris'])){
  $skill = $_POST['pb_juris'];
  $problem = $db->prepare("SELECT  FROM skills WHERE name = :name");
}
*/


header('Location: my_lawyer.php');
 ?>
