<?php
$v_terms = $_POST['termConditions'];
$v_name = htmlspecialchars(trim($_POST['name'], " "));
$v_email = htmlspecialchars(trim($_POST['email'], " "));
$v_phone = htmlspecialchars(trim($_POST['phone'], " "));
if(isset($_POST['monday'])){
  $v_monday = $_POST['monday'];
  $v_monday_1 = htmlspecialchars(trim($_POST['monday_1'], " "));
  $v_monday_2 = htmlspecialchars(trim($_POST['monday_2'], " "));
}

if(isset($_POST['tuesday'])){
  $v_tuesday = $_POST['tuesday'];
  $v_tuesday_1 = htmlspecialchars(trim($_POST['tuesday_1'], " "));
  $v_tuesday_2 = htmlspecialchars(trim($_POST['tuesday_2'], " "));
}

if(isset($_POST['wednesday'])){
  $v_wednesday = $_POST['wednesday'];
  $v_wednesday_1 = htmlspecialchars(trim($_POST['wednesday_1'], " "));
  $v_wednesday_2 = htmlspecialchars(trim($_POST['wednesday_2'], " "));
}

if(isset($_POST['thursday'])){
  $v_thursday = $_POST['thursday'];
  $v_thursday_1 = htmlspecialchars(trim($_POST['thursday_1'], " "));
  $v_thursday_2 = htmlspecialchars(trim($_POST['thursday_2'], " "));
}

if(isset($_POST['friday'])){
  $v_friday = $_POST['friday'];
  $v_friday_1 = htmlspecialchars(trim($_POST['friday_1'], " "));
  $v_friday_2 = htmlspecialchars(trim($_POST['friday_2'], " "));
}



if(isset($_POST['termConditions'])){
  if(isset($_POST['name']) && !empty($v_name)
    && isset($_POST['email']) && !empty($v_email)
    && isset($_POST['phone']) && !empty($v_phone)){
        if(isset($_POST['monday']) && $v_monday == 'yes'){
          if(isset($_POST['monday_1']) && $_POST['monday_1']!=""){
            if(isset($_POST['monday_2']) && $_POST['monday_2']!=""){
              $monday = "Lundi matin à : $v_monday_1 heures, ou l'après midi à : $v_monday_2 heures.";
            }else{
              $monday = "Lundi matin à : $v_monday_1 heures.";
             }
          }else if (isset($_POST['monday_2']) && $_POST['monday_2']!=""){
            $monday = "Lundi après midi à : $v_monday_2 heures.";
          }else{
            $monday = "Lundi.";
          }
        }


        if(isset($_POST['tuesday']) && $v_tuesday == 'yes'){
          if(isset($_POST['tuesday_1']) && $_POST['tuesday_1']!=""){
            if(isset($_POST['tuesday_2']) && $_POST['tuesday_2']!=""){
              $tuesday = "Mardi matin à : $v_tuesday_1 heures, ou l'après midi à $v_tuesday_2 heures.";
            }else{
              $tuesday = "Mardi matin à : $v_tuesday_1 heures.";
             }
          }else if (isset($_POST['tuesday_2']) && $_POST['tuesday_2']!=""){
            $tuesday = "Mardi après midi à : $v_tuesday_2 heures.";
          }else{
            $tuesday = "Mardi.";
          }
        }



        if(isset($_POST['wednesday']) && $v_wednesday == 'yes'){
          if(isset($_POST['wednesday_1']) && $_POST['wednesday_1']!=""){
            if(isset($_POST['wednesday_2']) && $_POST['wednesday_2']!=""){
              $wednesday = "Mercredi matin à : $v_wednesday_1 heures, ou l'après midi à $v_wednesday_2 heures.";
            }else{
              $wednesday = "Mercredi matin à : $v_wednesday_1 heures.";
             }
          }else if (isset($_POST['wednesday_2']) && $_POST['wednesday_2']!=""){
            $wednesday = "Mercredi après midi à : $v_wednesday_2 heures.";
          }else{
            $wednesday = "Mercredi.";
          }
        }


        if(isset($_POST['thursday']) && $v_thursday == 'yes'){
          if(isset($_POST['thursday_1']) && $_POST['thursday_1']!=""){
            if(isset($_POST['thursday_2']) && $_POST['thursday_2']!=""){
              $thursday = "Jeudi matin à : $v_thursday_1 heures, ou l'après midi à $v_thursday_2 heures.";
            }else{
              $thursday = "Jeudi matin à : $v_thursday_1 heures.";
             }
          }else if ($v_thursday_2 != ""){
            $thursday = "Jeudi après midi à : $v_thursday_2 heures.";
          }else{
            $thursday = "Jeudi.";
          }
        }


        if(isset($_POST['friday']) && $v_friday == 'yes'){
          if(isset($_POST['friday_1']) && $_POST['friday_1']!=""){
            if(isset($_POST['friday_2']) && $_POST['friday_2']!=""){
              $friday = "Vendredi matin à : $v_friday_1 heures , ou l'après midi' à $v_friday_2 heures.";
            }else{
              $friday = "Vendredi matin à : $v_friday_1 heures.";
             }
          }else if ($v_friday_2 != ""){
            $friday = "Vendredi après midi à : $v_friday_2 heures.";
          }else{
            $friday = "Vendredi.";
          }
        }
            $headers = "From: no-reply@astuce-juridique.fr";
            $name = $v_name;
            $phone = $v_phone;
            $mail = $v_email;
            $subject = "$name souhaite intégrer votre site.";
            $message_bis =  "Vous pouvez le contacter par mail : $mail";
            $message_bis_bis = "Et par téléphone : $phone.";

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"params\":{\"MESSAGE_BIS\":\"$message_bis\",\"MESSAGE_BIS_BIS\":\"$message_bis_bis\",\"WEEK_LUNDI\":\"$monday\",\"WEEK_MARDI\":\"$tuesday\",\"WEEK_MERCREDI\":\"$wednesday\",\"WEEK_JEUDI\":\"$thursday\",\"WEEK_VENDREDI\":\"$friday\",\"MESSAGE\":\"$subject\"},\"sender\":{\"name\":\"$name\",\"email\":\"$mail\"},\"to\":[{\"email\":\"avocat@astuces-juridiques.fr\",\"name\":\"Astuces Juridiques\"}],\"replyTo\":{\"email\":\"$mail\",\"name\":\"$name\"},\"subject\":\"$subject\",\"templateId\":30}",
          CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "api-key: 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",
            "content-type: application/json"
          ),
        ));
        curl_exec($curl);
        curl_close($curl);
        header('Location: lawyer.php?sent');
      }
}else{
  header('Location: I_am_a_lawyer.php');
}
?>
