<?php 
    session_start();
    $uid = $_SESSION['user_id'];
    $msg = "you wake up in the barracks in your bed. <br> Your pager is going off on the table, the room is pitch black, illuminated soley from the screen of the pager.";

    $query = "UPDATE `users` SET `location` = 'P' WHERE `users`.`user_id` = '$uid';";

    require('conn.php');
    mysqli_query($conn, $query) or die("kys pt 2");

    if(isset($_POST["enter"])){ 
        $in = $_POST["data"];
    }


?>

<html>
    <body>
        <?php echo $msg ; ?>
        <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST" >
            <input type = "text" name = "data">
            <input type = "submit" name = "enter" value = "Enter">
        </form>
    </body>