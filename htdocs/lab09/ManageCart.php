<?php 
session_start();
header('Content-Type: text/xml');
?>
<?php

        $bookTitle = $_GET["book"];
        $isbn = $_GET["isbn"];
        $price = $_GET["price"];
        $action = $_GET["action"];

        //create the cart if it doesn't exist
        if (!array_key_exists("Cart", $_SESSION)) {
            $_SESSION["Cart"] = array();
        }

        $cart1 = $_SESSION["Cart"];


        if ($action == "Add") {
            if (array_key_exists($bookTitle, $cart1)) {
                //add more of an existing book
                $cart1[$bookTitle]["quantity"] += 1;
            } else {
                //add a new book to the cart
                $cart1[$bookTitle] = array(
                    "isbn" => $isbn,
                    "price" => $price,
                    "quantity" => 1
                );
            }
        } else if ($action == "Remove") {
            if (array_key_exists($bookTitle, $cart1)) {
                //take one of the specific book out of the cart
                $cart1[$bookTitle]["quantity"] -= 1;
                
                //remove the item if there are none left
                if ($cart1[$bookTitle]["quantity"] <= 0) {
                    unset($cart1[$bookTitle]);
                }
            }
        }

        //re apply the cart to the session
        $_SESSION["Cart"] = $cart1;


        //only return XML if cart has items
        if (count($cart1) > 0) {
            echo toXml($cart1);
        }



        function toXml($cart1) {
            $doc = new DomDocument('1.0');
            $cart = $doc->createElement('cart');
            $cart = $doc->appendChild($cart);
            
            //calculate the total cost
            $totalCost = 0;
            
            //add all the books to the xml
            foreach ($cart1 as $title => $details) {
                $book = $doc->createElement('book');
                $book = $cart->appendChild($book);
                
                $titleElem = $doc->createElement('title'); 
                $titleElem = $book->appendChild($titleElem);   
                $value = $doc->createTextNode($title);
                $value = $titleElem->appendChild($value);
                
                $isbnElem = $doc->createElement('isbn');
                $isbnElem = $book->appendChild($isbnElem);
                $isbnValue = $doc->createTextNode($details["isbn"]);
                $isbnValue = $isbnElem->appendChild($isbnValue);
                
                $priceElem = $doc->createElement('price');
                $priceElem = $book->appendChild($priceElem);
                $priceValue = $doc->createTextNode($details["price"]);
                $priceValue = $priceElem->appendChild($priceValue);
                
                $quantity = $doc->createElement('quantity');
                $quantity = $book->appendChild($quantity);
                $value2 = $doc->createTextNode($details["quantity"]);
                $value2 = $quantity->appendChild($value2);
                
                //add to total cost
                $totalCost += $details["price"] * $details["quantity"];
            }
            
            //add total cost to XML
            $totalElem = $doc->createElement('totalcost');
            $totalElem = $cart->appendChild($totalElem);
            $totalValue = $doc->createTextNode(number_format($totalCost, 2));
            $totalValue = $totalElem->appendChild($totalValue);
            
            $strXml = $doc->saveXML(); 
            return $strXml;
    }
?>
