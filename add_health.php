<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "livestock_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$health_status = $_POST['health_status'];
$health_history = $_POST['health_history'];
$previous_checkup = $_POST['previous_checkup'];
$next_checkup = $_POST['next_checkup'];

$sql = "INSERT INTO health (id, health_status, health_history, previous_checkup, next_checkup) 
        VALUES ($id, '$health_status', '$health_history', '$previous_checkup', '$next_checkup')";

if ($conn->query($sql) === TRUE) {
    echo "New health record added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
