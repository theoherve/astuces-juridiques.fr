first = false;
modOpens = document.getElementsByClassName('btn_modal');
modCloses = document.getElementsByClassName('close_mod');
for(let i = 0 ; i<modOpens.length ; ++i){
	modOpens[i].onclick = function(){
		let modal = document.getElementById(this.dataset['modal']);
		modal.style.display = "flex";
		modal.style.animation = ".5s fade-in cubic-bezier(.28, .91, .46, 1)";
		window.onclick = function(event){
			if((event.target === modal) && (first===true)){
				hideMod(modal);
			}
			first = true;
		}
	};
}

for(let i = 0 ; i < modCloses.length ; ++i){
	modCloses[i].onclick = function(){
		let modal = document.getElementById(this.dataset['modal']);
		hideMod(modal);
	}
}
function hideMod(modal){
	modal.style.animation = ".5s fade-out cubic-bezier(.28, .91, .46, 1)";
	setTimeout(function(){
		modal.style.display = "none";
	},1);
}
