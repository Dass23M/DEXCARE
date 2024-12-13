<?php
$connection = mysqli_connect('localhost', 'root', '', 'pharmacy_db');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM contactus ORDER BY created_at DESC";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        h1 {
            color: #0066cc;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #0066cc;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
        td {
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Contact Form Submissions</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Submitted At</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['message']) . "</td>
                        <td>" . $row['created_at'] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No submissions available</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
mysqli_close($connection);
?>
