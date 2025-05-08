<?php
    //reverse of nunber up
    //currently allowed to go negative could add an if to stop that if it need to

    session_start(); // start the session
    $num = $_SESSION["number"]; // copy the value to a variable
    $num--; // decrement the value
    $_SESSION["number"] = $num; // update the session variable
    header("location:number.php"); // redirect to number.php

?>