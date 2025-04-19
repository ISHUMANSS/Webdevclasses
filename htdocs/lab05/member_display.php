<!DOCTYPE HTML>
<head>
    <title>list of VIPs</title>
</head>
<body>
    <h1>Web Development - Lab05 display VIPs</h1>
    <a href="vip_member.php">Home</a>
    <a href="cars_display.php">cars display</a>
    <a href="member_add_form.php">Add New Member</a>
    <a href="member_display.php"> Display All Members</a>
    <a href="member_search.php"> Search Member</a>

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
        } else{
            $query = "select * from $sql_table"; //get all members
            $result = mysqli_query($conn, $query);

            echo "<table border=\"1\">";
                echo "<tr>\n"
                     ."<th scope=\"col\">ID</th>\n"
                     ."<th scope=\"col\">First name</th>\n"
                     ."<th scope=\"col\">Last name</th>\n"
                     ."</tr>\n";

                while ($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";

                    echo "<td>",$row["member_id"],"</td>";
                    echo "<td>",$row["fname"],"</td>";
                    echo "<td>",$row["lname"],"</td>";
                    echo "</tr>";
                }
            echo "</table>";

            mysqli_free_result($result);
        }
    mysqli_close($conn);


    ?>   
    



</body>