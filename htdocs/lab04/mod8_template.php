<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
<title>MySQL Databases with and PHP</title>
</head>

<body>
<?php
	// sql info or use include 'file.inc'
	$sql_host="cmslamp14.aut.ac.nz";
	$sql_user="s1234567";
	$sql_pass="password":
	$sql_db="s1234567_db";
	$sql_tble="cars";
	
	// The @ operator suppresses the display of any error messages
	// mysqli_connect returns false if connection failed, otherwise a connection value
	$conn = @mysqli_connect($sql_host,
		$sql_user,
		$sql_pass,
		$sql_db
	);
  
	// Checks if connection is successful
	if (!$conn) {
		// Displays an error message, avoid using die() or exit() as this terminates the execution
		// of the PHP script
		echo "<p>Database connection failure</p>";
	} else {
		// Upon successful connection
		
		// Get data from the form if needed

		
		// validate form entry if needed
		
		
		if (_________________________) // invalid input data
		
		
		} else {
			// Set up the SQL command to add the data into the table
			$query = "__________________$sql_tble";
			
			
			// executes the query
			$result = mysqli_query($conn, $query);
			
			// checks if the execution was successful
			if (!$result) {
				echo "<p>Something is wrong with ",	$query, "</p>";
			} else {
				// display data or message upon successful operation.
				
				
				
				
				
				
			} // if successful query operation
		} // if valid data
		
		// close the database connection
		mysqli_close($conn);
	} // if successful database connection
?>
</body>
</html>




