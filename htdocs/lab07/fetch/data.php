<!--file data.php -->


<?php
	/*
	//old php code for if i need to show the TA that I did task 2


	// get name and password passed from client
	$name = $_POST['name'];
	$pwd = $_POST['pwd'];
	$email = $_POST['email'];
	// sleep for 10 seconds to slow server response down
	// sleep(10);
	// write back the password concatenated to end of the name
	ECHO ($name." : ".$pwd." : ".$email)

	*/
?>


<?php
	//create the database

	require_once ("../../../files/settings.php"); 
    $conn = mysqli_connect(
        $host,
        $user,
        $pswd,
        $dbnm
    );
	
	if (!$conn) {
        //displays an error message
        echo "<p>Database connection failure</p>";
    } 
    else{
		//check db exists / create db
		$sql = "CREATE TABLE IF NOT EXISTS `lab7` (
			`name` varchar(50) NOT NULL,
			`password` varchar(50) NOT NULL,
			`email` varchar(50) NOT NULL,
			PRIMARY KEY (`name`)
		)";
		$result = $conn ->query($sql);

		if (!$result) {
			echo "<p>Error creating table: " . mysqli_error($conn) . "</p>";
			exit;
		}

		//add some fake data
		//RUN THIS CODE ONECE
/*
		$conn->query("INSERT IGNORE INTO lab7 (name, password, email) VALUES 
			('alice', 'pass123', 'alice@example.com'),
			('bob', 'secure456', 'bob@example.com'),
			('charlie', 'hello789', 'charlie@example.com')"
		);
*/


		//get name and password passed from client
		//or set them to blank
		$name = isset($_POST['name']) ? $_POST['name'] : '';
		$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
		$email = isset($_POST['email']) ? $_POST['email'] : '';


		//check if everything checks out
		$sql = "SELECT password, email FROM lab7 WHERE name = '$name'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) == 0) {
			//name not in db
			echo "Error: User '$name' not found.";
		} else {
			$row = mysqli_fetch_assoc($result);
			if ($row['password'] !== $pwd) {
				//wrong password
				echo "Error: Incorrect password for '$name'.";
			} elseif ($row['email'] !== $email)  {
				//email was incorrect
				echo "Incorrect Email for $name: " . htmlspecialchars($row['email']) . " is the correct email";
			}
			else{
				echo "Good job everything was correct now if it was a thing you could do you could login to the account: " . $name;
			}
		}



		// sleep for 10 seconds to slow server response down
		// sleep(10);
		// write back the password concatenated to end of the name
		//ECHO ("<br>What you entered: ".$name." : ".$pwd." : ".$email."</br>");

	}

?>
