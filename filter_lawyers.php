<?php
$title = "Recherche Avocat";
 ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include('includes/head.php');
        header('Cache-Control: no cache');
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

<?php
include('includes/config.php');
// declaration des variables


if(!isset($_POST['longitude'])){
  $_POST['longitude']=0;
}
if(!isset($_POST['latitude'])){
  $_POST['latitude']=0;
}


if(!isset($_GET['num_page'])){
  $num_page = 1;
  $actualPage = 1;
}else{
  $actualPage = $_GET['num_page'];
  $num_page = $_GET['num_page'];
}
$num_page = ($num_page-1)*10;

if(isset($_GET['longitude']) && !empty($_GET['longitude'])){
  $_POST['longitude']=$_GET['longitude'];

}
if(isset($_GET['latitude']) && !empty($_GET['latitude'])){
  $_POST['latitude']=$_GET['latitude'];

}

$my_longitude=$_POST['longitude'];
$my_latitude=$_POST['latitude'];



if($_SERVER['REQUEST_URI']=="/filter_lawyers.php"){
  $_SERVER['REQUEST_URI'].="?";
}



if(isset($_GET['skill']) && !empty($_GET['skill'])){
  $choosen_skill=$_GET['skill'];
}else{
  $skill_post=$_POST['skill'];
  $req_skill=$db->PREPARE('SELECT id_skill FROM skills WHERE name=?');
  $req_skill->execute([$skill_post]);
  //iner join
  $req_daskill=$req_skill->fetch();
  $choosen_skill=$req_daskill['id_skill'];
}



