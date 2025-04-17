<html>
<head>
<title>MySQL Databases with PHP</title>
</head>

<body>

<?php
	//please change the value of the user and db vars to your AUT id (starts with a letter) and assign the pass var with your AUT password
	$sql_host="localhost";
	$sql_user="mtr9138";
	$sql_pass="ufcuvkeinnzrfsmyxbghfcourqekrzymx";
	$sql_db="mtr9138";
	
	// mysqli_connect returns false if connection failed, otherwise a connection value
	$conn = mysqli_connect($sql_host,
		$sql_user,
		$sql_pass,
		$sql_db
	);
  
	// Checks if connection is successful
	if (!$conn) {
		// Displays an error message
		echo "<p>Database connection failure</p>";
	} else {
		echo "<p>Database connection sucessful</p>";
	}
?>
</body>
</html>


