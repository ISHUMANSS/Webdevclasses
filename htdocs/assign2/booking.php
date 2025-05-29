<?php
//Alister Faid 22171016

//handles the server side of the booking

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
        //connection was successful

        //get all of the user information from the post request
        $cname   = $_POST['cname'] ?? '';
        $phone   = $_POST['phone'] ?? '';
        $unumber = $_POST['unumber'] ?? '';
        $snumber = $_POST['snumber'] ?? '';
        $stname  = $_POST['stname'] ?? '';
        $sbname  = $_POST['sbname'] ?? '';
        $dsbname = $_POST['dsbname'] ?? '';
        $date    = $_POST['date'] ?? '';
        $time    = $_POST['time'] ?? '';

        //check datababase exists/create the database

        $sql = "CREATE TABLE IF NOT EXISTS `bookings` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `bookingref` VARCHAR(8) NOT NULL UNIQUE,
            `cname` VARCHAR(100) NOT NULL,
            `phone` VARCHAR(12) NOT NULL,
            `unumber` VARCHAR(10),
            `snumber` VARCHAR(10) NOT NULL,
            `stname` VARCHAR(100) NOT NULL,
            `sbname` VARCHAR(50),
            `dsbname` VARCHAR(50),
            `date` DATE NOT NULL,
            `time` TIME NOT NULL,
            `bookingdatetime` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `bookingstatus` ENUM('unassigned', 'assigned') NOT NULL DEFAULT 'unassigned'
        )";
        $conn ->query($sql);

        //prep data for insert

        //check everything that is required is there
        if (!$cname || !$phone || !$snumber || !$stname || !$date || !$time) {
            echo "Missing required booking information";
            exit;
        }

        //create booking time and date
        $bookingDateTime = date("Y-m-d H:i:s");

        //format pick up time
        $pickupDateTime = date("Y-m-d H:i:s", strtotime("$date $time"));

        //create the booking refrence
        //uses BRN00001 format
        $result = mysqli_query($conn, "SELECT MAX(id) as max_id FROM bookings");//get the highest id
        $row = mysqli_fetch_assoc($result);
        $nextId = $row['max_id'] + 1;
        $bookingRef = "BRN" . str_pad($nextId, 5, "0", STR_PAD_LEFT);

        //insert data into db
        //Prep statement to insert booking
        $stmt = $conn->prepare("INSERT INTO bookings (
            bookingref, cname, phone, unumber, snumber, stname, sbname, dsbname, date, time
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        //add all the user details to the insert
        $stmt->bind_param(
            "ssssssssss",
            $bookingRef, $cname, $phone, $unumber, $snumber, $stname, $sbname, $dsbname, $date, $time
        );

        //run the statement
        if ($stmt->execute()) {
            //format confirmation
            $pickupTimeFormatted = date("H:i", strtotime($time));
            $pickupDateFormatted = date("d/m/Y", strtotime($date));

            //give the response to the js
            echo "Thank you for your booking!<br>
                Booking reference number: $bookingRef<br>
                Pickup time: $pickupTimeFormatted<br>
                Pickup date: $pickupDateFormatted";
        } else {
            echo "failed to save booking please try again";
        }
    }

        $stmt->close();
        $conn->close();


?>