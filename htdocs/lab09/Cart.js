var xHRObject = false;
if (window.XMLHttpRequest) {
    xHRObject = new XMLHttpRequest();
} else if (window.ActiveXObject) {
    xHRObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function getData() {
    if ((xHRObject.readyState == 4) && (xHRObject.status == 200)) {
        var serverResponse = xHRObject.responseXML;
        var spantag = document.getElementById("cart");
        
        //clear cart display
        spantag.innerHTML = "";
        
        if (serverResponse != null) {
            var books = serverResponse.getElementsByTagName("book");
            
            //create table for the cart
            var cartTable = document.createElement("table");
            cartTable.setAttribute("border", "1");
            cartTable.style.borderCollapse = "collapse";
            
            //table header
            var headerRow = document.createElement("tr");
            var headers = ["Title", "ISBN", "Price", "Quantity", "Subtotal", "Action"];
            
            headers.forEach(function(headerText) {
                var th = document.createElement("th");
                th.textContent = headerText;
                th.style.padding = "5px";
                headerRow.appendChild(th);
            });
            
            cartTable.appendChild(headerRow);
            
            //add each book to the table
            for (var i = 0; i < books.length; i++) {
                var book = books[i];
                var row = document.createElement("tr");
                
                //get book details
                var title, isbn, price, quantity;
                
                if (window.ActiveXObject) {
                    title = book.getElementsByTagName("title")[0].text;
                    isbn = book.getElementsByTagName("isbn")[0].text;
                    price = book.getElementsByTagName("price")[0].text;
                    quantity = book.getElementsByTagName("quantity")[0].text;
                } else {
                    title = book.getElementsByTagName("title")[0].textContent;
                    isbn = book.getElementsByTagName("isbn")[0].textContent;
                    price = book.getElementsByTagName("price")[0].textContent;
                    quantity = book.getElementsByTagName("quantity")[0].textContent;
                }
                
                //calculate subtotal
                var subtotal = parseFloat(price) * parseInt(quantity);
                
                //create cells
                var cells = [title, isbn, "$" + price, quantity, "$" + subtotal.toFixed(2)];
                
                cells.forEach(function(cellText) {
                    var td = document.createElement("td");
                    td.textContent = cellText;
                    td.style.padding = "5px";
                    row.appendChild(td);
                });
                
                //add remove button
                var actionCell = document.createElement("td");
                var removeLink = document.createElement("a");
                removeLink.href = "#";
                removeLink.textContent = "Remove";
                removeLink.style.padding = "5px";
                removeLink.onclick = function() {
                    AddRemoveItem("Remove", title, isbn, price);
                    return false;
                };
                actionCell.appendChild(removeLink);
                row.appendChild(actionCell);
                
                cartTable.appendChild(row);
            }
            
            //add total cost row
            var totalCost;
            if (window.ActiveXObject) {
                totalCost = serverResponse.getElementsByTagName("totalcost")[0].text;
            } else {
                totalCost = serverResponse.getElementsByTagName("totalcost")[0].textContent;
            }
            
            var totalRow = document.createElement("tr");
            var totalLabelCell = document.createElement("td");
            totalLabelCell.setAttribute("colspan", "4");
            totalLabelCell.textContent = "Total Cost:";
            totalLabelCell.style.textAlign = "right";
            totalLabelCell.style.fontWeight = "bold";
            totalRow.appendChild(totalLabelCell);
            
            var totalValueCell = document.createElement("td");
            totalValueCell.setAttribute("colspan", "2");
            totalValueCell.textContent = "$" + totalCost;
            totalValueCell.style.fontWeight = "bold";
            totalRow.appendChild(totalValueCell);
            
            cartTable.appendChild(totalRow);
            
            //add the table to the cart span
            spantag.appendChild(cartTable);
        }
    }
}

function AddRemoveItem(action, bookTitle, bookISBN, bookPrice) {
    //if parameters not provided get them from the current book display
    if (!bookTitle) {
        bookTitle = document.getElementById("book").innerText;
    }
    if (!bookISBN) {
        bookISBN = document.getElementById("ISBN").innerText;
    }
    if (!bookPrice) {
        bookPrice = document.getElementById("price").innerText.replace('$', '');
    }
    
    var url = "ManageCart.php?action=" + action + 
              "&book=" + encodeURIComponent(bookTitle) + 
              "&isbn=" + encodeURIComponent(bookISBN) + 
              "&price=" + encodeURIComponent(bookPrice) + 
              "&value=" + Number(new Date);
    
    xHRObject.open("GET", url, true);
    xHRObject.onreadystatechange = getData;
    xHRObject.send(null);   
}

//load multiple books when page loads
function loadCatalog() {
    var xhrCatalog = new XMLHttpRequest();
    xhrCatalog.open("GET", "json/catalog.json", true);
    xhrCatalog.onreadystatechange = function() {
        if (xhrCatalog.readyState == 4 && xhrCatalog.status == 200) {
            var catalog = JSON.parse(xhrCatalog.responseText);
            displayCatalog(catalog);
        }
    };
    xhrCatalog.send(null);
}

function displayCatalog(catalog) {
    var catalogDiv = document.getElementById("catalog");
    catalogDiv.innerHTML = "";
    
    catalog.books.forEach(function(book) {
        var bookDiv = document.createElement("div");
        bookDiv.className = "book-item";
        bookDiv.style.border = "1px solid #ccc";
        bookDiv.style.padding = "10px";
        bookDiv.style.margin = "10px 0";
        
        //book cover
        var coverImg = document.createElement("img");
        coverImg.src = book.coverImage || "default_cover.jpg";
        coverImg.style.width = "100px";
        coverImg.style.display = "block";
        coverImg.style.marginBottom = "10px";
        bookDiv.appendChild(coverImg);
        
        //book details
        var detailsDiv = document.createElement("div");
        
        //title
        var titleSpan = document.createElement("div");
        titleSpan.innerHTML = "<b>Book:</b> <span class='book-title'>" + book.title + "</span>";
        detailsDiv.appendChild(titleSpan);
        
        //authors
        var authorsSpan = document.createElement("div");
        authorsSpan.innerHTML = "<b>Authors:</b> <span class='book-authors'>" + book.authors + "</span>";
        detailsDiv.appendChild(authorsSpan);
        
        //ISBN
        var isbnSpan = document.createElement("div");
        isbnSpan.innerHTML = "<b>ISBN:</b> <span class='book-isbn'>" + book.isbn + "</span>";
        detailsDiv.appendChild(isbnSpan);
        
        //price
        var priceSpan = document.createElement("div");
        priceSpan.innerHTML = "<b>Price:</b> <span class='book-price'>$" + book.price + "</span>";
        detailsDiv.appendChild(priceSpan);
        
        bookDiv.appendChild(detailsDiv);
        
        //add to cart button
        var addButton = document.createElement("a");
        addButton.href = "#";
        addButton.textContent = "Add to Shopping Cart";
        addButton.style.display = "inline-block";
        addButton.style.marginTop = "10px";
        addButton.onclick = function() {
            AddRemoveItem("Add", book.title, book.isbn, book.price);
            return false;
        };
        bookDiv.appendChild(addButton);
        
        catalogDiv.appendChild(bookDiv);
    });
}