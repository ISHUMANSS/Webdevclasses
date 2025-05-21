// JavaScript Document

//FOR SOME DUMB RESION IDKWHY IT ISN'T WORKING IN THiS VERSION AND ONLY WORKS IN THE HTML DOCUMENT



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

	//add button the the row
	var selectBtn1 = document.createElement("button");
	selectBtn1.textContent = "Select";
	selectBtn1.onclick = function () {
		selectRow(newRow);
	};
	var c3 = document.createElement("td");
	c3.appendChild(selectBtn1);
	newRow.appendChild(c3);

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

	//add button to the row
	var selectBtn2 = document.createElement("button");
	selectBtn2.textContent = "Select";
	selectBtn2.onclick = function () {
		selectRow(newRow);
	};
	c3 = document.createElement("td");
	c3.appendChild(selectBtn2);
	newRow.appendChild(c3);

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

	newRow.onclick = function() { selectRow(this); };//add the select row function

	//code section
	var c1 = document.createElement("td");
    c1.appendChild(document.createTextNode(code));
    newRow.appendChild(c1);

	//name section
    var c2 = document.createElement("td");
    c2.appendChild(document.createTextNode(courseName));
    newRow.appendChild(c2);

	//add button to the row
	var selectBtn = document.createElement("button");
	selectBtn.textContent = "Select";
	selectBtn.onclick = function () {
		selectRow(newRow);
	};
	var c3 = document.createElement("td");
	c3.appendChild(selectBtn);
	newRow.appendChild(c3);

	//add to the table body
	tBody.appendChild(newRow);


}

function selectRow(row) {
    //get all table rows
    var allRows = document.getElementsByTagName("tr");
    
    //if row is already highlighted do nothing
    if (row.classList.contains("highlighted")) {
        return;
    }
    
    //remove highlight from all rows
    for (var i = 0; i < allRows.length; i++) {
        allRows[i].classList.remove("highlighted");
    }
    
    //add highlight to the clicked row
    row.classList.add("highlighted");
}


function removeRow() {
    //find the highlighted row
    var highlightedRow = document.querySelector("tr.highlighted");
    
    //if a row is highlighted remove it
    if (highlightedRow) {
        highlightedRow.parentNode.removeChild(highlightedRow);
    } else {
        alert("Please select a row to remove first.");
    }
}