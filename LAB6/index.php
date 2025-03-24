<?php
// Kết nối MySQL bằng mysqli
$mysqli = new mysqli("localhost", "root", "", "lab6");

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Set charset là utf8
$mysqli->set_charset("utf8");

// Lấy danh sách sản phẩm
$sql = "SELECT * FROM product";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .product-image {
            max-width: 200px;
            height: auto;
            margin-bottom: 10px;
        }

        .product-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .product-price {
            color: #e44d26;
            font-size: 1.1em;
        }

        h1 {
            text-align: center;
            color: #333;
        }
    </style>
</head>

<body>
    <h1>Danh sách sản phẩm</h1>

    <div class="product-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product-card'>";
                echo "<img src='images/" . $row['image'] . "' alt='" . $row['name'] . "' class='product-image'>";
                echo "<div class='product-name'>" . $row['name'] . "</div>";
                echo "<div class='product-price'>" . number_format($row['price'], 0, ',', '.') . " VNĐ</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Không có sản phẩm nào.</p>";
        }
        ?>
    </div>

    <?php
    // Đóng kết nối
    $mysqli->close();
    ?>
</body>

</html>