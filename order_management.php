<?php
session_start();
include 'db_connection.php';

// Check if Pharmacist ID is provided
if (!isset($_SESSION['pharmacist_id'])) {
    header("Location: loginorderp.php");
    exit;
}

$pharmacistID = $_SESSION['pharmacist_id'];

// Fetch assigned pharmacy
$pharmacyStmt = $conn->prepare("SELECT PharmacyID FROM pharmacists WHERE PharmacistID = ?");
$pharmacyStmt->bind_param("i", $pharmacistID);
$pharmacyStmt->execute();
$pharmacyID = $pharmacyStmt->get_result()->fetch_assoc()['PharmacyID'];
$pharmacyStmt->close();

// Fetch orders for this pharmacy
$orderStmt = $conn->prepare("
    SELECT o.OrderID, o.OrderDate, o.Status, u.Username, u.Email
    FROM orders o
    JOIN users u ON o.UserID = u.UserID
    WHERE o.PharmacyID = ?
");
$orderStmt->bind_param("i", $pharmacyID);
$orderStmt->execute();
$orders = $orderStmt->get_result()->fetch_all(MYSQLI_ASSOC);

$orderStmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Order Management</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['OrderID']); ?></td>
                        <td><?php echo htmlspecialchars($order['Username']) . ' (' . htmlspecialchars($order['Email']) . ')'; ?></td>
                        <td><?php echo htmlspecialchars($order['OrderDate']); ?></td>
                        <td><?php echo htmlspecialchars($order['Status']); ?></td>
                        <td>
                            <a href="view_order.php?id=<?php echo htmlspecialchars($order['OrderID']); ?>" class="btn btn-info btn-sm">View</a>
                            <?php if ($order['Status'] === 'PENDING'): ?>
                                <a href="confirm_order.php?id=<?php echo htmlspecialchars($order['OrderID']); ?>" class="btn btn-success btn-sm">Confirm</a>
                                <a href="cancel_order.php?id=<?php echo htmlspecialchars($order['OrderID']); ?>" class="btn btn-danger btn-sm">Cancel</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
</div>
</body>
</html>
