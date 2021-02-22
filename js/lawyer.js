function filter_by_js(){
let compo=document.getElementById('search_key_word').value;
console.log(compo);
}


function hasBeenRead(){
    const requestHasBeenRead = new XMLHttpRequest();
  requestHasBeenRead.open('GET', 'has_been_read.php');
  requestHasBeenRead.onreadystatechange = function(){
    if(requestHasBeenRead.readyState === 4){
            let divDisplayNotif = document.getElementById('divDisplayNotif');
            divDisplayNotif.innerHTML = requestComments.responseText;
    }
  }
  requestHasBeenRead.send();
}
