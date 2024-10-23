<?php
session_start();
require 'config.php'; // Ensure this file contains your DB connection code

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM health WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $health = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $health_status = $_POST['health_status'];
        $health_history = $_POST['health_history'];
        $previous_checkup = $_POST['previous_checkup'];
        $next_checkup = $_POST['next_checkup'];

        $update_sql = "UPDATE health SET health_status = ?, health_history = ?, previous_checkup = ?, next_checkup = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssii", $health_status, $health_history, $previous_checkup, $next_checkup, $id);

        if ($update_stmt->execute()) {
            header("Location: health.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    header("Location: health.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Health Record</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Health Record</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="health_status">Health Status</label>
                <input type="text" class="form-control" id="health_status" name="health_status" value="<?php echo htmlspecialchars($health['health_status']); ?>" required>
            </div>
            <div class="form-group">
                <label for="health_history">Health History</label>
                <textarea class="form-control" id="health_history" name="health_history" required><?php echo htmlspecialchars($health['health_history']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="previous_checkup">Previous Checkup</label>
                <input type="date" class="form-control" id="previous_checkup" name="previous_checkup" value="<?php echo htmlspecialchars($health['previous_checkup']); ?>" required>
            </div>
            <div class="form-group">
                <label for="next_checkup">Next Checkup</label>
                <input type="date" class="form-control" id="next_checkup" name="next_checkup" value="<?php echo htmlspecialchars($health['next_checkup']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
            <a href="health.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
