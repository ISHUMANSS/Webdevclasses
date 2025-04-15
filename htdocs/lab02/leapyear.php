<!DOCTYPE html>
<html>
    <head>
        <title>leepyear</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
    <?php
        function is_leapyear($n){
            if($year % 4 == 0 and $year % 100 != 0){
                if( $year % 400 == 0){
                    return true;
                }
            }  
            else{
                return false;
            }   
        }

        
        if (is_numeric($_GET['number']) ) {
            $year = $_GET['number'];

            if($year <= 0){
                echo "<p>$year can't have a negative year</p>";
            }
            else{
                #is a valid year so will check (this is a bad way to do this)

                /*if($year % 4 == 0){
                    if($year % 100 == 0 && $year % 400 == 0){
                        echo "<p>$year it is a leep year</p>";
                    }elseif($year % 100 != 0 ){
                        echo "<p>$year is a leep year</p>";
                    }
                                

                }  
                else{
                    echo "<p>$year not a leep year</p>";
                }    
                */  

                if(is_leapyear($year)){
                    echo "<p>$year is a leep year</p>";
                }
                else{
                    echo "<p>$year not a leep year</p>";
                }
            }
            
        } else {
            echo "<h2>enter a valid year</h2>";
        }
        ?>
        <a href="leapyearform.html">go back</a>
        
    </body>
</html>