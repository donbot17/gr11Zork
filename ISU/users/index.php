<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: login.php');
} else {

    $help = "<br>What, you forgot how to live? No problem!<br>
    Let's help:<br>
    1. To Move, simply type a direction, like 'North' or 'East.
    Or, if you feel like going a little quicker, the first letter of the direction will suite.
   <br> 2. To pick up an object, type 'Take', and the item will go into your inventory! Be wary, you can only carry 4 things at a time.
    <br>3. To use an object, type 'use'
    ";

    $legalCommands = array('north', 'south', 'west', 'east', 'n', 's', 'w', 'e', 'pick', 'key', 'map','spacesuit','medkit','toolbox','protbar','blaster', 'help', '?', 'take');
    $illegalNorth = array('33', '41', '11', '31');
    $illegalSouth = array('10', '30', '31');
    $illegalWest = array('43', '42');
    $illegalEast = array('33', '22', '30');

    //determine where they want to go

    echo $_SESSION['x'] . $_SESSION['y'] . '<br>';

    if ($_SESSION['x'] == 9 && $_SESSION['y'] == 9) {
        $form = 'start';
        $command = '';
        $msg = '';
        $sloc = '';
        $commands = '';
        $sceneDesc = $_SESSION['gameData']['99'];


        if (isset($_POST['startGame'])) {
            $_SESSION['x'] = 3;
            $_SESSION['y'] = 3;
            echo $_SESSION['x'] . $_SESSION['y'] . '<br>';
            $sloc = $_SESSION['x'] . $_SESSION['y'];
            $form = 'gameMode';
        }
    } else {
        $form = 'gameMode';
        if (isset($_POST['command'])) {
            $command = strtolower($_POST['command']);
            $commands =  explode(' ', $command);
            $msg = '';
        } else {
            $msg = '';
        }
        // in game mode
        // check if command is valid
        $badwords = [];
        foreach ($commands as $word) {
            if (!in_array($word, $legalCommands)) {
                array_push($badwords, $word);
            }
        }
        if (count($badwords) == 0) {
            $yay = "You went " . $command;
            $nay = " You cant go " . $command;
            $sloc = $_SESSION['x'] . $_SESSION['y'];

            //check if move available and move
            if ($command == 'north' or $command == 'n' and $_SESSION['y'] >= 0 and $_SESSION['y'] <= 3) {
                if ($_SESSION['y'] !== 0 and !in_array($sloc, $illegalNorth)) {
                    $_SESSION['y']--;
                    $msg = $yay;
                } else {
                    $msg = $nay;
                }
            } elseif ($command == 'south' or $command == 's' and $_SESSION['y'] >= 0 and $_SESSION['y'] <= 3) {
                if ($_SESSION['y'] !== 3 and !in_array($sloc, $illegalSouth)) {
                    $_SESSION['y']++;
                    $msg = $yay;
                } else {
                    $msg = $nay;
                }
            } elseif ($command == 'west' or $command == 'w' and $_SESSION['x'] >= 0 and $_SESSION['x'] <= 4) {
                if ($_SESSION['x'] !== 0 and !in_array($sloc, $illegalWest)) {
                    $_SESSION['x']--;
                    $msg = $yay;
                } else {
                    $msg = $nay;
                }
            } elseif ($command == 'east'  or $command == 'e' and $_SESSION['x'] >= 0  and $_SESSION['x'] <= 4) {
                if ($_SESSION['x'] !== 4 and !in_array($sloc, $illegalEast)) {
                    $_SESSION['x']++;
                    $msg = $yay;
                } else {
                    $msg = $nay;
                }
            } else {
                $msg = $nay;
            }

            // picking up items
            if (in_array('take', $commands) or in_array('pick', $commands)) {
                $took = "you took the ";
                $noTake = "You can't carry anything more";

                //monster check
                if($_SESSION['gameData'][$loc][1] == 1) {

                }

                //item check
                if($_SESSION['gameData'][$loc][2] != 0) {

                }

                //fix check
                if($_SESSION['gameData'][$loc][3] == 1) {

                }

                if ($sloc == 33 && in_array('map', $commands) && $_SESSION['it1'] != 2 && $_SESSION['it2'] != 2 && $_SESSION['it3'] != 2 && $_SESSION['it4'] != 2) {
                    if ($_SESSION['it1'] == 1) {
                        $_SESSION['it1'] = 2;
                        $msg = $took . "map";
                    } elseif ($_SESSION['it2'] == 1) {
                        $_SESSION['it2'] = 2;
                        $msg = $took . "map";
                    } elseif ($_SESSION['it3'] == 1) {
                        $_SESSION['it3'] = 2;
                        $msg =$took . "map";
                    } elseif ($_SESSION['it4'] == 1) {
                        $_SESSION['it4'] = 2;
                        $msg = $took . "map";
                    } else {
                        $msg = $noTake;
                    }
                } elseif ($sloc == 12 && in_array('key', $commands) && $_SESSION['it1'] != 5 && $_SESSION['it2'] != 5 && $_SESSION['it3'] != 5 && $_SESSION['it4'] != 5) {
                    if ($_SESSION['it1'] == 1) {
                        $_SESSION['it1'] = 5;
                        $msg = $took . "key";
                    } elseif ($_SESSION['it2'] == 1) {
                        $_SESSION['it2'] = 5;
                        $msg = $took . "key";;
                    } elseif ($_SESSION['it3'] == 1) {
                        $_SESSION['it3'] = 5;
                        $msg = $took . "key";
                    } elseif ($_SESSION['it4'] == 1) {
                        $_SESSION['it4'] = 5;
                        $msg = $took . "key";
                    } else {
                        $msg = $noTake;
                    }
                }elseif ($sloc == 11 && in_array('medkit', $commands) && $_SESSION['it1'] != 4 && $_SESSION['it2'] != 4 && $_SESSION['it3'] != 4 && $_SESSION['it4'] != 4) {
                    if ($_SESSION['it1'] == 1) {
                        $_SESSION['it1'] = 4;
                        $msg = $took . "medkit";
                    } elseif ($_SESSION['it2'] == 1) {
                        $_SESSION['it2'] = 4;
                        $msg = $took . "medkit";
                    } elseif ($_SESSION['it3'] == 1) {
                        $_SESSION['it3'] = 4;
                        $msg = $took . "medkit";
                    } elseif ($_SESSION['it4'] == 1) {
                        $_SESSION['it4'] = 4;
                        $msg = $took . "medkit";
                    } else {
                        $msg = $noTake;
                    }
                }elseif ($sloc == 31 && in_array('spacesuit', $commands) && $_SESSION['it1'] != 3 && $_SESSION['it2'] != 3 && $_SESSION['it3'] != 3 && $_SESSION['it4'] != 3) {
                    if ($_SESSION['it1'] == 1) {
                        $_SESSION['it1'] = 3;
                        $msg = $took . "spacesuit";
                    } elseif ($_SESSION['it2'] == 1) {
                        $_SESSION['it2'] = 3;
                        $msg = $took . "spacesuit";
                    } elseif ($_SESSION['it3'] == 1) {
                        $_SESSION['it3'] = 3;
                        $msg = $took . "spacesuit";
                    } elseif ($_SESSION['it4'] == 1) {
                        $_SESSION['it4'] = 3;
                        $msg = $took . "spacesuit";
                    } else {
                        $msg = $noTake;
                    }
                }elseif ($sloc == 22 && in_array('blaster', $commands) && $_SESSION['it1'] != 8 && $_SESSION['it2'] != 8 && $_SESSION['it3'] != 8 && $_SESSION['it4'] != 8) {
                    if ($_SESSION['it1'] == 1) {
                        $_SESSION['it1'] = 8;
                        $msg = $took . "blaster";
                    } elseif ($_SESSION['it2'] == 1) {
                        $_SESSION['it2'] = 8;
                        $msg = $took . "blaster";
                    } elseif ($_SESSION['it3'] == 1) {
                        $_SESSION['it3'] = 8;
                        $msg = $took . "blaster";
                    } elseif ($_SESSION['it4'] == 1) {
                        $_SESSION['it4'] = 8;
                        $msg = $took . "blaster";
                    } else {
                        $msg = $noTake;
                    }
                } elseif ($sloc == 02 && in_array('toolbox', $commands) && $_SESSION['it1'] != 6 && $_SESSION['it2'] != 6 && $_SESSION['it3'] != 6 && $_SESSION['it4'] != 6) {
                    if ($_SESSION['it1'] == 1) {
                        $_SESSION['it1'] = 6;
                        $msg = $took . "toolbox";
                    } elseif ($_SESSION['it2'] == 1) {
                        $_SESSION['it2'] = 6;
                        $msg = $took . "toolbox";
                    } elseif ($_SESSION['it3'] == 1) {
                        $_SESSION['it3'] = 6;
                        $msg = $took . "toolbox";
                    } elseif ($_SESSION['it4'] == 1) {
                        $_SESSION['it4'] = 6;
                        $msg = $took . "toolbox";
                    } else {
                        $msg = $noTake;
                    }
                } elseif ($sloc == 03 && in_array('protbar', $commands) && $_SESSION['it1'] != 7 && $_SESSION['it2'] != 7 && $_SESSION['it3'] != 7 && $_SESSION['it4'] != 7 ){
                    if ($_SESSION['it1'] == 1) {
                        $_SESSION['it1'] = 7;
                        $msg = $took . "protbar";
                    } elseif ($_SESSION['it2'] == 1) {
                        $_SESSION['it2'] = 7;
                        $msg = $took . "protbar";
                    } elseif ($_SESSION['it3'] == 1) {
                        $_SESSION['it3'] = 7;
                        $msg = $took . "protbar";
                    } elseif ($_SESSION['it4'] == 1) {
                        $_SESSION['it4'] = 7;
                        $msg = $took . "protbar";
                    } else {
                        $msg = $noTake;
                    }
                }
            }
            // help command
            if($command == "help" or $command == "?"){
                $msg = $help;
            }

            //THE  FIGHTING!!!
            // if($_SESSION['x']== 2 && $_SESSION['y'] == 3){
            //     if()
            // }


            $sloc = $_SESSION['x'] . $_SESSION['y'];

        } else {
            if (!in_array($command, $legalCommands)) {
                if ($command == '') {
                    $msg = "You didnt input a command silly";
                } else {
                    $msg = "i dont know the word ";
                }
            }
        }
        // echo $sloc;
        // echo "<br>";
        // echo $loc;
        // echo "<br>";
        // echo $sceneDesc;
        // echo "<br>";

        $x = $_SESSION['x'];
        $y = $_SESSION['y'];

        $it1 = $_SESSION['it1'];
        $it2 = $_SESSION['it2'];
        $it3 = $_SESSION['it3'];
        $it4 = $_SESSION['it4'];
        if (isset($_POST['save'])) {
            require('conn.php');
            $id = $_SESSION['id'];
            $qSave = "UPDATE `users` SET `x` = '$x', `y` = '$y', `item_1` = '$it1', `item_2` = '$it2', `item_3` = '$it3', `item_4` = '$it4' WHERE `users`.`user_id` = $id;";
            $result = mysqli_query($conn, $qSave);
            $msg = "sucessfully saved";
        }
    }
    $loc = $_SESSION['x'] . $_SESSION['y'];
    $sceneDesc = $_SESSION['gameData'][$loc];
}

?>

<html>

<body>
    <?php
    echo $sceneDesc . '<br>';
    // echo $sloc . '<br>';
    echo $msg;
    if (!empty($badwords)) {
        foreach ($badwords as $word) {
            echo $word . " ";
        }
    }

    echo  '<br> Location: ' . $_SESSION['x'] . $_SESSION['y']; ?>


    <?php
    if ($form == 'start') { ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type='submit' name='startGame' value='Start Game?'>
        </form>
    <?php } else {
        //show game form
    ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <input type='text' name='command' autofocus>
            <input type='submit' name='enter' value='Enter'>
            <br>
            <br>
            <input type='submit' name='save' value='Save Game'>
        </form>
        <img src="images/map.PNG">
        <br>
        <a href="logout.php"> Logout? </a> <br>
    <?php } ?>
</body>

</html>