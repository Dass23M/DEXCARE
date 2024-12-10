<?php
include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Create New Pharmacy</h2>
    <form action="create_pharmacy.php" method="post">
        <div class="form-group">
            <label for="pharmacyName">Pharmacy Name</label>
            <input type="text" class="form-control" id="pharmacyName" name="pharmacyName" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="phoneNumber">Phone Number</label>
            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Pharmacy</button>
    </form>

    <h2 class="mt-5">Create New Pharmacist</h2>
    <form action="create_pharmacist.php" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="Username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="Password" required>
    </div>
    <div class="form-group">
        <label for="pharmacyID">Pharmacy (optional)</label>
        <select class="form-control" id="pharmacyID" name="PharmacyID">
            <option value="">None</option>
            <?php
            $pharmacies = $conn->query("SELECT * FROM Pharmacies");
            while ($row = $pharmacies->fetch_assoc()) {
                echo "<option value='" . $row['PharmacyID'] . "'>" . $row['PharmacyName'] . "</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Create Pharmacist</button>
</form>


    <h2 class="mt-5">Assign Pharmacist to Pharmacy</h2>
    <form action="assign_pharmacist.php" method="post">
        <div class="form-group">
            <label for="pharmacistID">Pharmacist</label>
            <select class="form-control" id="pharmacistID" name="pharmacistID" required>
                <?php
                $pharmacists = $conn->query("SELECT * FROM Pharmacists WHERE PharmacyID IS NULL");
                while ($row = $pharmacists->fetch_assoc()) {
                    echo "<option value='" . $row['PharmacistID'] . "'>" . $row['Username'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="pharmacyID">Pharmacy</label>
            <select class="form-control" id="pharmacyID" name="pharmacyID" required>
                <?php
                $pharmacies = $conn->query("SELECT * FROM Pharmacies");
                while ($row = $pharmacies->fetch_assoc()) {
                    echo "<option value='" . $row['PharmacyID'] . "'>" . $row['PharmacyName'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Pharmacist</button>
    </form>
</div>
</body>
</html>
