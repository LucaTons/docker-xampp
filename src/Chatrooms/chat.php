<?php
session_start();

require_once "db.php";

if ($_SESSION && isset($_SESSION['username']))
{
    if ($_GET && isset($_GET['room_id']))
    {
        $stanza = $_GET['room_id'];
        $queryNomeStanza = "SELECT Nome FROM Chatroom WHERE ID = $stanza";
        $result = $connection->query($queryNomeStanza);
        $row2 = $result->fetch_assoc();
        echo "Messaggi della stanza " . $row2['Nome'];
        echo "<br>";
        //query dalla tabella messaggi e visualizzo i contenuti
        $nomeStanza = $row2['Nome'];
        $query = "SELECT * FROM Messaggi WHERE NomeStanza = '$nomeStanza'";
        $result = $connection->query($query);
        var_dump($result->num_rows);
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                echo ($row['User']) . ": ";
                echo ($row['Testo']) . " ";
                echo ($row['Giorno']);
                echo "<br>";
            }
        }
    }
    if ($_POST && isset($_POST['messaggio']))
    {
        $msg = $_POST['messaggio'];
        $user = $_SESSION['username'];
        var_dump($msg);
        $queryInsMsg = "INSERT INTO Messaggi (`Testo`, `NomeStanza`, `User`) VALUES ('$msg','Prova', '$user')";
        var_dump($queryInsMsg);
        $result = $connection->query($queryInsMsg);
    }
}

$connection->close();
?>

<!-- form per inviare i messaggi alla chat -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<body>
    <form action="" method="POST">
        <label for="messaggio">Messaggio</label>
        <input type="text" id="messaggio" name="messaggio">
        <br>
        <button type="submit">Invia</button>
    </form>
</body>
</html>
