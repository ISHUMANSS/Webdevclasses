<?php
    //code to drop the tables
    require_once ("../../files/settings.php"); 
    $conn = mysqli_connect(
        $host,
        $user,
        $pswd,
        $dbnm
    );

    //check the connectiion
    if (!$conn) {
        //displays an error message
        echo "<p>Database connection failure</p>";
    } 
    else{
        //check to see if the table exists
        $exists = $conn->query("SHOW TABLES LIKE 'statuses'");
        if($exists->num_rows == 0){
            //table doesn't exist
            echo "<p>statuses table currenlty doesn't exist</p>";
            echo "<a href='index.html'>Return to Home Page</a>";
            exit();
        }
        else{
            //drop the table
            $conn->query("DROP TABLE statuses");
            echo "<p>Table statuses dropped</p>";
            echo "<a href='index.html'>Return to Home Page</a>";
        }
        $conn->close();
    }



?>