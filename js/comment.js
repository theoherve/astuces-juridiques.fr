let open = 0;
let id_article_function ;
var answerCalled = 0;
let $_GET = {};

$getInJS();

function display_comments(id_article, scroll=true){
  id_article_function = id_article;
  const requestComments = new XMLHttpRequest();
  requestComments.open('GET', 'display_comments.php?id_article='+ id_article);
  requestComments.onreadystatechange = function(){
    if(requestComments.readyState === 4){ // la requete est terminée
      let divComments = document.getElementById('divComment'+id_article);
      divComments.innerHTML = requestComments.responseText;
      if(scroll){
        divComments.scrollTop = divComments.scrollHeight;
      }
      // divComments.scrollTop = 0;
    }
  }
  requestComments.send();
  CommentsNumber(id_article);
}

function display_comments_answer(id_article, scroll=true){
  id_article_function = id_article;
  const requestComments = new XMLHttpRequest();
  requestComments.open('GET', 'display_comments.php?id_article='+ id_article);
  requestComments.onreadystatechange = function(){
    if(requestComments.readyState === 4){ // la requete est terminée
      let divComments = document.getElementById('divComment'+id_article);
      divComments.innerHTML = requestComments.responseText;
      if(scroll){
        divComments.scrollTop = divComments.scrollHeight;
      }
      // divComments.scrollTop = 0;
      // console.log($_GET.id_answer_comment);
      openSmoothAstuceAnswer(id_article, $_GET.id_answer_comment);
    }
  }
  requestComments.send();
  CommentsNumber(id_article);
}

function display_comments_like(id_article, scroll=true){
  id_article_function = id_article;
  const requestComments = new XMLHttpRequest();
  requestComments.open('GET', 'display_comments.php?id_article='+ id_article);
  requestComments.onreadystatechange = function(){
    if(requestComments.readyState === 4){ // la requete est terminée
      let divComments = document.getElementById('divComment'+id_article);
      divComments.innerHTML = requestComments.responseText;
      if(scroll){
        divComments.scrollTop = divComments.scrollHeight;
      }
      // divComments.scrollTop = 0;
      openSmoothAstuceLike(id_article, $_GET.id_comment);
    }
  }
  requestComments.send();
  CommentsNumber(id_article);
}

//  the good one
function openClose(id_article){
  id_article_function = id_article;
  let divComments = document.getElementById('divComments'+id_article);
  if(!divComments.classList.contains("showComments")){
    let classOpened = document.getElementsByClassName("showComments");
    for(var i = 0; i < classOpened.length; i++){
      classOpened[i].classList.remove("showComments");
    }
    divComments.classList.add("showComments");
    divComments.style.animation = "fade-in .5s cubic-bezier(.28, .91, .46, 1) 0s 1 normal forwards";
    open = 1 ;
  }else{
    divComments.style.animation = "fade-out .5s cubic-bezier(.28, .91, .46, 1) 0s 1 normal forwards";
    setTimeout(function(){
      divComments.classList.remove("showComments");
    },250);
    open = 0;
  }
  display_comments(id_article);
}

function openCloseAnswer(id_article){
  id_article_function = id_article;
  let divComments = document.getElementById('divComments'+id_article);
  if(!divComments.classList.contains("showComments")){
    let classOpened = document.getElementsByClassName("showComments");
    for(var i = 0; i < classOpened.length; i++){
      classOpened[i].classList.remove("showComments");
    }
    divComments.classList.add("showComments");
    divComments.style.animation = "fade-in .5s cubic-bezier(.28, .91, .46, 1) 0s 1 normal forwards";
    open = 1 ;
  }else{
    divComments.style.animation = "fade-out .5s cubic-bezier(.28, .91, .46, 1) 0s 1 normal forwards";
    setTimeout(function(){
      divComments.classList.remove("showComments");
    },250);
    open = 0;
  }
  display_comments_answer(id_article);
}

function openCloseLike(id_article){
  id_article_function = id_article;
  let divComments = document.getElementById('divComments'+id_article);
  if(!divComments.classList.contains("showComments")){
    let classOpened = document.getElementsByClassName("showComments");
    for(var i = 0; i < classOpened.length; i++){
      classOpened[i].classList.remove("showComments");
    }
    divComments.classList.add("showComments");
    divComments.style.animation = "fade-in .5s cubic-bezier(.28, .91, .46, 1) 0s 1 normal forwards";
    open = 1 ;
  }else{
    divComments.style.animation = "fade-out .5s cubic-bezier(.28, .91, .46, 1) 0s 1 normal forwards";
    setTimeout(function(){
      divComments.classList.remove("showComments");
    },250);
    open = 0;
  }
  display_comments_like(id_article);
}

