<?php
require_once 'models/SinhVien.php';
require_once 'config/database.php';

class SinhVienController
{
    private $sinhVien;
    private $db;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->sinhVien = new SinhVien($db);
    }

    public function index()
    {
        $result = $this->sinhVien->getAll();
        require_once 'views/sinhvien/index.php';
    }

    private function uploadImage($file)
    {
        $target_dir = "Content/images/";

        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Lấy phần mở rộng của file
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

        // Tạo tên file mới để tránh trùng lặp
        $newFileName = "sv_" . time() . "." . $imageFileType;
        $target_file = $target_dir . $newFileName;

        // Kiểm tra định dạng file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return false;
        }

        // Upload file
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file; // Trả về đường dẫn tương đối không cần dấu / ở đầu
        }

        return false;
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Xử lý upload ảnh
            $imagePath = "";
            if (isset($_FILES["Hinh"]) && $_FILES["Hinh"]["error"] == 0) {
                $imagePath = $this->uploadImage($_FILES["Hinh"]);
                if ($imagePath === false) {
                    echo "Lỗi upload file. Chỉ chấp nhận file JPG, JPEG hoặc PNG.";
                    return;
                }
            }

            // Gán dữ liệu cho model
            $this->sinhVien->MaSV = $_POST['MaSV'];
            $this->sinhVien->HoTen = $_POST['HoTen'];
            $this->sinhVien->GioiTinh = $_POST['GioiTinh'];
            $this->sinhVien->NgaySinh = $_POST['NgaySinh'];
            $this->sinhVien->Hinh = $imagePath;
            $this->sinhVien->MaNganh = $_POST['MaNganh'];

            if ($this->sinhVien->create()) {
                header("Location: index.php?controller=sinhvien&action=index");
                exit();
            } else {
                echo "Có lỗi xảy ra khi thêm sinh viên";
            }
        }
        require_once 'views/sinhvien/create.php';
    }

    public function edit()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Xử lý upload ảnh mới nếu có
                $imagePath = $_POST['current_image']; // Giữ ảnh cũ
                if (isset($_FILES["Hinh"]) && $_FILES["Hinh"]["error"] == 0) {
                    $newImagePath = $this->uploadImage($_FILES["Hinh"]);
                    if ($newImagePath !== false) {
                        // Xóa ảnh cũ nếu tồn tại
                        if (file_exists(ltrim($_POST['current_image'], "/"))) {
                            unlink(ltrim($_POST['current_image'], "/"));
                        }
                        $imagePath = $newImagePath;
                    }
                }

                // Cập nhật thông tin sinh viên
                $this->sinhVien->MaSV = $id;
                $this->sinhVien->HoTen = $_POST['HoTen'];
                $this->sinhVien->GioiTinh = $_POST['GioiTinh'];
                $this->sinhVien->NgaySinh = $_POST['NgaySinh'];
                $this->sinhVien->Hinh = $imagePath;
                $this->sinhVien->MaNganh = $_POST['MaNganh'];

                if ($this->sinhVien->update()) {
                    header("Location: index.php?controller=sinhvien&action=index");
                    exit();
                }
            }

            $sinhvien = $this->sinhVien->getById($id);
            // Lấy danh sách ngành học
            $nganhhoc_list = $this->sinhVien->getAllNganh();

            if ($sinhvien) {
                require_once 'views/sinhvien/edit.php';
            } else {
                header("Location: index.php?controller=sinhvien&action=index");
                exit();
            }
        }
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sinhvien = $this->sinhVien->getById($id);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Nếu người dùng đã xác nhận xóa
                if (isset($_POST['confirm_delete'])) {
                    // Xóa file ảnh nếu có
                    if (!empty($sinhvien['Hinh']) && file_exists($sinhvien['Hinh'])) {
                        unlink($sinhvien['Hinh']);
                    }

                    if ($this->sinhVien->delete($id)) {
                        header("Location: index.php?controller=sinhvien&action=index");
                        exit();
                    } else {
                        echo "Có lỗi xảy ra khi xóa sinh viên";
                    }
                } else {
                    // Nếu không xác nhận, quay về trang danh sách
                    header("Location: index.php?controller=sinhvien&action=index");
                    exit();
                }
            }

            // Hiển thị form xác nhận xóa
            require_once 'views/sinhvien/delete.php';
        } else {
            header("Location: index.php?controller=sinhvien&action=index");
            exit();
        }
    }

    public function detail()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sinhvien = $this->sinhVien->getById($id);

            if ($sinhvien) {
                require_once 'views/sinhvien/detail.php';
            } else {
                header("Location: index.php?controller=sinhvien&action=index");
                exit();
            }
        } else {
            header("Location: index.php?controller=sinhvien&action=index");
            exit();
        }
    }

    // Thêm các action khác (edit, delete, detail)...
}
