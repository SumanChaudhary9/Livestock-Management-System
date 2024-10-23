<?php
session_start();
require 'config.php'; // Ensure this file contains your DB connection code

$sql = "SELECT * FROM health";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Records</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Health Records</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Animal ID</th>
                    <th>Health Status</th>
                    <th>Health History</th>
                    <th>Previous checkup</th>
                    <th>Next checkup</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['health_status']); ?></td>
                    <td><?php echo htmlspecialchars($row['health_history']); ?></td>
                    <td><?php echo htmlspecialchars($row['previous_checkup']); ?></td>
                    <td><?php echo htmlspecialchars($row['next_checkup']); ?></td>
                    <td>
                        <a href="edit_health.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.html" class="btn btn-secondary">Back to Dashboard</a>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