function change_like_status(id_user, id_article, id_comment){
  const requestLike = new XMLHttpRequest();
  requestLike.open('GET', 'change_like_status.php?id_comment='+id_comment);
    requestLike.onreadystatechange = function(){
    if(requestLike.readyState === 4){ // la requete est terminée
      if(requestLike.status == 200){
        let divLike = document.getElementById('like'+id_comment);
        let divLikeDone = document.getElementById('likeDone'+id_comment);
        if(typeof(divLike) != 'undefined' && divLike != null){
          divLike.innerHTML = "";
          divLike.innerHTML = requestLike.responseText;
          // element.classList.toggle('hide');
          let type = 'like';
          addNotificationComment(type, id_article, id_user, id_comment);
        }
        if(typeof(divLikeDone) != 'undefined' && divLikeDone != null){
          divLikeDone.innerHTML = "";
          divLikeDone.innerHTML = requestLike.responseText;
          let type = 'like';
          addNotificationComment(type, id_article, id_user, id_comment);
        }
        display_comments(id_article_function, false);
      }
    }
  }
  requestLike.send();
  setTimeout(function(){
    display_comments(id_article_function, false);
  },300);
}

function change_like_status_right(id_user, id_article, id_comment){
  const requestLike = new XMLHttpRequest();
  requestLike.open('GET', 'change_like_status_right.php?id_comment='+id_comment);
    requestLike.onreadystatechange = function(){
    if(requestLike.readyState === 4){ // la requete est terminée
      if(requestLike.status == 200){
        let divLike = document.getElementById('like'+id_comment);
        let divLikeDone = document.getElementById('likeDone'+id_comment);
        if(typeof(divLike) != 'undefined' && divLike != null){
          divLike.innerHTML = "";
          divLike.innerHTML = requestLike.responseText;
          let type = 'like';
          addNotificationComment(type, id_article, id_user, id_comment);
        }
        if(typeof(divLikeDone) != 'undefined' && divLikeDone != null){
          divLikeDone.innerHTML = "";
          divLikeDone.innerHTML = requestLike.responseText;
          let type = 'like';
          addNotificationComment(type, id_article, id_user, id_comment);
        }
        display_comments(id_article_function, false);
      }
    }
  }
  requestLike.send();
  setTimeout(function(){
    display_comments(id_article_function, false);
  },300);
}

function add_comment(id_article, input, id_user){
  if(input.querySelector('span.pseudoAnswer')===null){
    id_article_function = id_article;
    let inputComment = document.getElementById('inputComment'+id_article);
    let comment = inputComment.innerHTML;
    if(typeof(id_user) == 'undefined' || id_user == null){
      alert("Vous devez être connecté pour écrire un commentaire !");
      return;
    }
    if(comment.length === 0){
      alert("Votre commentaire est vide !");
      return;
    }
    const requestAddComment = new XMLHttpRequest;
    requestAddComment.open('POST', 'add_comment.php');
  	requestAddComment.onreadystatechange = function(){
  		if(requestAddComment.readyState === 4){
  			if(requestAddComment.status === 200){
          display_comments(id_article);
          // console.log(requestAddComment.responseText);
  			}
  		}
  	}
  	requestAddComment.setRequestHeader('Control-Cache','no-cache');
  	requestAddComment.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  	requestAddComment.send('id_article='+id_article+'&comment='+comment);
    inputComment.innerHTML = "";
    let divComments = document.getElementById('divComment'+id_article);
    // console.log(divComments.scrollHeight);
    setTimeout(function(){
      display_comments(id_article);
    },300);
    // console.log(divComments.scrollHeight);
  }else{
    id_comment = answerCalled;
    let inputComment = document.getElementById('inputComment'+id_article);
    let comment = inputComment.innerHTML;
    if(typeof(id_user) == 'undefined' || id_user == null){
      alert("Vous devez être connecté pour écrire un commentaire !");
      return;
    }
    if(comment.length === 0){
      alert("Votre commentaire est vide !");
      return;
    }
    let type = 'comment';
    const requestAddComment = new XMLHttpRequest;
    requestAddComment.open('POST', 'add_answer_comment.php?id_comment='+id_comment+'&to_id_user='+to_user+'&type='+type);
  	requestAddComment.onreadystatechange = function(){
  		if(requestAddComment.readyState === 4){
  			if(requestAddComment.status === 200){
          // let divComments = document.getElementById('divComment'+id_article);
          // divComments.innerHTML = requestAddComment.responseText;
          // requestAddComment.responseText;
          // addNotificationComment(type, id_article, to_id_user, id_comment);
          display_comments(id_article);
          answerCalled = 0;
  			}
  		}
  	}
  	requestAddComment.setRequestHeader('Control-Cache','no-cache');
  	requestAddComment.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  	requestAddComment.send('id_article='+id_article+'&comment='+comment);
    inputComment.innerHTML = "";
    let divComments = document.getElementById('divComment'+id_article);
    setTimeout(function(){
      display_comments(id_article);
    },300);
  }
}

function enter(event, id_article, input, id_user){
  if(event.code == 'Enter' || event.code == 'NumpadEnter'){
    add_comment(id_article, input, id_user);
    event.preventDefault();
  }
}

