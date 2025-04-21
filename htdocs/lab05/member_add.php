<?php
//info gets sent to this from member add form

//used to check the table exists (if not create)
//then add the new member to the database

    require_once ("../../files/settings.php"); //please make sure the path is correct
        

//conntect to the database
        $conn = mysqli_connect(
            $host,
            $user,
            $pswd,
            $dbnm
	    );

        //check the connectiion
        if (!$conn) {
            // Displays an error message
            echo "<p>Database connection failure</p>";
        } else{

            //get the info from the form
            $fm_fname = $_POST["fname"];
            $fm_lname = $_POST["lname"];
            $fm_gender = $_POST["gender"];
            $fm_email = $_POST["email"];
            $fm_phone = $_POST["phone"];

            //check table exists
            //not exist then create the table
            $sql = "CREATE TABLE IF NOT EXISTS `vipmember` (
                `member_id` int(11) NOT NULL AUTO_INCREMENT,
                `fname` varchar(40) NOT NULL,
                `lname` varchar(40) NOT NULL,
                `gender` varchar(1) NOT NULL,
                `email` varchar(40) NOT NULL,
                `phone` varchar(20) NOT NULL,
                PRIMARY KEY (`member_id`)
            )";
            $conn ->query($sql);


            //insert info into the table from the form

            $query = "INSERT INTO vipmember (fname, lname, gender, email, phone)  ('$fm_fname', '$fm_lname', '$fm_gender', '$fm_email', '$fm_phone')";
            echo $query;
            // executes the query
            $result = mysqli_query($conn, $query);
            // checks if the execution was successful
            if(!$result) {
                echo "<p>Something is wrong with ",	$query, "</p>";
            } else {
                // display an operation successful message
                echo "<p>Success</p>";
                mysqli_close($conn);

                header("Location: vip_member.php"); //go back to the main page rather then staying on the add user
                exit();
            } // if successful query operation

            // close the database connection
            mysqli_close($conn);
            // if successful database connection



        }



?>