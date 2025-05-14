<?php
    //php for the logic of the game

    session_start();

    //gen rand number
    if(!isset($_SESSION['num'])){
        $_SESSION['num'] = rand(1,100);
        $_SESSION["guesses"] = 0;
    }

    //used to show the user what happened
    $message = '';

    if(isset($_POST['guess'])){
        $guess = $_POST['guess'];

        //check guess is a number
        if(!is_numeric($guess)){
            $message = 'you can only enter numbers';
        }
        else if($guess < 1 || $guess > 100){
            //check guess is between 1 and 100
            $message = 'number must be between 1 and 100';
        }
        else{
            //chech if its higher or lower  
            //increase the total number of guesses
            $_SESSION['guesses']++;

            if($guess < $_SESSION['num']){
                $message = 'your guess is lower then the target';
            }
            else if($guess > $_SESSION['num']){
                $message = 'your guess is higher then target';
            }
            else if ($guess == $_SESSION['num']){
                $message = 'you guessed the number good job it was: '. $_SESSION['num'] ;
            }

        }
    }

?>
<html>
    <head>
        <title>guessing game</title>
    </head>
    <body>
        <h1>Guessing Game</h1>
        <p>How to: enter a number between 1 and 100 then press the guess button</p>
        
        <form method="post">
            <label for="guess">Guess a number between 1 and 100:</label>
            <input type="text" name="guess" id="guess" value="">
            <input type="submit" value="Guess">
        </form>

        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <p>Number of Guesses: <?php echo $_SESSION['guesses']; ?></p>

        <br><a href="startover.php" >Start Over</a>
        <br><a href="giveup.php">Give Up</a>

    </body>
<html>