<?php
session_start();

// Controllo autenticazione
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header('Location: login.php');
    exit();
}

require_once "db.php";

$username = $_SESSION['username'];
$error_message = "";
$success_message = "";

// Gestione upload file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $nome_file = $_POST['nome_file'];
    $contenuto = $_POST['contenuto'];
    
    if (!empty($nome_file) && !empty($contenuto)) {
        $stmt = $connection->prepare("INSERT INTO File (Nome, Contenuto, Username) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome_file, $contenuto, $username);
        
        if ($stmt->execute()) {
            $success_message = "File caricato con successo!";
        } else {
            $error_message = "Errore durante il caricamento del file.";
        }
        $stmt->close();
    } else {
        $error_message = "Compila tutti i campi.";
    }
}

// Gestione eliminazione file
if (isset($_GET['delete'])) {
    $file_id = intval($_GET['delete']);
    
    // Verifica che il file appartenga all'utente loggato
    $stmt = $connection->prepare("DELETE FROM File WHERE ID = ? AND Username = ?");
    $stmt->bind_param("is", $file_id, $username);
    
    if ($stmt->execute()) {
        $success_message = "File eliminato con successo!";
    } else {
        $error_message = "Errore durante l'eliminazione del file.";
    }
    $stmt->close();
}

// Recupera i file dell'utente loggato
$stmt = $connection->prepare("SELECT ID, Nome, Data, Contenuto FROM File WHERE Username = ? ORDER BY Data DESC");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$files = [];

while ($row = $result->fetch_assoc()) {
    $files[] = $row;
}

$stmt->close();
$connection->close();
?>