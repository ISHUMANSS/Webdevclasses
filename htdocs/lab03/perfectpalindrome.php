<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Perfect Palindrome Checker</title>
</head>
<body>
    <h1>Palindrome Checker</h1>

    <?php
        if (isset($_POST["string"])) {
            $input = $_POST["string"];

            //convert to lowercase for case-insensitive comparison
            $lowercaseInput = strtolower($input);

            //reverse the string
            $reversed = strrev($lowercaseInput);

            //check if a palindrome
            if (strcmp($lowercaseInput, $reversed) == 0) {
                echo "<p>'$input' is a palindrome</p>";
            } else {
                echo "<p>'$input' is NOT a palindrome</p>";
            }
        } else {
            echo "<p>please enter a string in the form</p>";
        }
    ?>

    <p><a href="perfectpalindromeform.html">check another</a></p>
</body>
</html>
