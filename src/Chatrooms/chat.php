<?php
session_start();

require_once "db.php";

if ($_SESSION && isset($_SESSION['username']))
{
    if ($_GET && isset($_GET['room_id']))
    {
        $stanza = $_GET['room_id'];
        $nome = $_GET['NomeStanza'];
        echo "Messaggi della stanza $nome";
        echo "<br>";
        //query dalla tabella messaggi e visualizzo i contenuti
        $query = "SELECT * FROM Messaggi WHERE NomeStanza = $stanza";
        $result = $connection->query($query);
        if($result->num_rows > 0)
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
