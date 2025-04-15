<!DOCTYPE html>
<html>
    <head>
        <title>days array</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
        <?php

            #use implode rather then looping each time

            $days = array("Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saterday", "Sunday");
            echo "<p>The Days of the week in English are: </p>";
            foreach($days as $x){ 
                echo "$x, ";
            }

            echo "<p>The days of the week in French are: </p>";
            $days = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
            foreach($days as $x){ 
                echo "$x, ";
            }



            
        ?>
        
    </body>
</html>