if(isset($_POST['legal_aid']) && $_POST['latitude']!=0){
  $chosen_ones_count = $db->prepare("SELECT id_lawyer FROM lawyers where legal_aid=? AND (competence_1=? OR competence_2=? OR competence_3=? OR competence_4=? OR competence_5=? OR competence_6=? OR competence_7=? OR competence_8=? OR competence_9=? OR competence_10=? OR competence_11=? OR competence_12=?)");
  $chosen_ones_count->execute(['1',$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill]);
  $chosen_ones = $db->prepare("SELECT *, id_language, languages.name as language_name, cities.name as city_name FROM lawyers
                              INNER JOIN languages ON languages.id_language = lawyers.language_1
                              INNER JOIN cities ON cities.id_city=lawyers.id_city
                              where legal_aid=1 AND (competence_1=:competence_1 OR competence_2=:competence_2 OR competence_3=:competence_3 OR competence_4=:competence_4 OR competence_5=:competence_5 OR competence_6=:competence_5
                              OR competence_7=:competence_7 OR competence_8=:competence_8 OR competence_9=:competence_9 OR competence_10=:competence_10 OR competence_11=:competence_11 OR competence_12=:competence_12)");
}	else if(!isset($_POST['legal_aid']) && $_POST['latitude']!=0){
  $chosen_ones_count = $db->prepare("SELECT id_lawyer FROM lawyers where (competence_1=? OR competence_2=? OR competence_3=? OR competence_4=? OR competence_5=? OR competence_6=? OR competence_7=? OR competence_8=? OR competence_9=? OR competence_10=? OR competence_11=? OR competence_12=?)");
  $chosen_ones_count->execute([$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill]);
  $chosen_ones = $db->prepare("SELECT *, id_language, languages.name as language_name, cities.name as city_name FROM lawyers
                              INNER JOIN languages ON languages.id_language = lawyers.language_1
                              INNER JOIN cities ON cities.id_city=lawyers.id_city
                              where (competence_1=:competence_1 OR competence_2=:competence_2 OR competence_3=:competence_3 OR competence_4=:competence_4 OR competence_5=:competence_5 OR competence_6=:competence_5
                              OR competence_7=:competence_7 OR competence_8=:competence_8 OR competence_9=:competence_9 OR competence_10=:competence_10 OR competence_11=:competence_11 OR competence_12=:competence_12)");

}  else if(isset($_POST['legal_aid']) && $_POST['latitude']==0){
  $chosen_ones_count = $db->prepare("SELECT id_lawyer FROM lawyers where (competence_1=? OR competence_2=? OR competence_3=? OR competence_4=? OR competence_5=? OR competence_6=? OR competence_7=? OR competence_8=? OR competence_9=? OR competence_10=? OR competence_11=? OR competence_12=?) AND legal_aid=?");
  $chosen_ones_count->execute([$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,'1']);
  $chosen_ones = $db->prepare("SELECT *, id_language, languages.name as language_name, cities.name as city_name FROM lawyers
                              INNER JOIN languages ON languages.id_language = lawyers.language_1
                              INNER JOIN cities ON cities.id_city=lawyers.id_city where (competence_1=:competence_1 OR competence_2=:competence_2 OR competence_3=:competence_3 OR competence_4=:competence_4 OR competence_5=:competence_5 OR competence_6=:competence_5
                              OR competence_7=:competence_7 OR competence_8=:competence_8 OR competence_9=:competence_9 OR competence_10=:competence_10 OR competence_11=:competence_11 OR competence_12=:competence_12) AND legal_aid=1");
} else if(!isset($_POST['legal_aid']) && $_POST['latitude']==0){
  $chosen_ones_count = $db->prepare("SELECT id_lawyer FROM lawyers where (competence_1=? OR competence_2=? OR competence_3=? OR competence_4=? OR competence_5=? OR competence_6=? OR competence_7=? OR competence_8=? OR competence_9=? OR competence_10=? OR competence_11=? OR competence_12=?)");
  $chosen_ones_count->execute([$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill,$choosen_skill]);
  $chosen_ones = $db->prepare("SELECT *, id_language, languages.name as language_name, cities.name as city_name FROM lawyers
                              INNER JOIN languages ON languages.id_language = lawyers.language_1
                              INNER JOIN cities ON cities.id_city=lawyers.id_city where (competence_1=:competence_1 OR competence_2=:competence_2 OR competence_3=:competence_3 OR competence_4=:competence_4 OR competence_5=:competence_5 OR competence_6=:competence_5
                              OR competence_7=:competence_7 OR competence_8=:competence_8 OR competence_9=:competence_9 OR competence_10=:competence_10 OR competence_11=:competence_11 OR competence_12=:competence_12)");
}
$chosen_ones->bindParam(':competence_1', $choosen_skill, PDO::PARAM_INT);
$chosen_ones->bindParam(':competence_2', $choosen_skill, PDO::PARAM_INT);
$chosen_ones->bindParam(':competence_3', $choosen_skill, PDO::PARAM_INT);
$chosen_ones->bindParam(':competence_4', $choosen_skill, PDO::PARAM_INT);
$chosen_ones->bindParam(':competence_5', $choosen_skill, PDO::PARAM_INT);
$chosen_ones->bindParam(':competence_6', $choosen_skill, PDO::PARAM_INT);
$chosen_ones->bindParam(':competence_7', $choosen_skill, PDO::PARAM_INT);
$chosen_ones->bindParam(':competence_8', $choosen_skill, PDO::PARAM_INT);
$chosen_ones->bindParam(':competence_9', $choosen_skill, PDO::PARAM_INT);
$chosen_ones->bindParam(':competence_10', $choosen_skill, PDO::PARAM_INT);
$chosen_ones->bindParam(':competence_11', $choosen_skill, PDO::PARAM_INT);
$chosen_ones->bindParam(':competence_12', $choosen_skill, PDO::PARAM_INT);
$chosen_ones->execute();
$your_lawyers = $chosen_ones->fetchAll(PDO::FETCH_ASSOC);
//$your_lawyers c'est mon tableau avec tt les info des lawyers
$chosen_ones_count->execute();
$your_chosen_ones_count = $chosen_ones_count->rowCount();
////////////////////////////////////////////////////////////////////////////////////////////////
//---------- fonctions ----------
function get_distance_m($my_latitude, $my_longitude, $lat, $lng)
{
	$earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
	$rlo1 = deg2rad($my_longitude);
	$rla1 = deg2rad($my_latitude);
	$rlo2 = deg2rad($lng);
	$rla2 = deg2rad($lat);
	$dlo = ($rlo2 - $rlo1) / 2;
	$dla = ($rla2 - $rla1) / 2;
	$a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin(
$dlo));
	$d = 2 * atan2(sqrt($a), sqrt(1 - $a));
	return ($earth_radius * $d);
}

if($my_latitude!=0 AND $my_longitude!=0)
{
    $i=0;
  	foreach ($your_lawyers as $all_lawyer)
  	{
  		$lat=$all_lawyer['lat'];
  		$lng=$all_lawyer['lng'];
  		$return=get_distance_m($my_latitude, $my_longitude, $lat, $lng)/1000;
      $your_lawyers[$i]['distance']=$return;
      $i++;
    }
  $keys = array_column($your_lawyers,'distance');
  array_multisort($keys, SORT_ASC, $your_lawyers);


}
//////////////////////////////////////////////////////////////////////////////////////////////////////

 ?>
<body id="my_lawyers"  onclick="cancelSearch()">
  <?php include('includes/header.php'); ?>
  <main onclick="cancel()">
    <div id="main_lawyer_php">
      <section id="my_lawyer_first_section">
        <div id="my_lawyer_first_section_div_1">
        	<div id="my_lawyer_first_section_div_1_1">
        	  <p>Trouvez l'avocat de vos besoins,<br>et penchez la balance de votre côté</p>
        	</div>
        	<div id="my_lawyer_first_section_div_1_2">
        	     <button type="button" onclick="window.location.href='I_am_a_lawyer.php'"class="btn btn-primary">Je suis avocat ?</button>
          </div>
        </div>
        <div onclick="openCloseFilter_2()" class="dropbtnFilter" id="parent_filter_vos">
          <span id="filter_vos">Filtrer votre recherche</span>
          <img src="pictures/filterSelect.png" alt="Filtrer">
        </div>
        <form action="filter_lawyers.php" method="post" id="form_search_lawyers" style="display:none">
             <div id="my_lawyer_first_section_div_2">
               <div id="column_1">
                 <div class="div_dropdown_skills">
                   <input type="text" class="form-control" name="skill" id="input_dropdown_skills_search" autocomplete="off" placeholder="Saisissez une compétence" required>
                   <div id="div_dropdown_skills_res">


                   </div>
                 </div>
               </div>
               <div id="column_2">
                 <div id="column_2_1">
                     <input type="text" class="form-control" id="locationTextField" style="outline: none;"  placeholder="Saisissez une ville">
                   </div>
               </div>
               <div id="column_2_2">
                 <div class="form-check">
                   <input class="form-check-input" type="checkbox" value="" id="legal_aid" name="legal_aid">
                   <label class="form-check-label" for="defaultCheck2">
                     Proposant l'aide juridictionnelle
                   </label>
                 </div>
               </div>
               <div id="column_3">
                 <input type="text" name="latitude" value="" id="latitude" style="display:none">
                 <input type="text" name="longitude" value="" id="longitude" style="display:none">
                 <div>
                   <button id="button_submit_lawyer" type="submit" onclick="" class="btn btn-primary">C'est parti</button>
                   <script type="text/javascript">
                     function submit_lawyers(){
                     document.forms["form_search_lawyers"].submit();
                     }
                     function wrong_skill_alert(){
                       window.alert("Renseigner une compétence répertoriée");
                     }
                   </script>
                 </div>
               </div>
             </div>
           </form>
        <script type="text/javascript">
           function openCloseFilter_2(){
             let content = document.getElementById('form_search_lawyers');
             let visibility= content.getAttribute('style');
             if(visibility=='display:none'){
             content.setAttribute("style", "display:flex, position:sticky");
             } else{
             content.setAttribute("style", "display:none");
             }
           }
         </script>
        </section>
      	<section id="section_lawyer" style="height: auto;">
          <?php
          	for($j=$num_page;$j<$your_chosen_ones_count && $j<$num_page+10;$j++)
            {
          	  $oath_time = $your_lawyers[$j]['oath'];
          	  $oath = date('Y',strtotime($oath_time));
          	  $oath2 = date('m',strtotime($oath_time));
          	  $oath3 = date('d',strtotime($oath_time));
          	  $now = date('Y');
          	  $now2 = date('m');
          	  $now3 = date('d');
          	  $time_since_oath =  $now - $oath;
          	  $month_since_oath = $now2 - $oath2;
          	  $day_since_oath = $now3 - $oath3;
          	  $id_lawyer = $your_lawyers[$j]['id_lawyer'];
          	  ?>
            	<div id="preview_lawyer_x">
            	   <div id="preview_lawyer_1">
            	     <div id="img_profil_lawyer">
            	       <img src="pictures/pdp_users/img_1_user_<?php echo $id_lawyer?>" alt="Avocat" height="230em">
            	     </div>
            	     <div id="button_profil_img_div">
            	       <button type="button" class="btn btn-primary"onclick=window.location.href="/display_one_lawyer.php?idl=<?php echo $your_lawyers[$j]['id_lawyer'] ?>">Voir plus</button>
            	     </div>
            	   </div>
            	   <div id="preview_lawyer_2">
            	     <div id="lawyer_information">
            	       <div id="preview_lawyer_21">
            	         <div id="preview_lawyer_21_1">
            	           <p id=identity><?php echo 'Maître' .' '. '<span class="family_name">' . $your_lawyers[$j]['family_name'] . '</span>' .' '. $your_lawyers[$j]['first_name']; ?></p>
            	         </div>
            	         <div id="preview_lawyer_21_2">
            	           <div id="preview_lawyer_21_2_1">
            	             <img  src="pictures/position.png" width="15em" alt="position">
            	             </div>
            	           <div id="preview_lawyer_21_2_2">
            	             <p><?php echo  ' '. $your_lawyers[$j]['address'].', '.$your_lawyers[$j]['city_name'] ?></p>
            	           </div>
            	         </div>
            	       </div>
            	       <div id="line">
            	       </div>
            	       <div id="preview_lawyer_22">
            	         <ul>
            	           <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($time_since_oath > 0)
            	             {
            	               echo ' ' . 'A prété serment il y a ' . $time_since_oath . ' ans';
            	             }else if ($month_since_oath > 0)
            	             {
            	               echo ' ' . 'A prété serment il y a ' . $month_since_oath . ' mois';
            	             }else
            	             {
            	               echo ' ' . 'A prété serment il y a ' . $day_since_oath . ' jours';
            	             }?>
            	           </li>
            	           <li>
            	             <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Paiement' . ' ' . $your_lawyers[$j]['payement_type']; ?>
            	           </li>
            	         </ul>
            	       </div>
            	       <div id="preview_lawyer_23">
            	         <ul>
            	           <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($your_lawyers[$j]['legal_aid']){
            	             echo " Aide juridictionnelle";
            	             }else{
            	               echo ' ' . $your_lawyers[$j]['language_name'];
            	             } ?>
            	           </li>
            	           <li>
            	             <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Taux horaire: ' . $your_lawyers[$j]['th']; ?>
            	           </li>
            	         </ul>
            	       </div>
            	     </div>
            	     <!-- $first['description'] -->
            	     <div id="div_zone_description_area" onclick=window.location.href="/display_one_lawyer.php?idl=<?php echo $your_lawyers[$j]['id_lawyer'] ?>">
            	       <div id="description_area">
            	         <p><?php echo $your_lawyers[$j]['description'] ?></p>
            	       </div>
                     <div id="div_gradient">
                     </div>
            	     </div>
            	   </div>
            	 </div>
              <div id="preview_lawyer_x_mob" style="display:none">
                 <div id="preview_lawyer_1">
                   <div id="img_profil_lawyer">
                     <img src="pictures/pdp_users/img_1_user_<?php echo $your_lawyers[$j]['id_lawyer']?>" alt="Avocat" height="230em">
                   </div>
                   <div id="preview_lawyer_1_2">
                     <div id="preview_lawyer_21_1">
                       <p id=identity><?php echo 'Maître' .' '. '<span class="family_name">' . $your_lawyers[$j]['family_name'] . '</span>' .' '. $your_lawyers[$j]['first_name']; ?></p>
                     </div>
                     <div id="preview_lawyer_21_2">
                       <div id="preview_lawyer_21_2_1">
                         <img  src="pictures/position.png" width="15em" alt="position">
                         </div>
                       <div id="preview_lawyer_21_2_2">
                         <p><?php echo  ' '. $your_lawyers[$j]['address'].', '.$your_lawyers[$j]['city_name'] ?></p>
                       </div>
                     </div>
                     <div id="button_profil_img_div">
                       <button type="button" class="btn btn-primary" onclick=window.location.href="/display_one_lawyer.php?idl=<?php echo $id_lawyer; ?>">Voir plus</button>
                     </div>
                   </div>
                 </div>
                 <div id="preview_lawyer_2">
                   <div id="lawyer_information">
                     <div id="preview_lawyer_22">
                       <ul>
                         <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($time_since_oath > 0)
                           {
                             echo ' ' . 'A prété serment il y a ' . $time_since_oath . ' ans';
                           }elseif ($month_since_oath > 0)
                           {
                             echo ' ' . 'A prété serment il y a ' . $month_since_oath . ' mois';
                           }else
                           {
                             echo ' ' . 'A prété serment il y a ' . $day_since_oath . ' jours';
                           }?>
                         </li>
                         <li>
                           <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Paiement' . ' ' . $your_lawyers[$j]['payement_type']; ?>
                         </li>
                       </ul>
                     </div>
                     <div id="preview_lawyer_23">
                       <ul>
                         <li class="li_sup"><img src="/pictures/puce.svg" height="10em"><?php if($your_lawyers[$j]['legal_aid']){
                           echo " Aide juridictionnelle";
                           }else{
                             echo ' ' . $your_lawyers[$j]['language_name'];
                           } ?>
                         </li>
                         <li>
                           <img src="/pictures/puce.svg" height="10em"><?php echo ' ' . 'Taux horaire: ' . $your_lawyers[$j]['th']; ?>
                         </li>
                       </ul>
                     </div>
                   </div>
                 </div>
                 <div id="div_zone_description_area">
                   <div id="description_area">
                     <?php echo $your_lawyers[$j]['description']; ?>
                   </div>
                   <div id="div_gradient">

                   </div>
                 </div>
               </div>
              <?php
            } ?>
       </section>
    <div class="paginationIndex">
           <?php
           //total pages doit etre
           $totalPages = ceil($your_chosen_ones_count / 10);

           if($totalPages == 0 || $totalPages == 1){
             echo "<a class=\"indexActive\" href=".$_SERVER['REQUEST_URI']."skill=".$choosen_skill."&latitude=".$my_latitude."&longitude=".$my_longitude."&num_page="."1>" . (1) . "</a>";
           }else if($actualPage == 1){
             echo "<a class=\"indexActive\" href=".$_SERVER['REQUEST_URI']."skill=".$choosen_skill."&latitude=".$my_latitude."&longitude=".$my_longitude."&num_page=".$actualPage.">" . $actualPage . "</a>";
             echo "...";
             echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."skill=".$choosen_skill."&latitude=".$my_latitude."&longitude=".$my_longitude."&num_page=".$totalPages.">" . $totalPages . "</a>";
             echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."skill=".$choosen_skill."&latitude=".$my_latitude."&longitude=".$my_longitude."&num_page=".($actualPage+1) .">" . ">" . "</a>";
           }else if($actualPage != 1 && $actualPage != $totalPages){
             echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."skill=".$choosen_skill."&latitude=".$my_latitude."&longitude=".$my_longitude."&num_page=".($actualPage-1) .">" . "<" . "</a>";
             echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."skill=".$choosen_skill."&latitude=".$my_latitude."&longitude=".$my_longitude."&num_page=". 1 .">" . 1 . "</a>";
             echo "...";
             echo "<a class=\"indexActive\" href=".$_SERVER['REQUEST_URI']."skill=".$choosen_skill."&latitude=".$my_latitude."&longitude=".$my_longitude."&num_page=".$actualPage.">" . $actualPage . "</a>";
             echo "...";
             echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."skill=".$choosen_skill."&latitude=".$my_latitude."&longitude=".$my_longitude."&num_page=".$totalPages.">" . $totalPages . "</a>";
             echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."skill=".$choosen_skill."&latitude=".$my_latitude."&longitude=".$my_longitude."&num_page=".($actualPage+1) .">" . ">" . "</a>";
           }else{
             echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."skill=".$choosen_skill."&latitude=".$my_latitude."&longitude=".$my_longitude."&num_page=".($actualPage-1) .">" . "<" . "</a>";
             echo "<a class=\"indexNonActive\" href=".$_SERVER['REQUEST_URI']."skill=".$choosen_skill."&latitude=".$my_latitude."&longitude=".$my_longitude."&num_page=". 1 .">" . 1 . "</a>";
             echo "...";
             echo "<a class=\"indexActive\" href=".$_SERVER['REQUEST_URI']."skill=".$choosen_skill."&latitude=".$my_latitude."&longitude=".$my_longitude."&num_page=".$actualPage.">" . $actualPage . "</a>";
           }

           ?>

         </div>
  </main>
               <?php include('includes/footer.php'); ?>
     </body>
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-3bOpbCXWZX8RQXpdEytRK4Y9AqHwejM&libraries=places&fields=geometry&callback=initializeAutocomplete"></script>
      <script type="text/javascript" src="js/auto_complete.js"></script>
      <script type="text/javascript" src="js/auto_complete_skill.js"></script>
      <script src="js/modal.js" type="text/javascript"></script>
      <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
      <?php include('includes/scripts.php'); ?>
      </html>
