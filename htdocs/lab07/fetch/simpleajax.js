// file simpleajax.js
var xhr = createRequest();
function getData(dataSource, divID, aName, aPwd)  {
  
	var place = document.getElementById(divID);
	var url = dataSource+"?name="+aName+"&pwd="+aPwd;

	const requestPromise = fetch(url, 
		{method: "POST" , //change the method to post
		body:{
			
		},

		headers: {
			"Content-Type": "application/x-www-form-urlencoded"
		},

	});
	requestPromise.then(
		function (response){
			response.text().then(function(text) {
				place.innerHTML = text;
			});

		}
	);
} 
