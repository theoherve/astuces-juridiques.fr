$(document).ready(function(){
  $('#t_pseudo').keyup(function(){
  $('#pseudo_message').html('');
  var searchString = $(this).val();
  if(searchString != ""){
    $.ajax({
        type: 'GET',
        url: 'verif_champs.php',
        data: 'searchString=' + encodeURIComponent(searchString),
        success: function(data){
          if(data != ""){
            $('#pseudo_message').html('');
            $('#pseudo_message').append(data);
          }else{
          }
        }
      });
   }
 });
});
$(document).ready(function(){
  $('#t_password').keyup(function(){
  $('#password_message').html('');
  var searchStringP = $(this).val();
  if(searchStringP != ""){
    $.ajax({
        type: 'GET',
        url: 'verif_champs.php',
        data: 'searchStringP=' + encodeURIComponent(searchStringP),
        success: function(data){
          if(data != ""){
            $('#password_message').html('');
            $('#password_message').append(data);
          }else{
          }
        }
      });
   }
 });
});
$(document).ready(function(){
  $('#t_firstname').keyup(function(){
  $('#first_name_message').html('');
  var searchStringF = $(this).val();
  if(searchStringF != ""){
    $.ajax({
        type: 'GET',
        url: 'verif_champs.php',
        data: 'searchStringF=' + encodeURIComponent(searchStringF),
        success: function(data){
          if(data != ""){
            $('#first_name_message').html('');
            $('#first_name_message').append(data);
          }else{
          }
        }
      });
   }
 });
});
$(document).ready(function(){
  $('#t_familyname').keyup(function(){
  $('#family_name_message').html('');
  var searchStringFN = $(this).val();
  if(searchStringFN != ""){
    $.ajax({
        type: 'GET',
        url: 'verif_champs.php',
        data: 'searchStringFN=' + encodeURIComponent(searchStringFN),
        success: function(data){
          if(data != ""){
            $('#family_name_message').html('');
            $('#family_name_message').append(data);
          }else{
          }
        }
      });
   }
 });
});
function submitform()
{
  t_firstname = document.getElementById("t_firstname");
  t_familyname = document.getElementById("t_familyname");
  t_pseudo = document.getElementById("t_pseudo");
  t_sexe = document.getElementById("t_sexe");
  t_mail = document.getElementById("t_mail");
  t_password = document.getElementById("t_password");
  t_password_bis = document.getElementById("t_password_bis");
  if(t_firstname.value == "" || t_familyname.value == "" || t_pseudo.value == "" || t_sexe.value == "" || t_mail.value == "" || t_password.value == "" || t_password_bis.value == ""){
    t_firstname.style.border = "solid";
    t_firstname.style.borderColor = "red";
    t_firstname.style.borderWidth = "1px";
    t_familyname.style.border = "solid";
    t_familyname.style.borderColor = "red";
    t_familyname.style.borderWidth = "1px";
    t_pseudo.style.border = "solid";
    t_pseudo.style.borderColor = "red";
    t_pseudo.style.borderWidth = "1px";
    t_sexe.style.border = "solid";
    t_sexe.style.borderColor = "red";
    t_sexe.style.borderWidth = "1px";
    t_mail.style.border = "solid";
    t_mail.style.borderColor = "red";
    t_mail.style.borderWidth = "1px";
    t_password.style.border = "solid";
    t_password.style.borderColor = "red";
    t_password.style.borderWidth = "1px";
    t_password_bis.style.border = "solid";
    t_password_bis.style.borderColor = "red";
    t_password_bis.style.borderWidth = "1px";
    t_firstname.required = true;
    t_familyname.required = true;
    t_pseudo.required = true;
    t_sexe.required = true;
    t_mail.required = true;
    t_password.required = true;
    t_password_bis.required = true;
    return false;
  }else if(t_password.value != t_password_bis.value){
    t_password.style.border = "solid";
    t_password.style.borderColor = "red";
    t_password.style.borderWidth = "1px";
    t_password_bis.style.border = "solid";
    t_password_bis.style.borderColor = "red";
    t_password_bis.style.borderWidth = "1px";
    alert("Mot de passe non identiques!");
    return false;
  }else if(t_password.value.length<=6){
    t_password.style.border = "solid";
    t_password.style.borderColor = "red";
    t_password.style.borderWidth = "1px";
    alert("Mot de passe doit avoir plus de 6 caracteres!");
    return false;
  }else if(t_pseudo.value.length>=15){
    t_pseudo.style.border = "solid";
    t_pseudo.style.borderColor = "red";
    t_pseudo.style.borderWidth = "1px";
    alert("Le pseudo doit avoir moins de 15 caracteres!");
    return false;
  }else{
    //return true;
  };
}
