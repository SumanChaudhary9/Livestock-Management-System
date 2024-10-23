<?php
session_start();
require 'config.php'; // Ensure this file contains your DB connection code

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM breeding WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $breeding = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $birth_date = $_POST['birth_date'];
        $pregnancy_duration = $_POST['pregnancy_duration'];
        $species = $_POST['species'];
        $gender = $_POST['gender'];

        $update_sql = "UPDATE breeding SET birth_date = ?, pregnancy_duration = ?, species = ?, gender = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssisi", $birth_date, $pregnancy_duration, $species, $gender, $id);

        if ($update_stmt->execute()) {
            header("Location: view_breeding.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    header("Location: view_breeding.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Breeding Record</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Breeding Record</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="birth_date">Birth Date</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo htmlspecialchars($breeding['birth_date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="pregnancy_duration">Pregnancy Duration</label>
                <input type="number" class="form-control" id="pregnancy_duration" name="pregnancy_duration" value="<?php echo htmlspecialchars($breeding['pregnancy_duration']); ?>" required>
            </div>
            <div class="form-group">
                <label for="species">Species</label>
                <input type="text" class="form-control" id="species" name="species" value="<?php echo htmlspecialchars($breeding['species']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male" <?php if ($breeding['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($breeding['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($breeding['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
            <a href="view_breeding.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
