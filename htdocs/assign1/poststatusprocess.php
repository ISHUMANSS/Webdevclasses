<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="COMP721 Assignment 1">
        <meta name="keywords" content="Web Development, Assignment 1">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Post Status</title>
    </head>
    <body>
        <div class="content">
            <div class="container-fluid">

                <div class="nav_bar">
                    <a href="index.html" class="btn">Home</a>
                    <a href="poststatusform.php" class="btn">Post a new status</a>
                    <a href="searchstatusform.html" class="btn">Search status</a>
                    <a href="about.html" class="btn">About the assignment</a>
                </div>

                <h1 class="page_title">Status Posting System</h1>


                <?php
                    //used as the logic for posting the status
                    require_once ("../../files/settings.php"); 

                    //conntect to the database
                    $conn = mysqli_connect(
                        $host,
                        $user,
                        $pswd,
                        $dbnm
                    );

                    //check the connectiion
                    if (!$conn) {
                        //displays an error message
                        echo "<p>Database connection failure</p>";
                    } 
                    else{

                        //get the data from the from
                        $fm_stcode = $_POST["stcode"];
                        $fm_status = $_POST["st"];
                        $fm_share = $_POST["share"];

                        //check if perm is enpty -> set to null
                        //else combine all the selected perms
                        $fm_perm = empty($_POST['perm']) ? null : implode(',', $_POST['perm']); 

                        $fm_date = $_POST["date"];


                        //check table exists
                        //not exist then create the table
                        $sql = "CREATE TABLE IF NOT EXISTS `statuses` (
                            `status_code` varchar(5) NOT NULL,
                            `status` varchar(500) NOT NULL,
                            `share` enum('University','Class','Private') NOT NULL,
                            `perm` varchar(40) ,
                            `date` date NOT NULL,
                            PRIMARY KEY (`status_code`)
                        )";
                        $conn ->query($sql);


                        //validate all the inputs

                        //check status code matches the pattern
                        if((!preg_match('/^S\d{4}$/', $fm_stcode))){
                            //return to post status with a fomat error
                            echo "<p >Wrong format! with '$fm_stcode' the status code must start with an “S” followed by four digits, like “S0001“.</p>";
                            echo "<a href='poststatusform.php'>Try Again</a> | <a href='index.html'>Return to Home Page</a>";
                            exit();
                        }

                        //check status code hasn't been used before
                        $check_code =  "SELECT COUNT(*) FROM statuses WHERE status_code = '$fm_stcode'";
                        $result = $conn->query($check_code);
                        $row = $result->fetch_row();
                        $count = $row[0];

                        if($count > 0){
                            //count will be zero if status code has never been used
                            echo "<p >The status code '$fm_stcode' already exists. Please try another one!.</p>";
                            echo "<a href='poststatusform.php'>Try Again</a> | <a href='index.html'>Return to Home Page</a>";
                            exit();
                        }

                        //check status only has alphanumericals, spaces, comma, 
                        //period, exclamation point, question mark and is not blank
                        if((!preg_match('/^[a-zA-Z0-9,\.!? ]+$/', $fm_status))){
                            //return to post status with a fomat error
                            echo "<p>Your status: '$fm_status' is in a wrong format! The status can only contain alphanumericals and spaces, comma, period, exclamation point and question mark and cannot be blank!</p>";
                            echo "<a href='poststatusform.php'>Try Again</a> | <a href='index.html'>Return to Home Page</a>";
                            exit();
                        }

                        //check date is valid
                        //if date is set to blank set to the current date
                        if(!isset($_POST["date"]) || empty($_POST["date"])){
                            $fm_date = date("d/m/Y");
                        }

                        //check date is in the correct format
                        $date_parts = explode('/',$fm_date);

                        if(count($date_parts) != 3){
                            echo "<p>Date format is '$fm_date' incorrect please use dd/mm/yyyy format</p>";
                            echo "<a href='poststatusform.php'>Try Again</a> | <a href='index.html'>Return to Home Page</a>";
                            exit();
                        }

                        //seprate the parts to be able to use the checkDate function
                        //also removes any text character
                        $day = (int)$date_parts[0];
                        $month = (int)$date_parts[1];
                        $year = (int)$date_parts[2];

                        if(!checkdate($month, $day, $year)){
                            echo "<p>Date '$fm_date' is not a valid date</p>";
                            echo "<a href='poststatusform.php'>Try Again</a> | <a href='index.html'>Return to Home Page</a>";
                            exit();
                        }

                        //fix format befor insertion is allowed
                        //if it doesn't get put in this format everything breaks and won't allow for insert
                        $fm_date = "$year-$month-$day";

                        //create the status if everything is valid
                        $insert = "INSERT INTO statuses (status_code, status, share, perm, date) VALUES ('$fm_stcode', '$fm_status', '$fm_share', '$fm_perm','$fm_date')";
                        if ($conn->query($insert) === TRUE) {
                            echo "<p>Congratulations! The status has been posted!</p>";
                            echo "<a href='index.html'>Return to Home Page</a>";
                            
                        } else {
                            echo "<p>Something is wrong with the query: $insert </p>";
                            echo "<a href='poststatusform.php'>Try Again</a> | <a href='index.html'>Return to Home Page</a>";
                            exit();
                        }
                        

                    }

                    $conn->close();

                ?>

            </div>
        </div>
    </body>

    <footer>
        <p>Alister Faid 22171016</p>
    </footer>
</html>