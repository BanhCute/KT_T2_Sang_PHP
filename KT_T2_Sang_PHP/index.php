<?php
session_start();
require_once 'controllers/SinhVienController.php';
require_once 'controllers/HocPhanController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/DangKyController.php';


// Lấy controller từ URL, mặc định là 'sinhvien'
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'sinhvien';

// Lấy action từ URL, mặc định là 'index'
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Kiểm tra đăng nhập cho các trang cần bảo vệ
if (!isset($_SESSION['MaSV']) && $controller != 'auth') {
    header("Location: index.php?controller=auth&action=login");
    exit();
}

// Khởi tạo controller tương ứng
switch ($controller) {
    case 'sinhvien':
        $controller = new SinhVienController();
        // Xử lý các action của SinhVienController
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'create':
                $controller->create();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->delete();
                break;
            case 'detail':
                $controller->detail();
                break;
            default:
                $controller->index();
                break;
        }
        break;

    case 'hocphan':
        $controller = new HocPhanController();
        // Xử lý các action của HocPhanController
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            default:
                $controller->index();
                break;
        }
        break;

    case 'auth':
        $controller = new AuthController();
        switch ($action) {
            case 'login':
                $controller->login();
                break;
            case 'logout':
                $controller->logout();
                break;
            default:
                $controller->login();
                break;
        }


        break;

    case 'dangky':
        $controller = new DangKyController();
        switch ($action) {
            case 'add':
                $controller->add();
                break;
            case 'remove':
                $controller->remove();
                break;
            case 'clear':
                $controller->clear();
                break;
            case 'cart':
                $controller->cart();
                break;
            case 'save':
                $controller->save();
                break;
            case 'success':
                $controller->success();
                break;
            default:
                $controller->cart();
                break;
        }
        break;


    default:
        // Mặc định sẽ dùng SinhVienController
        $controller = new SinhVienController();
        $controller->index();
        break;
}
