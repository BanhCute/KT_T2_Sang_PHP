<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "lab6";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->database",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Kết nối thất bại: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    // Thêm nhân viên mới
    public function themNhanVien($data)
    {
        try {
            $sql = "INSERT INTO nhanvien (
                hoTen, ngaySinh, gioiTinh, ngayVaoLam, 
                heSoLuong, soCon, loaiNV, tangCa, 
                soNgayVang, soSanPham, tienLuong, 
                troCap, thucLinh
            ) VALUES (
                :hoTen, :ngaySinh, :gioiTinh, :ngayVaoLam, 
                :heSoLuong, :soCon, :loaiNV, :tangCa, 
                :soNgayVang, :soSanPham, :tienLuong, 
                :troCap, :thucLinh
            )";

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($data);
        } catch (PDOException $e) {
            echo "Lỗi thêm nhân viên: " . $e->getMessage();
            return false;
        }
    }

    // Lấy danh sách nhân viên
    public function layDanhSachNhanVien()
    {
        try {
            $sql = "SELECT * FROM nhanvien ORDER BY created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi lấy danh sách: " . $e->getMessage();
            return [];
        }
    }

    // Xóa nhân viên
    public function xoaNhanVien($id)
    {
        try {
            $sql = "DELETE FROM nhanvien WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            echo "Lỗi xóa nhân viên: " . $e->getMessage();
            return false;
        }
    }

    // Cập nhật nhân viên
    public function capNhatNhanVien($id, $data)
    {
        try {
            $sql = "UPDATE nhanvien SET 
                hoTen = :hoTen,
                ngaySinh = :ngaySinh,
                gioiTinh = :gioiTinh,
                ngayVaoLam = :ngayVaoLam,
                heSoLuong = :heSoLuong,
                soCon = :soCon,
                loaiNV = :loaiNV,
                tangCa = :tangCa,
                soNgayVang = :soNgayVang,
                soSanPham = :soSanPham,
                tienLuong = :tienLuong,
                troCap = :troCap,
                thucLinh = :thucLinh
                WHERE id = :id";

            $data['id'] = $id;
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($data);
        } catch (PDOException $e) {
            echo "Lỗi cập nhật nhân viên: " . $e->getMessage();
            return false;
        }
    }
}

// Test kết nối
$db = new Database();
