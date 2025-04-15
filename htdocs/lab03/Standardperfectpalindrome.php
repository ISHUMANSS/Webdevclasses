<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Perfect Palindrome Checker</title>
</head>
<body>
    <h1>Palindrome Checker that gets rid of punctuation</h1>

    <?php
        if (isset($_POST["string"])) {
            $input = $_POST["string"];
            //check to see if it matchs a pattern

            //use preg_replace()
            $pattern = "/[^A-Za-z0-9]/";
            $cleanedInput = preg_replace("/[^A-Za-z0-9]/", "", $input);



            //convert to lowercase for case-insensitive comparison
            $lowercaseInput = strtolower($cleanedInput);

            //reverse the string
            $reversed = strrev($lowercaseInput);

            //check if a palindrome
            if (strcmp($lowercaseInput, $reversed) == 0) {
                echo "<p>'$input' is a palindrome when punctuation is removed '$lowercaseInput'</p>";
            } else {
                echo "<p>'$input' is NOT a palindrome even when punctuation is removed '$lowercaseInput'</p>";
            }
        } else {
            echo "<p>please enter a string in the form</p>";
        }
    ?>

    <p><a href="Standardperfectpalindromeform.html">check another</a></p>
</body>
</html>
