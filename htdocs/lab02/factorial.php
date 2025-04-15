<!DOCTYPE html>
<html>
    <head>
        <title>factorial</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
    <?php
        include 'mathfunctions.php';

        if (isset($_GET['number'])) {
            $num = $_GET['number'];

            if ($num >= 0) {
                echo "<h2>factorial of $num is: " . factorial($num) .  "</h2>";
            } else {
                echo "<h2>error: enter a positive integer</h2>";
            }
        } else {
            echo "<h2>enter a number</h2>";
        }
        ?>
        <a href="factorialform.html">Go Back</a>
        
    </body>
</html>