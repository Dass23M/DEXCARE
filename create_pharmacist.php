<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if POST variables are set
    if (!isset($_POST['Username']) || !isset($_POST['Password']) || !isset($_POST['PharmacyID'])) {
        echo "Error: Missing required fields.";
        exit;
    }

    $username = $_POST['Username'];
    $password = $_POST['Password']; // In a real application, make sure to hash this password
    $pharmacyID = $_POST['PharmacyID'];

    // Check if the pharmacy exists
    $pharmacyCheck = $conn->prepare("SELECT COUNT(*) FROM Pharmacies WHERE PharmacyID = ?");
    $pharmacyCheck->bind_param("i", $pharmacyID);
    $pharmacyCheck->execute();
    $pharmacyCheck->bind_result($pharmacyCount);
    $pharmacyCheck->fetch();
    $pharmacyCheck->close();

    if ($pharmacyCount == 0) {
        echo "Error: Pharmacy with ID $pharmacyID does not exist.";
        exit;
    }

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Display the hashed password
    echo "Hashed Password: " . $hashedPassword . "<br>";

    // Insert the new pharmacist
    $sql = "INSERT INTO Pharmacists (Username, Password, PharmacyID) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $hashedPassword, $pharmacyID);

    if ($stmt->execute()) {
        echo "Pharmacist created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
