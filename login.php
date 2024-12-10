<?php
session_start();
include 'db_connection.php'; // Ensure this connects using mysqli

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT * FROM Pharmacists WHERE Username = ?");

        // Check if prepare() was successful
        if ($stmt === false) {
            throw new Exception("Error preparing SQL statement: " . $conn->error);
        }

        // Bind parameters and execute the prepared statement
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();
        $pharmacist = $result->fetch_assoc();

        // Verify the password
        if ($pharmacist && password_verify($password, $pharmacist['Password'])) {
            // Store pharmacist and pharmacy information in session
            $_SESSION['pharmacist_id'] = $pharmacist['PharmacistID'];
            $_SESSION['pharmacy_id'] = $pharmacist['PharmacyID'];

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } catch (Exception $e) {
        // Handle exceptions and display an error message
        echo "An error occurred: " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacist Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Pharmacist Login</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>
