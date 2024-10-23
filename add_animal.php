<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "livestock_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$species = $_POST['species'];
$age = $_POST['age'];
$gender = $_POST['gender'];

$sql = "INSERT INTO animals (species, age, gender) VALUES ('$species', $age, '$gender')";

if ($conn->query($sql) === TRUE) {
    echo "New animal added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
