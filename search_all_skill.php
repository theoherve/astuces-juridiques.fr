<?php
include('includes/config.php');
$skills=$req=$db->PREPARE('SELECT name FROM skills WHERE name LIKE ? order by name');
$skills->execute();
WHILE($skill=$skills->fetch()){
  ?>
<div>
  <p><?php echo $skill['name'] ?></p>
</div>
  <?php
}
 ?>
