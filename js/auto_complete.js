let autocomplete;

function initializeAutocomplete(){
  // console.log('here i am');

  let element = document.getElementById('locationTextField');
  if (element) {
		let option={
		componentRestrictions: {country: "fr"}
		}
    autocomplete = new google.maps.places.Autocomplete(element,option);
		autocomplete.setFields(
           ['address_components', 'geometry', 'icon', 'name']);

    google.maps.event.addListener(autocomplete,'place_changed',function(){
		// console.log(autocomplete.getPlace().geometry.location);
		let latitude=autocomplete.getPlace().geometry.location.lat();
		let longitude=autocomplete.getPlace().geometry.location.lng();
		console.log(longitude);
		console.log(latitude);
		document.getElementById('latitude').value=latitude;
		document.getElementById('longitude').value=longitude;
		});
  }
}
google.maps.event.addDomListener(window,"load",initializeAutocomplete);

// let input = document.getElementById('locationTextField')
// document.addEventListener('keydown',function(e){
//   if(e.key === "Enter" && e.target===input){
//     e.preventDefault();
//   }
// }
// function autocompletev2(){
//   let autocompletion=new google.maps.places.Autocomplete(document.getElementById('locationTextField'));
//   google.maps.event.addListener(autocompletion,"place_changed",function(){
//     let place = autocompletion.getPlace();
//     console.log(place);
//   })
// }
//
// google.maps.event.addDomListener(window,"load",autocompletev2);
