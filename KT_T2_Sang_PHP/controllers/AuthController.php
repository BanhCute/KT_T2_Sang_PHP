<?php
require_once 'models/SinhVien.php';
require_once 'config/database.php';

class AuthController
{
    private $sinhVien;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->sinhVien = new SinhVien($db);
    }

    public function login()
    {
        // Nếu đã đăng nhập thì chuyển đến trang chủ
        if (isset($_SESSION['MaSV'])) {
            header("Location: index.php?controller=sinhvien&action=index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $masv = isset($_POST['MaSV']) ? $_POST['MaSV'] : '';

            // Kiểm tra sinh viên có tồn tại
            $sinhvien = $this->sinhVien->getById($masv);

            if ($sinhvien) {
                // Lưu thông tin vào session
                session_start();
                $_SESSION['MaSV'] = $sinhvien['MaSV'];
                $_SESSION['HoTen'] = $sinhvien['HoTen'];

                // Chuyển đến trang chủ
                header("Location: index.php?controller=sinhvien&action=index");
                exit();
            } else {
                $error = "Mã sinh viên không tồn tại!";
                require_once 'views/auth/login.php';
            }
        } else {
            require_once 'views/auth/login.php';
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit();
    }
}
