<?php
session_start();

if (isset($_POST['loginButton'])) {

    $uname = $_POST['username'];
    $pwd = $_POST['pwd'];

    if (!empty($uname) && !empty($pwd)) {

        require('conn.php');
        $query = "SELECT * FROM `users` WHERE `username` = '$uname'";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            if (password_verify($pwd, $row['pwd'])) {
                $_SESSION['username'] = $uname;
                $_SESSION['x'] = $row['x'];
                $_SESSION['y'] = $row['y'];
                $_SESSION['hp'] = $row['health'];
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['it1'] = $row['item_1'];
                $_SESSION['it2'] = $row['item_2'];
                $_SESSION['it3'] = $row['item_3'];
                $_SESSION['it4'] = $row['item_4'];
                $_SESSION['gameData'] = json_decode($row['gameData'], true);
                header('location: index.php');
            } else {
                $err_msg = "incorrect username or password";
            }
        }
    } else {
        $err_msg = "you haven't filled out all required fields.";
    }
}
?>

<html>
<h1> login </h1>

<body>
    <?php if (isset($err_msg)) {
        echo $err_msg;
    } ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        Username: <input type="text" name="username">
        <br>
        Password: <input type="password" name="pwd"><br>
        <input type="submit" name="loginButton">
    </form>
    <br>
    <a href="register.php"> Want to Register? </a>
</body>

</html>