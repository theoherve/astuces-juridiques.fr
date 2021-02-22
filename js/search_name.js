function search_name_lawyer()
{
	let input = document.getElementById('search_key_word').value;
	input=input.trim();
	if(input!="")
	{
		let divRes = document.getElementById('column_1_3');
		divRes.style.display = "flex";
		console.log(input);
		const requestHasBeenRead=new XMLHttpRequest();
		requestHasBeenRead.open('GET', 'search_a_name.php?input='+input);
		requestHasBeenRead.onreadystatechange=function()
		{
			if(requestHasBeenRead.readyState===4)
			{
				if(requestHasBeenRead.status==200)
				{
					console.log(requestHasBeenRead.responseText);
					document.getElementById('column_1_3').innerHTML=requestHasBeenRead.responseText;
				}
			}
		}
		requestHasBeenRead.send();
	}else{
		document.getElementById('column_1_3').innerHTML="";
	}
}
