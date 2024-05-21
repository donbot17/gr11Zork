<?php
session_start();

if (isset($_POST['submitButton'])) {
    $lengE = $_POST['user'];
    $lengP = $_POST['pwd'];
    $p = password_hash($lengP, PASSWORD_DEFAULT);
    $blacklistChars = '"%\'*;<>?^`{|}~/\\#=&';
    $pattern = preg_quote($blacklistChars, '/');
    $Atsym = "@";

    //Validation
    //username
    if (preg_match("/[0-9]/", $_POST['user'])) {
        $msg =  "Username may not contain numbers";
    } elseif (empty($_POST['user'])) {
        $msg =  "Username is missing";
    } elseif (strlen($lengE) > 33) {
        $msg =  "Username cannot exceed 33 characters";
    } elseif (preg_match('/[' . $pattern . ']/', $_POST['user'])) {
        $msg = "Username may not contain speacial characters";
        // pwd
    } elseif (empty($_POST['pwd'])) {
        $msg =  "Password data is missing";
    } elseif (preg_match("/$Atsym/", $_POST['pwd'])) {
        $msg =  "Password may not contain the @ symbol";
    } elseif (strlen($lengP) > 77) {
        $msg =  "Password cannot exceed 77 characters";
    } else {
        $msg = "Data is valid.";
    }



    //Put in database
    if ($msg == "Data is valid.") {

        $gameData = array(
            '00' => "Court Yard + Buggy, ride buggy?",
            '10' => "Court Yard Enterance",
            '20' => "Court Yard",
            '30' => "Green House",
            '01' => "Hallway E",
            '11' => "Medbay, there is a medkit here",
            '21' => "Hallway G",
            '31' => "Hanger, there is a spacesuit here",
            '41' => "Rocket",
            '02' => "Generator",
            '12' => ["Control Room, there is a key here",1,1,0],
            '22' => "Weapons, there is a blaster here",
            '42' => "Pathway",
            '03' => "Cafeteria",
            '13' => "Lounge",
            '23' => "Hallway O",
            '33' => "Barracks, there is a pager and map here",
            '43' => "Observatory, it seems to be locked",
            '99' => 'You are on board a space out-post with 5 other crew, who youve lived with for 2 years, you are a mechanic. <br> This space out-post has been used to study alien life forms and collect samples to send back to earth. <br> This extensive base feels big for just five crew, and sometimes, you feel as though when you stare out into the stars, <br> something stares back...'
        );

        require('conn.php');
        $bro = json_encode($gameData);
        $bro = mysqli_real_escape_string($conn, $bro); // Escape the string to prevent SQL injection
        
        $query = "INSERT INTO `users` (`user_id`, `username`, `pwd`, `x`, `y`, `health`, `item_1`, `item_2`, `item_3`, `item_4`, `gameData`) VALUES (NULL, '$lengE' , '$p', '9', '9', '3', '1','1','1','1', '$bro')";
        
        mysqli_query($conn, $query) or die("kys pt 2");
        $_SESSION['username'] = $lengE;
        header('location: login.php');
        $msg = "Registration successful. log in, jerk face";
    }
}

?>

<html>
<h1>Register </h1>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        Username: <input type="text" name="user">
        <br>
        Password: <input type="text" name="pwd"><br>
        <input type="submit" name="submitButton">
        <?php
        if (isset($_POST['submitButton'])) {
            echo $msg;
        }
        ?>
    </form>
</body>
<html>