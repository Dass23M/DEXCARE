<?php
include 'db_connection.php';

$pharmacyID = $_GET['id'];
$pharmacy = $conn->query("SELECT * FROM Pharmacies WHERE PharmacyID = $pharmacyID")->fetch_assoc();
$products = $conn->query("SELECT * FROM tbl_products WHERE pharmacy_id = $pharmacyID");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pharmacy['PharmacyName']; ?> - Products</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2><?php echo $pharmacy['PharmacyName']; ?></h2>
    <p><?php echo $pharmacy['Address']; ?></p>
    <p>Phone: <?php echo $pharmacy['PhoneNumber']; ?></p>
    <p>Email: <?php echo $pharmacy['Email']; ?></p>

    <h3>Available Products</h3>
    <ul class="list-group">
        <?php while ($product = $products->fetch_assoc()): ?>
            <li class="list-group-item">
                <img src="../images/<?php echo $product['image']; ?>" alt="<?php echo $product['product_name']; ?>" style="width: 100px;">
                <?php echo $product['product_name']; ?> - $<?php echo $product['price']; ?>
                <p><?php echo $product['description']; ?></p>
            </li>
        <?php endwhile; ?>
    </ul>

    <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
</div>
</body>
</html>
