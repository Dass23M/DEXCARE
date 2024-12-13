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

// Cancel the order
$cancelStmt = $conn->prepare("UPDATE orders SET Status = 'CANCELLED' WHERE OrderID = ?");
$cancelStmt->bind_param("i", $orderID);
$cancelStmt->execute();

// Restore stock quantity
$orderItemsStmt = $conn->prepare("SELECT ProductID, Quantity FROM order_items WHERE OrderID = ?");
$orderItemsStmt->bind_param("i", $orderID);
$orderItemsStmt->execute();
$orderItems = $orderItemsStmt->get_result()->fetch_all(MYSQLI_ASSOC);

foreach ($orderItems as $item) {
    $restoreStockStmt = $conn->prepare("UPDATE Products SET StockQuantity = StockQuantity + ? WHERE ProductID = ?");
    $restoreStockStmt->bind_param("ii", $item['Quantity'], $item['ProductID']);
    $restoreStockStmt->execute();
}

echo "<div class='alert alert-success'>Order cancelled successfully!</div>";
echo "<a href='order_management.php' class='btn btn-primary'>Back to Order Management</a>";

$cancelStmt->close();
$orderItemsStmt->close();
$conn->close();
?>
