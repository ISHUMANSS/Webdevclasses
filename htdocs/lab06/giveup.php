<?php

    session_start();
    if (!isset ($_SESSION["num"])) {
        $_SESSION["num"] = 0;
    }

    $num = $_SESSION["num"];
?>

<html>
    <body>
        <h1>Guessing Game</h1>
        
        <p style="color:blue">The hidden number was: <?php echo $num ?></p>

        <br><a href="startover.php" >Start Over</a>
    </body>
</html>
