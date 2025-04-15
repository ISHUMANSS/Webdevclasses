<!DOCTYPE html>
<html>
    <head>
        <title>PHP functions</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
        <h1>Use of PHP built in functions</h1>
        <?php
            /*use of abs() and pow() built in fucnrions and echo*/
            echo "<p>ABS value of -9 is: ", abs(-9),".</p>";
            echo "<p>2 to the power of 5 is : ", pow(2,5),".</p>";
        ?>
        <?php
            /*use of decbin and bin dec*/
            echo "<p> decimal equivalent of 1101 is: ", bindec(1101),".</p>";
            echo "<p>Binary equivalent of 14 is: ", decbin(14), "</p>";

        ?>
    </body>
</html>