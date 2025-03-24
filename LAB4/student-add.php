<?php
session_start();
require 'students.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    addStudent($fullname, $email);
    header('Location: student-list.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e0f7fa;
            /* Màu nền nước biển */
        }

        .container {
            margin-top: 50px;
            background-color: #ffffff;
            /* Màu nền trắng cho container */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container p-4">
        <h2 class="text-center">Thêm sinh viên</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="fullname">Họ và tên:</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">
                <i class="fas fa-plus"></i> Thêm
            </button>
        </form>
        <a href="student-list.php" class="btn btn-secondary mt-2">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>
</body>

</html>