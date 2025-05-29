<?php
    //Alister Faid 22171016

    //server side of the admin

    //require the db login details
    require_once ("../../files/settings.php");

    //contect to the database
    $conn = mysqli_connect(
        $host,
        $user,
        $pswd,
        $dbnm
    );
    if (!$conn) {
        //if connection fails kill it
        die("Connection failed: " . mysqli_connect_error());
    } 
    else{

        //check the table exists
        $exists = $conn->query("SHOW TABLES LIKE 'bookings'");
        if ($exists->num_rows == 0) {
            echo "Table does not exist try adding a booking";
            return;
        }

        //assigning request handler
        //run this instead of the search for if the post request is to assign a booking
        if (isset($_POST['assign'])) {
            //get the booking to assign
            $ref = $_POST['assign'];

            //get ready to send the update
            $stmt = $conn->prepare("UPDATE bookings SET bookingstatus='assigned' WHERE bookingref=?");

            //add all the data to the update
            $stmt->bind_param("s", $ref);

            //run the statement
            if ($stmt->execute()) {
                echo "Congratulations! Booking request $ref has been assigned!";
            } else {
                echo "Failed to assign booking.";
            }

            //all assignment is done close statement and connection
            $stmt->close();
            $conn->close();
            exit;
        }


        //search handler
        $search = $_POST['bsearch'] ?? '';//get the search info

        if ($search !== '') {
            //search for a specific listing
            $stmt = $conn->prepare("SELECT * FROM bookings WHERE bookingref=?");
            $stmt->bind_param("s", $search);
        } else {
            //search for an empty listing
            $now = date("Y-m-d H:i:s");
            //find what time it will be in two hours
            $twoHoursLater = date("Y-m-d H:i:s", strtotime("+2 hours"));

            //find all the unassigned bookings in the next 2 hours
            $stmt = $conn->prepare("
                SELECT * FROM bookings
                WHERE bookingstatus = 'unassigned'
                AND STR_TO_DATE(CONCAT(date, ' ', time), '%Y-%m-%d %H:%i:%s') BETWEEN ? AND ?
            ");

            $stmt->bind_param("ss", $now, $twoHoursLater);
        }

        //run the statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo "No bookings found or no unassigned in the next 2 hours";
        } else {
            echo "<table class='table table-bordered'><thead><tr>
                    <th>Booking Ref</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Pickup Suburb</th>
                    <th>Destination Suburb</th>
                    <th>Pickup Date & Time</th>
                    <th class='status'>Status</th>
                    <th>Assign</th>
                </tr></thead><tbody>";

            //go through all the data and add it to the table
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['bookingref']}</td>
                        <td>{$row['cname']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['sbname']}</td>
                        <td>{$row['dsbname']}</td>
                        <td>{$row['date']} {$row['time']}</td>
                        <td class='status'>{$row['bookingstatus']}</td>
                        <td><button class='btn btn-success assign-btn' data-ref='{$row['bookingref']}' " . 
                            ($row['bookingstatus'] === 'assigned' ? 'disabled' : '') . ">Assign</button></td>
                    </tr>";
            }

            echo "</tbody></table>";
        }


        $stmt->close();
        $conn->close();

    }

?>