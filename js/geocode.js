function geocode()
{
let geo;
	let address = document.getElementById('address').value;
	let zip_code = document.getElementById('zip_code').value;
	var location= address+", "+zip_code+', France';
	// console.log(location);

	axios.get('https://maps.googleapis.com/maps/api/geocode/json',
	{
		params:{
						address:location,
						key:'AIzaSyBoo8MKtjWMz_Pp2wSNKt1weSVjW7GjQsw'
						}
	})
	.then(function(response)
	{
		var formattedAddress = response.data.results[0].formatted_address;
		var lat =response.data.results[0].geometry.location.lat;
		var long =response.data.results[0].geometry.location.lng;
		var dep = response.data.results[0].address_components[3].long_name;
		var reg = response.data.results[0].address_components[4].long_name;
		var rue = response.data.results[0].address_components[1].long_name;
		geo = response.data.results[0].geometry.location;
		// console.log(location);
		// console.log(formattedAddress);
		// console.log(geo);
		console.log(response);
		console.log(dep);
		console.log(reg);
		console.log(rue);
		document.getElementById('region').value = reg;
		document.getElementById('departement').value = dep;
		document.getElementById('rue').value = rue;
		document.getElementById('lat').value = lat;
		document.getElementById('lng').value = long;
	})
	.catch(function(error)
	{
		console.log(error);
	})
}
