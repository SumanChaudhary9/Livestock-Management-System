<?php
session_start();
require 'config.php'; // Ensure this file contains your DB connection code

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $animal = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $species = $_POST['species'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];

        $update_sql = "UPDATE animals SET species = ?, age = ?, gender = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sisi", $species, $age, $gender, $id);

        if ($update_stmt->execute()) {
            header("Location: view.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    header("Location: view.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Record</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="species">Species</label>
                <input type="text" class="form-control" id="species" name="species" value="<?php echo htmlspecialchars($animal['species']); ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($animal['age']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male" <?php if ($animal['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($animal['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($animal['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
            <a href="view.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
