<?php
include('includes/config.php');

$skill_search=$_GET['input'].'%';
$skills=$req=$db->PREPARE('SELECT name FROM skills WHERE name LIKE ? order by name');
$skills->execute([$skill_search]);
while($skill=$skills->fetch()){
  ?>
<div id="div_one_skill" onclick="get_da_skill('<?=$skill['name'] ?>')">
  <p><?=$skill['name'] ?></p>
</div>

  <?php
}
 ?>
