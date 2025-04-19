<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Using file functions</title>
    </head>
    <body>
        <h1>Web Development - Lab05</h1>

        <a href="vip_member.php">Home</a>
        <a href="cars_display.php">cars display</a>
        <a href="member_add_form.php">Add New Member</a>
        <a href="member_display.php"> Display All Members</a>
        <a href="member_search.php"> Search Member</a>
        <?php
        require_once ("../../files/settings.php"); //please make sure the path is correct
        // complete your answer here


        $sql_table="cars"; //set the table we want to get the info from

//conntect to the database
        $conn = mysqli_connect(
            $host,
            $user,
            $pswd,
            $dbnm
	    );

        if (!$conn) {
            // Displays an error message
            echo "<p>Database connection failure</p>";
        } else{ 
            $query = "select * from $sql_table";
                
            // executes the query and store result into the result pointer
            $result = mysqli_query($conn, $query);
            
            // checks if the execuion was successful
            if(!$result) {
                echo "<p>Something is wrong with ",	$query, "</p>";
            } else {
                // Display the retrieved records
                echo "<table border=\"1\">";
                echo "<tr>\n"
                     ."<th scope=\"col\">ID</th>\n"
                     ."<th scope=\"col\">Make</th>\n"
                     ."<th scope=\"col\">Model</th>\n"
                     ."<th scope=\"col\">Price</th>\n"
                     ."</tr>\n";
                // retrieve current record pointed by the result pointer
                // Note the = is used to assign the record value to variable $row, this is not an error
                // the ($row = mysqli_fetch_assoc($result)) operation results to false if no record was retrieved
                // _assoc is used instead of _row, so field name can be used
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
    
    //NED TO MAKE SURE THE ROWS HERE MATCH
    
                    echo "<td>",$row["id"],"</td>";
                    echo "<td>",$row["make"],"</td>";
                    echo "<td>",$row["model"],"</td>";
                    echo "<td>",$row["price"],"</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Frees up the memory, after using the result pointer
                mysqli_free_result($result);
            } // if successful query operation
            
            // close the database connection
            mysqli_close($conn);
        } // if successful database connection




        ?>



    </body>
</html>