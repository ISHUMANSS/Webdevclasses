<!DOCTYPE html>
<html>
    <head>
        <title>is even</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
        <?php
            $number = 1;
            $is_even = "Not Even";

            if($number % 2 == 0){
                $is_even = "Even";
            }

            echo "<p>is $number even: $is_even</p>";
            
        ?>
        
    </body>
</html>