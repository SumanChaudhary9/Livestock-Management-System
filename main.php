<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livestock Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
    <!-- <div class="p-3 mb-2 bg-info text-dark"><h5>View and Edit Records</h5></div> -->
        <h2 class="p-3 mb-2 bg-info text-dark">Livestock Management System</h2>

        <h2>Add Animal</h2>
        <form id="addAnimalForm" class="mb-5">
            <div class="form-group">
                <input type="text" id="species" name="species" class="form-control" placeholder="Species" required>
            </div>
            <div class="form-group">
                <input type="number" id="age" name="age" class="form-control" placeholder="Age" required>
            </div>
            <div class="form-group">
                <input type="text" id="gender" name="gender" class="form-control" placeholder="Gender" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Animal</button>
        </form>

        <h2>Health Monitoring</h2>
        <form id="addHealthForm" class="mb-5">
            <div class="form-group">
                <input type="number" id="health_id" name="id" class="form-control" placeholder="Animal ID" required>
            </div>
            <div class="form-group">
                <input type="text" id="health_status" name="health_status" class="form-control" placeholder="Health Status" required>
            </div>
            <div class="form-group">
                <textarea id="health_history" name="health_history" class="form-control" placeholder="Health History" required></textarea>
            </div>
            <div class="form-group">
                <label for="previous_checkup">Previous Checkup</label>
                <input type="date" id="previous_checkup" name="previous_checkup" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="next_checkup">Next Checkup</label>
                <input type="date" id="next_checkup" name="next_checkup" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Health Record</button>
        </form>

        <h2>Breeding Management</h2>
        <form id="addBreedingForm" class="mb-5">
            <div class="form-group">
                <input type="number" id="breeding_id" name="id" class="form-control" placeholder="Animal ID" required>
            </div>
            <div class="form-group">
                <label for="birth_date">Birth Date</label>
                <input type="date" id="birth_date" name="birth_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="pregnancy_duration">Pregnancy Duration in Months</label>
                <input type="number" id="pregnancy_duration" name="pregnancy_duration" class="form-control" placeholder="Pregnancy Duration" required>
            </div>
            <div class="form-group">
                <input type="text" id="breeding_species" name="species" class="form-control" placeholder="Species" required>
            </div>
            <div class="form-group">
                <input type="text" id="breeding_gender" name="gender" class="form-control" placeholder="Gender" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Breeding Record</button>
        </form>

        <h2>Transactions</h2>
        <form id="addTransactionForm" class="mb-5">
            <div class="form-group">
                <input type="number" id="transaction_animal_id" name="animal_id" class="form-control" placeholder="Animal ID" required>
            </div>
            <div class="form-group">
                <select id="transaction_type" name="transaction_type" class="form-control" required>
                    <option value="purchase">Purchase</option>
                    <option value="sale">Sale</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" id="transaction_species" name="species" class="form-control" placeholder="Species" required>
            </div>
            <div class="form-group">
                <input type="number" id="transaction_age" name="age" class="form-control" placeholder="Age" required>
            </div>
            <div class="form-group">
                <input type="text" id="transaction_gender" name="gender" class="form-control" placeholder="Gender" required>
            </div>
            <div class="form-group">
                <input type="number" step="0.01" id="transaction_price" name="price" class="form-control" placeholder="Price" required>
            </div>
            <div class="form-group">
                <label for="transaction_date">Transaction Date</label>
                <input type="date" id="transaction_date" name="transaction_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Transaction</button>
        </form>

        <!-- <h2>View and Edit Records</h2> -->
        <div id="records" class="mb-5"></div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.html"><img src="logo.JPG" width="150" height="80" alt=""></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>



