// JavaScript Document

function makeTable(){
	var theTable =document.getElementById("tbl");
	//IE requires rows to be added to a tBody element
	//IE automatically creates a tBody element - delete it and then manually create
	if (theTable.firstChild != null){
		var badIEBody = theTable.childNodes[0];  
		theTable.removeChild(badIEBody);
	}
	var tBody = document.createElement("TBODY");
	theTable.appendChild(tBody);

	var newRow = document.createElement("tr");
	var c1 = document.createElement("td");
	var v1 = document.createTextNode("7308");
	c1.appendChild(v1);
	newRow.appendChild(c1);
	var c2 = document.createElement("td");
	var v2 = document.createTextNode("software engineering");
	c2.appendChild(v2);
	newRow.appendChild(c2);
	tBody.appendChild(newRow);

	newRow = document.createElement("tr");
	c1 = document.createElement("td");
	v1 = document.createTextNode("7003");
	c1.appendChild(v1);
	newRow.appendChild(c1);
	c2 = document.createElement("td");
	v2 = document.createTextNode("Web Development");
	c2.appendChild(v2);
	newRow.appendChild(c2);
	tBody.appendChild(newRow);
}

function appendRow() {
	//get the needed info
	var code = prompt("enter the code","7010");
	var courseName = prompt("Enter course name:", "Database Systems");

	//get table and body
	var theTable = document.getElementById("tbl");
    var tBody = theTable.getElementsByTagName("tbody")[0];
	//create new row
	var newRow = document.createElement("tr");
	newRow.className = "new";

	//code section
	var c1 = document.createElement("td");
    c1.appendChild(document.createTextNode(code));
    newRow.appendChild(c1);

	//name section
    var c2 = document.createElement("td");
    c2.appendChild(document.createTextNode(courseName));
    newRow.appendChild(c2);

	//add to the table body
	tBody.appendChild(newRow);


}
