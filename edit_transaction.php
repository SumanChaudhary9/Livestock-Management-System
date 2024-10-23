<?php
session_start();
require 'config.php'; // Ensure this file contains your DB connection code

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM transactions WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $transaction = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $type = $_POST['type'];
        $species = $_POST['species'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $price = $_POST['price'];
        $date = $_POST['date'];

        $update_sql = "UPDATE transactions SET type = ?, species = ?, age = ?, gender = ?, price = ?, date = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssissdi", $type, $species, $age, $gender, $price, $date, $id);

        if ($update_stmt->execute()) {
            // Update animals table if it is a purchase
            if ($type == 'purchase') {
                $update_animal_sql = "UPDATE animals SET species = ?, age = ?, gender = ? WHERE id = ?";
                $update_animal_stmt = $conn->prepare($update_animal_sql);
                $update_animal_stmt->bind_param("sisi", $species, $age, $gender, $id);
                $update_animal_stmt->execute();
            }
            header("Location: view_transaction.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    header("Location: view_transaction.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaction Record</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Transaction Record</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="type">Transaction Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="purchase" <?php if (isset($transaction['type']) && $transaction['type'] == 'purchase') echo 'selected'; ?>>Purchase</option>
                    <option value="sale" <?php if (isset($transaction['type']) && $transaction['type'] == 'sale') echo 'selected'; ?>>Sale</option>
                </select>
            </div>
            <div class="form-group">
                <label for="species">Species</label>
                <input type="text" class="form-control" id="species" name="species" value="<?php echo htmlspecialchars($transaction['species']); ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($transaction['age']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male" <?php if (isset($transaction['gender']) && $transaction['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if (isset($transaction['gender']) && $transaction['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if (isset($transaction['gender']) && $transaction['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($transaction['price']); ?>" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($transaction['transaction_date']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
            <a href="view_transaction.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
