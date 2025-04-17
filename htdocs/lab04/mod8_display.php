<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
<title>MySQL Databases with PHP</title>
</head>

<body>
	<?php
	// sql info or use include 'file.inc'
       	$a = require_once('../../files/sqlinfo.inc.php');
	// echo "$a<br/>";
	
	// if (function_exists("mysqli_connect")) echo "function exists!"; else echo "function does not exist!";
	
	// The @ operator suppresses the display of any error messages
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
	} else{ 
		$query = "select * from $sql_tble";
			
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

//NED TO MAKE SURE THE ROWS HERE MATCH

				echo "<td>",$row["id"],"</td>";
				echo "<td>",$row["make"],"</td>";
				echo "<td>",$row["model"],"</td>";
				echo "<td>",$row["price"],"</td>";
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



