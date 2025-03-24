<?php
require_once 'models/DangKy.php';
require_once 'models/HocPhan.php';
require_once 'models/SinhVien.php';
require_once 'config/database.php';

class DangKyController
{
    private $dangKy;
    private $hocPhan;
    private $sinhVien;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->dangKy = new DangKy($db);
        $this->hocPhan = new HocPhan($db);
        $this->sinhVien = new SinhVien($db);

        // Khởi tạo giỏ đăng ký nếu chưa có
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    }

    // Thêm học phần vào giỏ
    public function add()
    {
        if (isset($_GET['mahp'])) {
            $mahp = $_GET['mahp'];
            $hocphan = $this->hocPhan->getById($mahp);

            if ($hocphan) {
                // Kiểm tra nếu học phần chưa có trong giỏ
                if (!isset($_SESSION['cart'][$mahp])) {
                    $_SESSION['cart'][$mahp] = $hocphan;
                    $_SESSION['message'] = "Đã thêm học phần vào giỏ đăng ký";
                } else {
                    $_SESSION['message'] = "Học phần đã có trong giỏ đăng ký";
                }
            } else {
                $_SESSION['error'] = "Không tìm thấy học phần";
            }

            header("Location: index.php?controller=dangky&action=cart");
            exit();
        }
        header("Location: index.php?controller=hocphan&action=index");
        exit();
    }

    // Xóa một học phần khỏi giỏ
    public function remove()
    {
        if (isset($_GET['mahp'])) {
            $mahp = $_GET['mahp'];
            if (isset($_SESSION['cart'][$mahp])) {
                unset($_SESSION['cart'][$mahp]);
            }
        }
        header("Location: index.php?controller=dangky&action=cart");
        exit();
    }

    // Xóa toàn bộ giỏ đăng ký
    public function clear()
    {
        $_SESSION['cart'] = array();
        header("Location: index.php?controller=dangky&action=cart");
        exit();
    }

    // Hiển thị giỏ đăng ký
    public function cart()
    {
        $masv = $_SESSION['MaSV'];
        $dangky_cu = $this->dangKy->getRegisteredCourses($masv);
        $sinhvien = $this->sinhVien->getById($masv);

        // Hiển thị thông báo nếu có
        $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
        $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

        // Xóa thông báo sau khi hiển thị
        unset($_SESSION['message']);
        unset($_SESSION['error']);

        require_once 'views/dangky/cart.php';
    }

    // Lưu đăng ký vào database
    public function save()
    {
        if (count($_SESSION['cart']) > 0) {
            $masv = $_SESSION['MaSV'];
            $ngaydk = date('Y-m-d');

            try {
                // Tạo đăng ký mới
                $madk = $this->dangKy->create($masv, $ngaydk);

                if ($madk) {
                    // Thêm chi tiết đăng ký
                    foreach ($_SESSION['cart'] as $hp) {
                        $this->dangKy->addChiTiet($madk, $hp['MaHP']);
                    }

                    // Lưu thông tin đăng ký vào session để hiển thị kết quả
                    $_SESSION['last_registration'] = [
                        'MaDK' => $madk,
                        'NgayDK' => $ngaydk,
                        'MaSV' => $masv,
                        'HocPhan' => $_SESSION['cart']
                    ];

                    // Xóa giỏ sau khi lưu thành công
                    $_SESSION['cart'] = array();

                    header("Location: index.php?controller=dangky&action=success");
                    exit();
                }
            } catch (Exception $e) {
                $_SESSION['error'] = "Có lỗi xảy ra khi lưu đăng ký: " . $e->getMessage();
                header("Location: index.php?controller=dangky&action=cart");
                exit();
            }
        }
        header("Location: index.php?controller=dangky&action=cart");
        exit();
    }

    // Trang thông báo đăng ký thành công
    public function success()
    {
        if (!isset($_SESSION['last_registration'])) {
            header("Location: index.php?controller=dangky&action=cart");
            exit();
        }

        $registration = $_SESSION['last_registration'];
        $sinhvien = $this->sinhVien->getById($_SESSION['MaSV']);

        require_once 'views/dangky/success.php';
    }
}
