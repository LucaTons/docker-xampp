<?php
session_start();

// Controllo autenticazione
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header('Location: login.php');
    exit();
}

require_once "db.php";

$username = $_SESSION['username'];
$file = null;
$error_message = "";

if (isset($_GET['id'])) {
    $file_id = intval($_GET['id']);
    
    // Recupera il file solo se appartiene all'utente loggato
    $stmt = $connection->prepare("SELECT ID, Nome, Data, Contenuto FROM File WHERE ID = ? AND Username = ?");
    $stmt->bind_param("is", $file_id, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $file = $result->fetch_assoc();
    } else {
        $error_message = "File non trovato o non hai i permessi per visualizzarlo.";
    }
    
    $stmt->close();
} else {
    $error_message = "ID file non specificato.";
}

$connection->close();
?>