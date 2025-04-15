<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
<title>MySQL Databases with PHP</title>
</head>

<body>
	<h1>Display Search Data</h1>
<?php
	// sql info or use include 'file.inc'
       require_once('../../files/sqlinfo.inc.php');

	// The @ operator suppresses the display of any error messages
	// mysqli_connect returns false if connection failed, otherwise a connection value
	$conn = @mysqli_connect($sql_host,
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
		$make=$_POST["make"];
	
		// Set up the SQL command to retrieve the data from the table
		// % symbol represent a wildcard to match any characters
		// like is a compairson operator
		$query = "select * from $sql_tble where make like '$make%'";
		
		// executes the query and store result into the result pointer
		$result = mysqli_query($conn, $query);
		// checks if the execuion was successful
		if(!$result) {
			echo "<p>Something is wrong with ",	$query, "</p>";
		} else {
			// Display the retrieved records
			echo "<table border=\"1\">";
			echo "<tr>\n"
				 ."<th scope=\"col\">ID</th>\n"
			     ."<th scope=\"col\">Make</th>\n"
				 ."<th scope=\"col\">Model</th>\n"
				 ."<th scope=\"col\">Price</th>\n"
				 ."</tr>\n";
			// retrieve current record pointed by the result pointer
			// Note the = is used to assign the record value to variable $row, this is not an error
			// the ($row = mysqli_fetch_assoc($result)) operation results to false if no record was retrieved
			// _assoc is used instead of _row, so field name can be used
			while ($row = mysqli_fetch_assoc($result)){
				echo "<tr>";
				echo "<td>",$row["ID"],"</td>";
				echo "<td>",$row["Make"],"</td>";
				echo "<td>",$row["Model"],"</td>";
				echo "<td>",$row["Price"],"</td>";
				echo "</tr>";
			}
			echo "</table>";
			// Frees up the memory, after using the result pointer
			mysqli_free_result($result);
		} // if successful query operation
		
		// close the database connection
		mysqli_close($conn);
	} // if successful database connection
?>
</body>
</html>




