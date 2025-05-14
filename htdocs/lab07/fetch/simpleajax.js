// file simpleajax.js
//var xhr = createRequest();
function getData(dataSource, divID, aName, aPwd, aEmail)  {
  
	var place = document.getElementById(divID);
	var url = dataSource;

	var requestBody = "&name=" + encodeURIComponent(aName) + 
					  "&pwd="+ encodeURIComponent(aPwd) +
					  "&email=" + encodeURIComponent(aEmail)
	;

	const requestPromise = fetch(url, {
		method: "POST" , //change the method to post
		body: requestBody,

		headers: {
			"Content-Type": "application/x-www-form-urlencoded"
		}

	});
	requestPromise.then(response => response.text())
	.then(text => {
		place.innerHTML = text;
	})
	.catch(error => {
		alert("Request failed: " + error);
	});
} 
