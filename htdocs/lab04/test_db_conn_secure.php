<html>
<head>
<title>MySQL Databases with PHP</title>
</head>

<body>

<?php
	
	require_once('../../files/sqlinfo.inc.php');
	
	
	// mysqli_connect returns false if connection failed, otherwise a connection value
	$conn = mysqli_connect(
		$sql_host,
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


