<?php
session_start();

require_once "db.php";

if ($_SESSION && isset($_SESSION['username']))
{
    if ($_GET && isset($_GET['room_id']))
    {
        $stanza = $_GET['room_id'];
        echo "Messaggi della stanza $stanza";
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