<?php
class SinhVien
{
    private $conn;
    private $table_name = "SinhVien";

    public $MaSV;
    public $HoTen;
    public $GioiTinh;
    public $NgaySinh;
    public $Hinh;
    public $MaNganh;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT sv.*, nh.TenNganh 
                 FROM " . $this->table_name . " sv
                 LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
                SET MaSV=:MaSV, HoTen=:HoTen, GioiTinh=:GioiTinh, 
                    NgaySinh=:NgaySinh, Hinh=:Hinh, MaNganh=:MaNganh";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":MaSV", $this->MaSV);
        $stmt->bindParam(":HoTen", $this->HoTen);
        $stmt->bindParam(":GioiTinh", $this->GioiTinh);
        $stmt->bindParam(":NgaySinh", $this->NgaySinh);
        $stmt->bindParam(":Hinh", $this->Hinh);
        $stmt->bindParam(":MaNganh", $this->MaNganh);

        return $stmt->execute();
    }

    public function getById($masv)
    {
        try {
            $query = "SELECT sv.*, nh.TenNganh 
                      FROM SinhVien sv 
                      LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
                      WHERE sv.MaSV = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $masv);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . "
                SET HoTen = :HoTen,
                    GioiTinh = :GioiTinh,
                    NgaySinh = :NgaySinh,
                    Hinh = :Hinh,
                    MaNganh = :MaNganh
                WHERE MaSV = :MaSV";

        $stmt = $this->conn->prepare($query);

        // Bind các giá trị
        $stmt->bindParam(":MaSV", $this->MaSV);
        $stmt->bindParam(":HoTen", $this->HoTen);
        $stmt->bindParam(":GioiTinh", $this->GioiTinh);
        $stmt->bindParam(":NgaySinh", $this->NgaySinh);
        $stmt->bindParam(":Hinh", $this->Hinh);
        $stmt->bindParam(":MaNganh", $this->MaNganh);

        return $stmt->execute();
    }

    public function delete($id)
    {
        // Kiểm tra xem có dữ liệu liên quan trong bảng DangKy không
        $query = "SELECT COUNT(*) as count FROM DangKy WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            return false; // Không thể xóa vì có dữ liệu liên quan
        }

        // Nếu không có dữ liệu liên quan, tiến hành xóa
        $query = "DELETE FROM " . $this->table_name . " WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);

        return $stmt->execute();
    }

    public function getNganhHoc($maNganh)
    {
        $query = "SELECT * FROM NganhHoc WHERE MaNganh = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $maNganh);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllNganh()
    {
        $query = "SELECT * FROM NganhHoc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm các phương thức khác (update, delete, getById)...
}
