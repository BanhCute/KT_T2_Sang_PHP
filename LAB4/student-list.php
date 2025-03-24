<?php
session_start();
require 'students.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$students = getStudents();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
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

        h2,
        h3 {
            color: #00796b;
            /* Màu xanh biển */
        }

        .btn-primary {
            background-color: #00796b;
            /* Màu nút chính */
            border: none;
        }

        .btn-primary:hover {
            background-color: #004d40;
            /* Màu nút khi hover */
        }

        .btn-danger {
            background-color: #d32f2f;
            /* Màu nút xóa */
            border: none;
        }

        .btn-danger:hover {
            background-color: #b71c1c;
            /* Màu nút xóa khi hover */
        }
    </style>
</head>

<body>
    <div class="container p-4">
        <h2 class="text-center">Chào mừng <?php echo $_SESSION['username']; ?></h2>
        <h3 class="text-center">Danh sách sinh viên</h3>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo $student['fullname']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td>
                            <a href="student-delete.php?id=<?php echo $student['id']; ?>" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-center">
            <a href="student-add.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm sinh viên
            </a>
            <a href="logout.php" class="btn btn-secondary">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>