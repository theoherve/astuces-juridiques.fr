<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>test2</title>
  </head>
  <body>
<main>
<h2>distance</h2>
<?php
$lat1=48.8444508;
$lng1=2.4177632;
$lat2=48.7959895;
$lng2=2.4341929;

  // renvoi la distance en mètres
    function get_distance_m($lat1, $lng1, $lat2, $lng2) {
      $earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
      $rlo1 = deg2rad($lng1);
      $rla1 = deg2rad($lat1);
      $rlo2 = deg2rad($lng2);
      $rla2 = deg2rad($lat2);
      $dlo = ($rlo2 - $rlo1) / 2;
      $dla = ($rla2 - $rla1) / 2;
      $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin(
$dlo));
      $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
      return ($earth_radius * $d);
    }


$rec=get_distance_m($lat1, $lng1, $lat2, $lng2)/1000;
echo $rec;
// echo (round(get_distance_m(48.856667, 2.350987, 45.767299, 4.834329) / 1000,
//  3)). ' km';
?>
</main>
  </body>
</html>