let to_user = 0;
function answer(to_id_user, id_article, id_comment, id_user){
  let inputComment = document.getElementById('inputComment'+id_article);
  inputComment.innerHTML = "<span class=\"pseudoAnswer\" spellcheck=\"false\">@"+to_id_user+"</span><span spellcheck=\"true\"> </span>";
  setCurrentCursorPosition(document.getElementById('inputComment'+id_article).innerText.length+30, id_article);
  answerCalled = id_comment;
  to_user = to_id_user;
}

//Range thing

function createRange(node, chars, range){
  if(!range){
    range = document.createRange()
    range.selectNode(node);
    range.setStart(node, 0);
  }

  if(chars.count === 0){
    range.setEnd(node, chars.count);
  }else if(node && chars.count > 0){
    if(node.nodeType === Node.TEXT_NODE){
      if(node.textContent.length < chars.count){
        chars.count -= node.textContent.length;
      }else{
        range.setEnd(node, chars.count);
        chars.count = 0;
      }
    }else{
      for(var lp = 0 ; lp < node.childNodes.length ; lp++){
        range = createRange(node.childNodes[lp], chars, range);
        if(chars.count === 0){
          break;
        }
      }
    }
  }

  return range;
};

function setCurrentCursorPosition(chars, id_article){
  if(chars >= 0){
    var selection = window.getSelection();

    range = createRange(document.getElementById("inputComment"+id_article).parentNode, {
      count: chars
    });

    if(range){
      range.collapse(false);
      selection.removeAllRanges();
      selection.addRange(range);
    }
  }
};

function delComment(id_comment,id_article){
  const requestComments = new XMLHttpRequest();
  requestComments.open('GET', 'del_comment.php?id_comment='+ id_comment+'&id_article='+id_article);
  requestComments.onreadystatechange = function(){
    if(requestComments.readyState === 4){ // la requete est terminée
    }
  }
  requestComments.send();
  display_comments(id_article);
}

function delAnswerComment(id_answer_comment,id_article){
  const requestComments = new XMLHttpRequest();
  requestComments.open('GET', 'del_answer_comment.php?id_answer_comment='+ id_answer_comment+'&id_article='+id_article);
  requestComments.onreadystatechange = function(){
    if(requestComments.readyState === 4){ // la requete est terminée
    }
  }
  requestComments.send();
  display_comments(id_article);
}

//function return $_GET in js
function $getInJS(){
  if(window.location.href.split('?')[1]!==undefined){
    let temp = window.location.href.split('?')[1].split('&');
    for(let i = 0; i < temp.length; ++i){
        Object.defineProperty($_GET, temp[i].split('=')[0],{value : temp[i].split('=')[1]});
    }
  }
}


//scrool smoothely in astuce.php
function openSmoothAstuceAnswer(id_article, id_answer_comment){
  let divComments = document.getElementById('divComment'+id_article);
  var divAnswerComment = document.getElementById('answer_comment'+id_answer_comment);

  var posY_top = divAnswerComment.offsetTop;  //get the position from top
  var posX_left = divAnswerComment.offsetLeft; //get the position from left

  var elementTop = divAnswerComment.offsetTop;
  var divTop = divComments.offsetTop;
  var elementRelativeTop = elementTop - divTop;
  elementRelativeTop -= divComments.offsetHeight - divAnswerComment.offsetHeight;

  divComments.scrollTo({
    top: elementRelativeTop,
    left: posX_left
  });

  divTop -= window.innerHeight - divComments.offsetHeight - 150;

  window.scrollTo({
    top: divTop,
    left: posX_left,
    behavior: 'smooth'
  });
}

function openSmoothAstuceLike(id_article, id_comment){
  let divComments = document.getElementById('divComment'+id_article);
  var divAnswerComment = document.getElementById('comment'+id_comment);

  var posY_top = divAnswerComment.offsetTop;  //get the position from top
  var posX_left = divAnswerComment.offsetLeft; //get the position from left

  var elementTop = divAnswerComment.offsetTop;
  var divTop = divComments.offsetTop;
  var elementRelativeTop = elementTop - divTop;
  elementRelativeTop -= divComments.offsetHeight - divAnswerComment.offsetHeight;

  divComments.scrollTo({
    top: elementRelativeTop,
    left: posX_left
  });

  divTop -= window.innerHeight - divComments.offsetHeight - 150;

  window.scrollTo({
    top: divTop,
    left: posX_left,
    behavior: 'smooth'
  });
}

function CommentsNumber(id_article){
  const requestCommentsNumber = new XMLHttpRequest();
  requestCommentsNumber.open('GET', 'get_comments_number.php?id_article='+id_article);
  requestCommentsNumber.onreadystatechange = function(){
    if(requestCommentsNumber.readyState === 4){ // la requete est terminée
      let buttonComment = document.getElementById('buttonComment');
      buttonComment.innerHTML = requestCommentsNumber.responseText;
    }
  }
  requestCommentsNumber.send();
}
