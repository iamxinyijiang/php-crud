<?php
session_start();
require('db.php');

if (isset($_POST['userName'])) {
    $userName = stripslashes($_POST['userName']);
    $userName = mysqli_real_escape_string($conn, $userName);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM `admin` WHERE userName='$userName' AND password='$password'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $_SESSION['userName'] = $userName;
        header("Location: adminMenu.php");
        exit();
    } else {
        echo "<div class='form'>
        <h3>Username/password is incorrect.</h3>
        <br/>Click here to <a href='login.php'>Login</a>
        </div>";
    }
}
?>
