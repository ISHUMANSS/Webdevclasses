<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="COMP721 Assignment 1">
        <meta name="keywords" content="Web Development, Assignment 1">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Results</title>
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
                <h1 class="page_title">Results</h1>

                <?php
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
                        //check the search string isn't empty
                        if (!isset($_GET['Search']) || trim($_GET['Search']) === ''){
                            echo "<p>The search string is empty. Please enter a keyword to search.</p>";
                            echo "<a href='searchstatusform.html'>Try Again</a> | <a href='index.html'>Return to Home Page</a>";
                            exit();
                        }

                        $search_string = trim($_GET['Search']);

                        //check the table exists
                        $exists = $conn->query("SHOW TABLES LIKE 'statuses'");
                        if($exists->num_rows == 0){
                            echo "<p>No status found in the system. Please go to the post status page to post one.</p>";
                            echo "<a href='poststatusform.php'>Post a status here</a> | <a href='index.html'>Return to Home Page</a>";
                            exit();
                        }


                        //search for the records
                        $sql =  "SELECT * FROM statuses WHERE status LIKE '%$search_string%'";
                        $result = $conn->query($sql);

                        if($result->num_rows > 0){
                            //somthing was found
                            //display the matching records
                            echo "<p>Search for: '$search_string'</p>";
                            echo "<div class='search'>";
                            while($row = $result->fetch_assoc()){
                                echo "<div class='search_content'>";
                                    
                                    echo "<h1>Status: " . $row["status"] . "</h1>";
                                    echo "<p>Status code: " .  $row["status_code"] ."</p>";
                                    echo "<p>Share: " .  $row["share"] ."</p>";
                                    echo "<p>Date Posted: " .  $row["date"] ."</p>";
                                    //as perm is an array it looks bad if you do nothing to it
                                    $perm_values = explode(",", $row["perm"]);
                                    echo "<p>Permision: " .  implode(", ", $perm_values) ."</p>"; //allow the spaces between the values

                                    echo "<hr>";
                                echo "</div>";
                            }
                            echo "</div>";

                        }
                        else{
                            //nothing was found
                            echo "<p>No status not found. Please try a different keyword.</p>";
                            echo "<a href='poststatusform.php'>Post a status here</a> | <a href='index.html'>Return to Home Page</a>";
                            exit();
                        }

                    }

                    $conn->close();
                ?>

                <ul>
                    <li><a href="searchstatusform.html" >Search for another status</a></li>
                    <li><a href="poststatusform.php" >Post a new status</a></li>
                    <li><a href="index.html">Return to Home Page</a></li>
                </ul>
            </div>
        </div>
        
    </body>
    <footer>
        <p>Alister Faid 22171016</p>
    </footer>
</html>