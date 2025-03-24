<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập
    if ($username === 'baoanh' && $password === '123') {
        $_SESSION['username'] = $username;
        header('Location: student-list.php'); // Chuyển hướng đến trang danh sách sinh viên
        exit();
    } else {
        $error = "Tài khoản hoặc mật khẩu không đúng.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e0f7fa;
        }

        .container {
            margin-top: 100px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container p-4">
        <h2 class="text-center">Đăng nhập</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Tài khoản:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger mt-2"><?php echo $error; ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>