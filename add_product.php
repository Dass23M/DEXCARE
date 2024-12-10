<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menuName = htmlspecialchars($_POST['menu_name']);
    $price = floatval($_POST['price']);
    $description = htmlspecialchars($_POST['description']);
    $menuImageName = $_FILES['image']['name'];
    $menuImageTmpName = $_FILES['image']['tmp_name'];

    $target_dir = "../images/";
    $target_file = $target_dir . basename($menuImageName);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($menuImageTmpName);
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
        if (move_uploaded_file($menuImageTmpName, $target_file)) {
            echo "The file " . htmlspecialchars(basename($menuImageName)) . " has been uploaded.";
            // Insert the data into the database
            $sql = "INSERT INTO tbl_menu (menu_name, price, description, image, pharmacy_id) 
                    VALUES (:menu_name, :price, :description, :image, :pharmacy_id)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':menu_name' => $menuName,
                ':price' => $price,
                ':description' => $description,
                ':image' => $menuImageName,
                ':pharmacy_id' => $_SESSION['pharmacy_id'] // assuming this is stored in session
            ]);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
