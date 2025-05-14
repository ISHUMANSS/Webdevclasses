<!--file data.php -->
<?php

	//create the database

	require_once ("../../files/settings.php"); 
    $conn = mysqli_connect(
        $host,
        $user,
        $pswd,
        $dbnm
    );
	f (!$conn) {
        //displays an error message
        echo "<p>Database connection failure</p>";
    } 
    else{
		// get name and password passed from client
		$name = $_GET['name'];
		$pwd = $_GET['pwd'];


		//check db exists / create db
		$sql = "CREATE TABLE IF NOT EXISTS `statuses` (
			`name` varchar(50) NOT NULL,
			`password` varchar(50) NOT NULL,
			`email` varchar(50)NOT NULL,
			PRIMARY KEY (`name`)
		)";
		$conn ->query($sql);


		//check if password is ok for the name
		



		// sleep for 10 seconds to slow server response down
		// sleep(10);
		// write back the password concatenated to end of the name
		ECHO ($name." : ".$pwd)

	}

?>
