// function footer_ajax_change(){
//   let request = new XMLHttpRequest();
//   let id = document.getElementById('id_user');
//   let user = id.value;
//
//   request.open('GET', 'footer_process.php?token=0&id=' + user);
//   request.onreadystatechange = function() {
//     if(request.readyState == 4) {
//       let res = request.responseText;
//       console.log(res);
//     }
//   };
//   request.send();
// }
//
//
// function footer_ajax_away(){
//   let request = new XMLHttpRequest();
//
//   request.open('GET', 'footer_process.php?token=1' + '&id=' + user);
//   request.onreadystatechange = function() {
//     if(request.readyState == 4) {
//       let res = request.responseText;
//       console.log(res);
//     }
//   };
//   request.send();
// }
//
//
// function footer_ajax_start(){ //POST???
//   let request = new XMLHttpRequest();
//   let mail = getElementById('footer_search_mail');
//   let email = mail.value;
//   email = email.trim;
//   request.open('GET', 'footer_process.php?addr_mail=' + email);
//   request.onreadystatechange = function() {
//     if(request.readyState == 4) {
//       let res = request.responseText;
//       console.log(res);
//     }
//   };
//   request.send();
// }

function change_newsletter_status_subscribe(id_user, newsletter, token){
  let reqNewsletter = new XMLHttpRequest();
  reqNewsletter.open('GET', 'includes/footer_process.php?id_user='+id_user+"&newsletter="+newsletter+"&token="+token);
  reqNewsletter.onreadystatechange = function(){
    if(reqNewsletter.readyState === 4){
      if(reqNewsletter.status == 200){
        let newslettersButtonSubscribe = document.getElementById('divNewsletter');
        newslettersButtonSubscribe.innerHTML = reqNewsletter.responseText;
      }
    }
  }
  reqNewsletter.send();
}

function change_newsletter_status_unsubscribe(id_user, newsletter, token){
  let reqNewsletter = new XMLHttpRequest();
  reqNewsletter.open('GET', 'includes/footer_process.php?id_user='+id_user+"&newsletter="+newsletter+"&token="+token);
  reqNewsletter.onreadystatechange = function(){
    if(reqNewsletter.readyState === 4){
      if(reqNewsletter.status == 200){
        let newslettersButtonUnsubscribe = document.getElementById('divNewsletter');
        newslettersButtonUnsubscribe.innerHTML = reqNewsletter.responseText;
      }
    }
  }
  reqNewsletter.send();
}
