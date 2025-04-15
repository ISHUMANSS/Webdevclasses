<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Using string functions</title>
    </head>
    <body>
        <h1>Web Development - lab 3</h1>
        <?php
            if (isset ($_POST["String"])){ #check if form data exists
                $str = $_POST["String"]; # get data from the form
                $pattern = "/^[A-Za-z ]+$/"; #set pattern

                if(preg_match($pattern,$str)){ #check to if str matches with regular expression
                    $ans = "";
                    $len = strlen($str);#get lenght of the string

                    for($i = 0; $i < $len; $i++){ #check all the characters in str
                        $letter = substr($str, $i, 1);#extract 1 char using substr
                        //checj using strops, is numeric is used as strops returns a number
                        //(position) if found and false if not
                        if(! is_numeric (strpos("AEIOUaeiou",($letter)))){
                            $ans = $ans . $letter; //add the letter to the answer
                        }
                        
                    }
                    echo "<p>The word with no vowels is ", $ans, ".</p>";

                }   
                else{
                    echo "<p>Please enter a string containing only letters or space.</p>";
                } 
            }
            else{
                echo "<p>Please enter string from the input form.</p>";
            }
        ?>

    <p><a href="strform.html">check another</a></p>
    </body>

</html>