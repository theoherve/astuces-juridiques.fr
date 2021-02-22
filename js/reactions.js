function add_del_reaction(id_article, id_reaction, id_user){
  const request = new XMLHttpRequest();
  request.open('GET', 'add_del_reaction.php?id_article='+ id_article + '&id_reaction=' + id_reaction + '&id_user=' + id_user);
  request.onreadystatechange = function(){
    if(request.readyState === 4){ // la requete est terminée
      if (id_reaction == 1) {
        const divNumber = document.getElementById('statNumber1'+id_article);
        divNumber.innerHTML = "";
        divNumber.innerHTML = request.responseText;
      }
      if (id_reaction == 2) {
        const divNumber = document.getElementById('statNumber2'+id_article);
        divNumber.innerHTML = "";
        divNumber.innerHTML = request.responseText;
      }
      if (id_reaction == 3) {
        const divNumber = document.getElementById('statNumber3'+id_article);
        divNumber.innerHTML = "";
        divNumber.innerHTML = request.responseText;
      }
      if (id_reaction == 4) {
        const divNumber = document.getElementById('statNumber4'+id_article);
        divNumber.innerHTML = "";
        divNumber.innerHTML = request.responseText;
      }
    }
  };
  request.send();
}
