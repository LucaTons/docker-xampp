<?php
    $host = 'db';
    $dbname = 'Chatrooms';
    $user = 'user';
    $password = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $password, $dbname, $port);

    if ($connection->connect_error) 
    {
        die("Errore di connessione: " . $connection->connect_error);
    }

    //per controllare che venga fatto il login tramite POST
    if($_POST && isset($_POST['username']) && isset($_POST['password'])) 
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username == 'username' && $password == 'password')
        {
            session_start();
            $_SESSION['auth'] = true;
            header('Location: dashboard.php'); //location è il descrittore
        }
        else
        {
            header('Location: login.html');
        }
    }

    $connection->close();
?>