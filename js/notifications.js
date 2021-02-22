let openUsersLikes;

let openDropDown = 0;
let openDropDownMain = 0;
let dropbtn = document.getElementsByName("dropbtn");
let openDropDownMobile = 0;
let openDropDownMainMobile = 0;

function usersLikes(id_article, id_comment){
	let divUsersLikes = document.getElementById('usersLikes'+id_article);
	openUsersLikes = 0;
	if(openUsersLikes === 0){
    divUsersLikes.style.display = "flex";
    divUsersLikes.style.animation = ".5s fade-in cubic-bezier(.28, .91, .46, 1)";
    openUsersLikes = 1 ;
		displayUsersLikes(id_article, id_comment);
  }else{
    divUsersLikes.style.animation = ".5s fade-out cubic-bezier(.28, .91, .46, 1)";
    setTimeout(function(){
      divUsersLikes.style.display = "none";
    },250);
    openUsersLikes = 0;
  }
}

function displayUsersLikes(id_article, id_comment){
	const requestUsersLikes = new XMLHttpRequest();
  requestUsersLikes.open('GET', 'display_users_likes.php?id_article='+ id_article + '&id_comment='+id_comment);
  requestUsersLikes.onreadystatechange = function(){
    if(requestUsersLikes.readyState === 4){ // la requete est terminée
      let divUsersLikes = document.getElementById('mod_main_users_likes');
      divUsersLikes.innerHTML = requestUsersLikes.responseText;
    }
  }
  requestUsersLikes.send();
}

//dropDown

function checkBox(check){
	check.nextElementSibling.classList.toggle('checked');
}

//dropDownHeaderDesktop

function openCloseNotification(){
	let dropDownDivId = document.getElementById('dropDownNotificationDiv');
	if(openDropDown === 0){
    dropDownDivId.style.display = "flex";
    dropDownDivId.style.animation = ".5s fade-in cubic-bezier(.28, .91, .46, 1)";
    openDropDown = 1 ;
		displayNotifications();
		hasBeenRead();
		displayBadgeNotifications();
		if(openDropDownMain == 1){
				openCloseMain();
				openDropDownMain = 0;
		}
  }else{
    dropDownDivId.style.animation = ".5s fade-out cubic-bezier(.28, .91, .46, 1)";
    setTimeout(function(){
      dropDownDivId.style.display = "none";
    },250);
    openDropDown = 0;
  }
}

function openCloseMain(){
	favoritesNumber();
	let dropDownMainDiv = document.getElementById('dropDownMainDiv');
	if(openDropDownMain === 0){

    dropDownMainDiv.style.display = "flex";
    dropDownMainDiv.style.animation = ".5s fade-in cubic-bezier(.28, .91, .46, 1)";
    openDropDownMain = 1 ;
		if(openDropDown == 1){
				openCloseNotification();
				openDropDown = 0;
		}
  }else{
    dropDownMainDiv.style.animation = ".5s fade-out cubic-bezier(.28, .91, .46, 1)";
    setTimeout(function(){
      dropDownMainDiv.style.display = "none";
    },250);
    openDropDownMain = 0;
  }
}


//dropDownHeader Mobile

function openCloseNotificationMobile(){
	let dropDownDivIdMobile = document.getElementById('dropDownNotificationDivMobile');
	if(openDropDownMobile === 0){
    dropDownDivIdMobile.style.display = "flex";
    dropDownDivIdMobile.style.animation = ".5s fade-in cubic-bezier(.28, .91, .46, 1)";
    openDropDownMobile = 1 ;
		displayNotifications();
		hasBeenRead();
		displayBadgeNotificationsMobile();
		if(openDropDownMainMobile == 1){
				openCloseMainMobile();
				openDropDownMainMobile = 0;
		}
  }else{
    dropDownDivIdMobile.style.animation = ".5s fade-out cubic-bezier(.28, .91, .46, 1)";
    setTimeout(function(){
      dropDownDivIdMobile.style.display = "none";
    },250);
    openDropDownMobile = 0;
  }
}

function openCloseMainMobile(){
	favoritesNumber();
	let dropDownMainDivMobile = document.getElementById('dropDownMainDivMobile');
	if(openDropDownMainMobile === 0){
    dropDownMainDivMobile.style.display = "flex";
    dropDownMainDivMobile.style.animation = ".5s fade-in cubic-bezier(.28, .91, .46, 1)";
    openDropDownMainMobile = 1 ;
		if(openDropDownMobile == 1){
				openCloseNotificationMobile();
				openDropDownMobile = 0;
		}
  }else{
    dropDownMainDivMobile.style.animation = ".5s fade-out cubic-bezier(.28, .91, .46, 1)";
    setTimeout(function(){
      dropDownMainDivMobile.style.display = "none";
    },250);
    openDropDownMainMobile = 0;
  }
}


//notifications

function displayNotifications(){
  const requestComments = new XMLHttpRequest();
  requestComments.open('GET', 'display_notifications.php');
  requestComments.onreadystatechange = function(){
    if(requestComments.readyState === 4){
      let divNotifications = document.getElementById('dropDownNotificationDiv');
      divNotifications.innerHTML = requestComments.responseText;
			let divNotificationsMobile = document.getElementById('dropDownNotificationDivMobile');
      divNotificationsMobile.innerHTML = requestComments.responseText;
    }
  }
  requestComments.send();
}

function hasBeenRead(){
	const requestHasBeenRead = new XMLHttpRequest();
  requestHasBeenRead.open('GET', 'has_been_read.php');
  requestHasBeenRead.onreadystatechange = function(){
    if(requestHasBeenRead.readyState === 4){
			displayBadgeNotifications();
    }
  }
  requestHasBeenRead.send();
}

function addNotificationComment(type, id_article, to_id_user, id_comment){
	const requestAddNotif = new XMLHttpRequest();
	requestAddNotif.open('GET', 'add_notification.php?type='+type+'&id_article='+id_article+'&to_id_user='+to_id_user+'&id_comment='+id_comment);
	requestAddNotif.onreadystatechange = function(){
		if(requestAddNotif.readyState === 4){
			// let divDisplayNotif = document.getElementById('divDisplayNotif');
			// divDisplayNotif.innerHTML = requestComments.responseText;
		}
	}
	requestAddNotif.send();
}

function displayBadgeNotifications(){
	const requestBadgeNotifications = new XMLHttpRequest();
	requestBadgeNotifications.open('GET', 'display_badge_notifications.php');
	requestBadgeNotifications.onreadystatechange = function(){
		if(requestBadgeNotifications.readyState === 4){
			let divBadgeNotifications = document.getElementById('displayBadgeNotifications');
			divBadgeNotifications.innerHTML = requestBadgeNotifications.responseText;
		}
	}
	requestBadgeNotifications.send();
}

function displayBadgeNotificationsMobile(){
	const requestBadgeNotifications = new XMLHttpRequest();
	requestBadgeNotifications.open('GET', 'display_badge_notifications_mobile.php');
	requestBadgeNotifications.onreadystatechange = function(){
		if(requestBadgeNotifications.readyState === 4){
			let divBadgeNotificationsMobile = document.getElementById('displayBadgeNotificationsMobile');
			divBadgeNotificationsMobile.innerHTML = requestBadgeNotifications.responseText;
		}
	}
	requestBadgeNotifications.send();
}
