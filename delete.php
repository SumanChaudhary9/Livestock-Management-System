<?php
session_start();
require 'config.php'; // Ensure this file contains your DB connection code

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM animals WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: view.php");
    exit();
}
?>
