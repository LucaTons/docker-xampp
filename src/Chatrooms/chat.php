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
        echo "<br>";
        //query dalla tabella messaggi e visualizzo i contenuti
        $nomeStanza = $row2['Nome'];
        $query = "SELECT * FROM Messaggi WHERE NomeStanza = '$nomeStanza'";
        $result = $connection->query($query);
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
        $queryInsMsg = "INSERT INTO Messaggi (`Testo`, `NomeStanza`, `User`) VALUES ('$msg','Prova', '$user')";
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
        <br>
        <label for="messaggio">Inserisci Messaggio</label>
        <br>
        <input type="text" id="messaggio" name="messaggio">

        <button type="submit">Invia</button>
        <br>
        <br>
        <a href="dashboard.php">← Torna alla dashboard</a>
    </form>
</body>
</html>
