<?php
    if($_POST && isset($_POST['username']) && isset($_POST['password']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username = "santa" && $password = "rudolf")
        {
            $_SESSION = "username";
            $_SESSION = "password";
            header("Location: dashboard.php");
        }
        else
        {
            header("Location: login.html");
        }

    }
?>