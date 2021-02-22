//header.js
//header Théo

let openHeader3 = 0;

function openCloseheader3(){
	let header3hamburger = document.getElementById('header3hamburger');
	if(openHeader3 === 0){
    header3hamburger.style.display = "flex";
    header3hamburger.style.animation = ".5s fade-in cubic-bezier(.28, .91, .46, 1)";
    openHeader3 = 1 ;
  }else{
    header3hamburger.style.animation = ".5s fade-out cubic-bezier(.28, .91, .46, 1)";
    setTimeout(function(){
      header3hamburger.style.display = "none";
    },200);
    openHeader3 = 0;
  }
}

window.onclick = function(event){
	if(!event.target.matches('.drop_down_content_header3') && !event.target.matches('.dropbtn') && openHeader3 == 1){
		const dropdowns = document.getElementsByClassName('drop_down_content_header3');
		for(let i = 0; i < dropdowns.length; i++){
			const opened = dropdowns[i];
			if(opened.style.display === "flex"){
				opened.style.display = "none";
				openHeader3 = 0;
			}
		}
	}
}

function check(id) {
document.getElementById(id).checked = true;
}

function openCloseFilter() {
	document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
	if (!event.target.matches('.dropbtnFilter')) {
		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
			}
		}
	}
}

//header Ivan pc

$(document).ready(function(){
  $('#search-string').keyup(function(){
    $('#result-search').html('');
    var searchString = $(this).val();
    if(searchString != ""){
      $.ajax({
          type: 'GET',
          url: 'includes/recherche.php',
          data: 'searchString=' + encodeURIComponent(searchString),
          success: function(data){
            if(data != ""){
							// console.log("ok");
              $('#result-search').html('');
              $('#result-search').append(data);
            }else{
            }
          }
        });
     }
  });
});

window.onclick = function(event){
	let divResult = document.getElementById('result-search');
  let divResp = document.getElementById('search-string');
  if(event.target.id!="search-string" && event.target.id!="resAvocat" && event.target.id!="resAstuces" && event.target.id!="resBlog"){
    divResult.style.display= "none";
    divResp.value= "";
    $('#result-search').html('');
  }else{
    divResult.style.display="block";
  }

	let divResultMoblie = document.getElementById('result-search-mobile');
  let divRespMobile = document.getElementById('search-string-mobile');
  if(event.target.id!="search-string-mobile" && event.target.id!="resAvocat" && event.target.id!="resAstuces" && event.target.id!="resBlog"){
    divResultMoblie.style.display= "none";
    divRespMobile.value= "";
    $('#result-search-mobile').html('');
  }else{
    divResultMoblie.style.display="block";
  }

  //header notif et flèche
  if(!event.target.matches('.drop_down_content') && !event.target.matches('.dropbtn') && (openDropDown == 1 || openDropDownMain == 1)){
		const dropdowns = document.getElementsByClassName('drop_down_content');
		for(let i = 0; i < dropdowns.length; i++){
			const opened = dropdowns[i];
			if(opened.style.display === "flex"){
				opened.style.display = "none";
				openDropDown = 0;
				openDropDownMain = 0;
			}
		}
	}

	//headerMobile notif et flèche
  if(!event.target.matches('.drop_down_content') && !event.target.matches('.dropbtn') && (openDropDownMobile == 1 || openDropDownMainMobile == 1)){
		const dropdowns = document.getElementsByClassName('drop_down_content');
		for(let i = 0; i < dropdowns.length; i++){
			const opened = dropdowns[i];
			if(opened.style.display === "flex"){
				opened.style.display = "none";
				openDropDownMobile = 0;
				// console.log(openDropDownMobile);
				openDropDownMainMobile = 0;
				// console.log(openDropDownMainMobile);
			}
		}
	}

  //modal usersLikes
  if(!event.target.matches('.mod_content_users_likes') && !event.target.matches('.btn_modal') && openUsersLikes == 1){
		const dropdowns = document.getElementsByClassName('modal_bg_users_likes');
		for(let i = 0; i < dropdowns.length; i++){
			const openedModal = dropdowns[i];
			if(openedModal.style.display === "flex"){
				openedModal.style.display = "none";
				openUsersLikes = 0;
			}
		}
	}
}

//research Ivan mobile

$(document).ready(function(){
  $('#search-string-mobile').keyup(function(){
    $('#result-search-mobile').html('');


    var searchString = $(this).val();
    if(searchString != ""){
      $.ajax({
          type: 'GET',
          url: 'includes/recherche.php',
          data: 'searchString=' + encodeURIComponent(searchString),
          success: function(data){
            if(data != ""){
              $('#result-search-mobile').html('');
              $('#result-search-mobile').append(data);
            }else{
            }
          }
        });
     }
  });
});
