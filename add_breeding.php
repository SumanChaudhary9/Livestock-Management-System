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
$birth_date = $_POST['birth_date'];
$pregnancy_duration = $_POST['pregnancy_duration'];
$species = $_POST['species'];
$gender = $_POST['gender'];

$sql = "INSERT INTO breeding (id, birth_date, pregnancy_duration, species, gender) 
        VALUES ($id, '$birth_date', $pregnancy_duration, '$species', '$gender')";

if ($conn->query($sql) === TRUE) {
    echo "New breeding record added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
