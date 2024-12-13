<?php
session_start();
include 'db_connection.php';

// Check if Pharmacist ID is provided
if (!isset($_SESSION['pharmacist_id'])) {
    header("Location: loginorderp.php");
    exit;
}

$pharmacistID = $_SESSION['pharmacist_id'];

// Check if Order ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("<div class='alert alert-danger'>Invalid Order ID.</div>");
}

$orderID = intval($_GET['id']);

// Fetch the assigned pharmacy
$pharmacyStmt = $conn->prepare("SELECT PharmacyID FROM pharmacists WHERE PharmacistID = ?");
$pharmacyStmt->bind_param("i", $pharmacistID);
$pharmacyStmt->execute();
$pharmacyID = $pharmacyStmt->get_result()->fetch_assoc()['PharmacyID'];
$pharmacyStmt->close();

// Check if the order belongs to the same pharmacy
$orderStmt = $conn->prepare("SELECT * FROM orders WHERE OrderID = ? AND PharmacyID = ?");
$orderStmt->bind_param("ii", $orderID, $pharmacyID);
$orderStmt->execute();
$order = $orderStmt->get_result()->fetch_assoc();

if (!$order) {
    die("<div class='alert alert-danger'>Order not found or does not belong to your pharmacy.</div>");
}

// Confirm the order
$confirmStmt = $conn->prepare("UPDATE orders SET Status = 'CONFIRMED' WHERE OrderID = ?");
$confirmStmt->bind_param("i", $orderID);
$confirmStmt->execute();

echo "<div class='alert alert-success'>Order confirmed successfully!</div>";
echo "<a href='order_management.php' class='btn btn-primary'>Back to Order Management</a>";

$confirmStmt->close();
$conn->close();
?>
