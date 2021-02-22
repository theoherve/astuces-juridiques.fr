function change_favoris_status(id_article, id_user){
  const req = new XMLHttpRequest();
  req.open('GET', 'change_favoris_status.php?id_article='+id_article+'&id_user='+id_user);
    req.onreadystatechange = function(){
    if(req.readyState === 4){ // la requete est terminée
      if (req.status == 200) {
        let imgFavoris = document.getElementById('imgFavoris'+id_article);
        let imgFavorisDone = document.getElementById('imgFavorisDone'+id_article);
        if(typeof(imgFavoris) != 'undefined' && imgFavoris != null){
          imgFavoris.innerHTML = "";
          imgFavoris.innerHTML = req.responseText;
        };
        if (typeof(imgFavorisDone) != 'undefined' && imgFavorisDone != null) {
          imgFavorisDone.innerHTML = "";
          imgFavorisDone.innerHTML = req.responseText;
        };
      }
    }
  }
  req.send();
  favoritesNumber();
}

function unlikeReload(id_article, id_user){
  change_favoris_status(id_article, id_user);
  setTimeout(function(){
    document.location.reload(true)
  }, 1000);
}

function favoritesNumber(){
  const requestFavorisNumber = new XMLHttpRequest();
  requestFavorisNumber.open('GET', 'get_favorites_number.php');
  requestFavorisNumber.onreadystatechange = function(){
    if(requestFavorisNumber.readyState === 4){ // la requete est terminée
      let divFavorisNumber = document.getElementById('favoritesNumber');
      divFavorisNumber.innerHTML = requestFavorisNumber.responseText;
      let divFavorisNumberMobile = document.getElementById('favoritesNumberMobile');
      divFavorisNumberMobile.innerHTML = requestFavorisNumber.responseText;
    }
  }
  requestFavorisNumber.send();
}

function changeAndCount(id_article, id_user){
  change_favoris_status(id_article, id_user);
  favoritesNumber();
}
