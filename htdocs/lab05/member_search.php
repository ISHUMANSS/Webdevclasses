<!DOCTYPE html>
<head>
    <title>search for vips</title>
</head>
<body>
    <h1>Web Development - Lab05 search VIPs</h1>
    <a href="vip_member.php">Home</a>
    <a href="cars_display.php">cars display</a>
    <a href="member_add_form.php">Add New Member</a>
    <a href="member_display.php"> Display All Members</a>
    <a href="member_search.php"> Search Member</a>

    <!--form for searching by last name-->
    <form method="post" action="member_search.php">
        <p>	<label for ="make">Enter last name: </label>
            <input type="text" name="lname" id="lname" /></p>
        <p>	<input type="submit" value="Search" /></p>
	</form>

    <?php
        require_once ("../../files/settings.php"); //please make sure the path is correct
        // complete your answer here


        $sql_table = "vipmember";

        $conn = mysqli_connect(
            $host,
            $user,
            $pswd,
            $dbnm
	    );

        if (!$conn) {
            // Displays an error message
            echo "<p>Database connection failure</p>";
        } 
        else{
            //check if the post section of the form was used and the lname isn't empty
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["lname"])) {
                $fm_lname = trim($_POST["lname"]);
    

                //last name is empty
                if ($fm_lname === "") {
                    echo "<p>please enter a last name to search</p>";
                } else {
                    //everything works so run the query
                    $query = "select * from $sql_table where lname like '$fm_lname%'";
                    //will return any results that match with the inserted last name or matchs the start of it

                    $result = mysqli_query($conn, $query);


                    if(!$result) {
                        echo "<p>Something is wrong with ",	$query, "</p>";
                    } else {
                        // Display the retrieved records
                        echo "<table border=\"1\">";
                        echo "<tr>\n"
                            ."<th scope=\"col\">ID</th>\n"
                            ."<th scope=\"col\">First name</th>\n"
                            ."<th scope=\"col\">Last name</th>\n"
                            ."<th scope=\"col\">Email</th>"
                            ."</tr>\n";

                        while ($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                                echo "<td>",$row["member_id"],"</td>";
                                echo "<td>",$row["fname"],"</td>";
                                echo "<td>",$row["lname"],"</td>";
                                echo "<td>",$row["email"],"</td>";
                            echo "</tr>";
                        }
                    echo "</table>";
                    // Frees up the memory, after using the result pointer
                    mysqli_free_result($result);
                } 
            }
        }
            else{
                echo "<p>Please enter a last name to search.</p>";
            }
            
           
            

        }

        mysqli_close($conn);

    ?>


</body>