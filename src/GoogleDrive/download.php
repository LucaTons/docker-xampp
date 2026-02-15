<?php
session_start();

if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit();
}

require_once "db.php";

$username = $_SESSION['username'];
$file_id = intval($_GET['id']);

$stmt = $connection->prepare("SELECT Nome, Contenuto FROM File WHERE ID = ? AND Username = ?");
$stmt->bind_param("is", $file_id, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $file = $result->fetch_assoc();
    
    $contenuto = base64_decode($file['Contenuto']);
    
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $file['Nome'] . '"');
    
    echo $contenuto;
    exit();
}

$connection->close();
?>