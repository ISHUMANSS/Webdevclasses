//APPENDIX : USING POST
// file simpleajax.js
// using POST method
var xhr = new XMLHttpRequest(); //create the request to handle HTTP
function getData(dataSource, divID, aName, aPwd) {
    //if the xhr function exists
    if(xhr) {
        //find the element where the servers responser will be showen
        var obj = document.getElementById(divID);

        //creates the request body
        var requestbody ="name="+encodeURIComponent(aName)+"&pwd="+encodeURIComponent(aPwd);
        
        //open the post request to the server
        //I think this means its able to get the post data
        xhr.open("POST", dataSource, true);
        
        //set the contenxt type so the serve knows to expect URL encoded data so like post data
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        //this is the call back function
        xhr.onreadystatechange = function() {
        alert(xhr.readyState); // to let us see the state of the computation
        //when ready state is for it is done
        //when status is 200 the response is OK
        if (xhr.readyState == 4 && xhr.status == 200) {
            obj.innerHTML = xhr.responseText;
            } // end if
        } // end anonymous call-back function
        
        //sends back the request data
        xhr.send(requestbody);
        
    } // end if
} // end function getData()
