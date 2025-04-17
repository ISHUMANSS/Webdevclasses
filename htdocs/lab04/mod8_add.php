<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
<title>MySQL Databases with and PHP</title>
</head>

<body>
<?php
	// sql info or use include 'file.inc'
       require_once('../../files/sqlinfo.inc.php');
	
	// The @ operator suppresses the display of any error messages
	// mysqli_connect returns false if connection failed, otherwise a connection value
	$conn = @mysqli_connect(
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
		// Upon successful connection
		
		// Get data from the form


//NEED TO MAKE SURE THIS MATCHES WHAT YOU HAVE IN THE DB

		$id1    = $_POST["id"];
        $make	= $_POST["make"];
		$model	= $_POST["model"];
		$price	= $_POST["price"];
		

		// Set up the SQL command to add the data into the table
		$query = "insert into $sql_tble"
						."(id, make, model, price)"
					. "values"
						."('$id1','$make','$model', $price)";
echo $query;
		// executes the query
		$result = mysqli_query($conn, $query);
		// checks if the execution was successful
		if(!$result) {
			echo "<p>Something is wrong with ",	$query, "</p>";
		} else {
			// display an operation successful message
			echo "<p>Success</p>";
		} // if successful query operation

		// close the database connection
		mysqli_close($conn);
	}  // if successful database connection
?>
</body>
</html>




