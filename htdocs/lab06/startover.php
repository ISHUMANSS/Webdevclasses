<?php
    //reset the session
    session_start();

    session_destroy();

    header('Location: guessinggame.php');
    exit;
?>