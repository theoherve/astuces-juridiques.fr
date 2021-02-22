function badIdea{

  let request = new XMLHttpRequest();
    let identity = document.getElementById('num');
    let num = identity.value;
    request.open('GET', 'visu_trick_process.php?id=' + num);
    request.onreadystatechange = function() {
      if(request.readyState == 4) {
        let res = request.responseText;
        console.log(res);
      }
    };
    request.send();


}
