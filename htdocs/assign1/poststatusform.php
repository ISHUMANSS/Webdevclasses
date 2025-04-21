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

            <div class="form_container">
                <form action="poststatusprocess.php" method="post">
                   <div class="form_item">
                        <label for="stcode">Status Code:</label>
                        <input type="text" id="stcode" name="stcode"  required placeholder="e.g. S0001" oninput="this.value = this.value.toUpperCase()">
                        <small>Must start with S followed by 4 digits</small>
                   </div>
                   <div class="form_item">
                        <label for="st">Status:</label>
                        <input type="text" id="st" name="st" required placeholder="e.g. Doing my first assignment">
                        <small>Only alphanumericals, comma, period, exclamation and question marks allowed</small>
                   </div>
                   <div class="form_item">
                        <label>Share:</label>
                        <label>
                            <input type="radio" name="share" value="University" checked> University
                        </label>
                        <label>
                            <input type="radio" name="share" value="Class"> Class
                        </label>
                        <label>
                            <input type="radio" name="share" value="Private"> Private
                        </label>
                    
                   </div>
                   <div class="form_item">
                        <label for="date">Date:</label>
                        <?php
                            //get the date
                            $current_date = date("d/m/Y");
                            echo "<input type=\"text\" id=\"date\" name=\"date\" value=\"$current_date\" required>";
                        ?>
                        <small>Format: dd/mm/yyyy</small>
                   </div>
                   <div class="form_item">
                        <label>Permission:</label>
                        <label>
                            <input type="checkbox" name="perm[]" value="Allow Like"> Allow Like
                        </label>
                        <label>
                            <input type="checkbox" name="perm[]" value="Allow Comments"> Allow Comments
                        </label>
                        <label>
                            <input type="checkbox" name="perm[]" value="Allow Share"> Allow Share
                        </label>
                   </div>
                   <div class="form_item">
                        <input type="submit" value="Submit" class="btn">
                   </div>
                </form>
            </div>

            <a href="index.html" >Return to Home Page</a>

        </div>

        </div>
    </body>

    <footer>
        <p>Alister Faid 22171016</p>
    </footer>
</html>