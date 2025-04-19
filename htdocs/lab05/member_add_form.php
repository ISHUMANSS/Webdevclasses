<!DOCTYPE html>
<head>
    <title>member addfrom</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
    <a href="vip_member.php">Home</a>
    <a href="cars_display.php">cars display</a>
    <a href="member_add_form.php">Add New Member</a>
    <a href="member_display.php"> Display All Members</a>
    <a href="member_search.php"> Search Member</a>

    <h1>Add New Member</h1>

    <!-- <?php
     //success variable is set to success, display a success message
        if (isset($_GET['success'])) {
            echo "<h5 style='color:rgb(221, 86, 113);'>Member added</h5>";
        }   
    ?>
    -->


    <form method="post" action="member_add.php">
        <p>First Name<input type="text" name="fname" id="fname" required></p>
        <p>Last Name<input type="text" name="lname" id="lname" required></p>

        <p><label for="gender">Gender:</label>
                <input type="radio" name="gender" value="f" checked> Female
                <input type="radio" name="gender" value="m"> Male
        
        <p>Email<input type="text" name="email" id="email" required></p>
        <p>Phone<input type="text" name="phone" id="phone" required></p>

        <p><input type="submit" value="Submit" /></p>

    </form>


</body>