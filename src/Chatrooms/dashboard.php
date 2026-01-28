<?php
    session_start();
    
    require_once "db.php";
    
    $query = "SELECT * FROM Chatroom";
    $result = $connection->query($query);
    
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            echo '<a href=chat.php?room_id=' . htmlspecialchars($row['ID']) . '>' . htmlspecialchars($row['Nome']) . '</a><br>';
        }
    }

    $connection->close();
?>