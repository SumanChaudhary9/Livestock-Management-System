<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "livestock_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$animal_id = $_POST['animal_id'];
$transaction_type = $_POST['transaction_type'];
$species = $_POST['species'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$price = $_POST['price'];
$transaction_date = $_POST['transaction_date'];

$sql = "INSERT INTO transactions (animal_id, transaction_type, species, age, gender, price, transaction_date) 
        VALUES ($animal_id, '$transaction_type', '$species', $age, '$gender', $price, '$transaction_date')";

if ($conn->query($sql) === TRUE) {
    echo "New transaction record added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
