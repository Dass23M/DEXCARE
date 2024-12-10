<?php
session_start();
include 'db_connection.php'; // Make sure this uses PDO, not mysqli

// Ensure the session is started and the required session variable is set
if (!isset($_SESSION['pharmacy_id'])) {
    echo "Access denied.";
    exit;
}

$pharmacyID = $_SESSION['pharmacy_id'];

try {
    // Fetch pharmacy details
    $pharmacyStmt = $conn->prepare("SELECT * FROM Pharmacies WHERE PharmacyID = :pharmacy_id");
    $pharmacyStmt->execute([':pharmacy_id' => $pharmacyID]);
    $pharmacy = $pharmacyStmt->fetch(PDO::FETCH_ASSOC);

    if (!$pharmacy) {
        echo "Pharmacy not found.";
        exit;
    }

    // Handle form submission for adding products
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $productName = htmlspecialchars($_POST['product_name']);
        $price = floatval($_POST['price']);
        $description = htmlspecialchars($_POST['description']);
        $productImageName = $_FILES['image']['name'];
        $productImageTmpName = $_FILES['image']['tmp_name'];

        $target_dir = "../images/";
        $target_file = $target_dir . basename($productImageName);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($productImageTmpName);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($productImageTmpName, $target_file)) {
                echo "The file " . htmlspecialchars(basename($productImageName)) . " has been uploaded.";

                // Insert the data into the database
                $sql = "INSERT INTO tbl_products (product_name, price, description, image, pharmacy_id) 
                        VALUES (:product_name, :price, :description, :image, :pharmacy_id)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':product_name' => $productName,
                    ':price' => $price,
                    ':description' => $description,
                    ':image' => $productImageName,
                    ':pharmacy_id' => $pharmacyID
                ]);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Fetch existing products for this pharmacy
    $productStmt = $conn->prepare("SELECT * FROM tbl_products WHERE pharmacy_id = :pharmacy_id");
    $productStmt->execute([':pharmacy_id' => $pharmacyID]);
    $products = $productStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Database error: " . htmlspecialchars($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pharmacy <?php echo htmlspecialchars($pharmacy['PharmacyName']); ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Dashboard - Pharmacy <?php echo htmlspecialchars($pharmacy['PharmacyName']); ?></h2>
    <form method="POST" action="dashboard.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control" id="product_name" name="product_name" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>

    <h3 class="mt-5">Available Products</h3>
    <ul class="list-group">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <li class="list-group-item">
                    <img src="../images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" style="width: 100px;">
                    <?php echo htmlspecialchars($product['product_name']); ?> - $<?php echo htmlspecialchars($product['price']); ?>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="list-group-item">No products available.</li>
        <?php endif; ?>
    </ul>
    <a href="logout.php" class="btn btn-secondary mt-3">Logout</a>
    <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
</div>
</body>
</html>
