<?php
class DangKy
{
    private $conn;
    private $table_name = "DangKy";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($masv, $ngaydk)
    {
        try {
            $this->conn->beginTransaction();

            $query = "INSERT INTO DangKy(MaSV, NgayDK) VALUES(?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $masv);
            $stmt->bindParam(2, $ngaydk);

            if ($stmt->execute()) {
                $madk = $this->conn->lastInsertId();
                $this->conn->commit();
                return $madk;
            }

            $this->conn->rollBack();
            return false;
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    public function addChiTiet($madk, $mahp)
    {
        try {
            $this->conn->beginTransaction();

            // Kiểm tra và cập nhật số lượng
            $checkQuery = "SELECT SoLuongDuKien FROM HocPhan WHERE MaHP = ?";
            $stmt = $this->conn->prepare($checkQuery);
            $stmt->bindParam(1, $mahp);
            $stmt->execute();
            $soluong = $stmt->fetchColumn();

            if ($soluong <= 0) {
                throw new Exception("Học phần đã hết slot đăng ký");
            }

            // Giảm số lượng
            $updateQuery = "UPDATE HocPhan SET SoLuongDuKien = SoLuongDuKien - 1 WHERE MaHP = ?";
            $stmt = $this->conn->prepare($updateQuery);
            $stmt->bindParam(1, $mahp);
            $stmt->execute();

            // Thêm chi tiết đăng ký
            $query = "INSERT INTO ChiTietDangKy(MaDK, MaHP) VALUES(?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $madk);
            $stmt->bindParam(2, $mahp);
            $result = $stmt->execute();

            if ($result) {
                $this->conn->commit();
                return true;
            }

            $this->conn->rollBack();
            return false;
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    public function getRegisteredCourses($masv)
    {
        try {
            $query = "SELECT dk.MaDK, dk.NgayDK, hp.MaHP, hp.TenHP, hp.SoTinChi 
                    FROM DangKy dk 
                    INNER JOIN ChiTietDangKy ctdk ON dk.MaDK = ctdk.MaDK 
                    INNER JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP 
                    WHERE dk.MaSV = ? 
                    ORDER BY dk.NgayDK DESC, dk.MaDK DESC";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $masv);
            $stmt->execute();

            $result = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $madk = $row['MaDK'];
                if (!isset($result[$madk])) {
                    $result[$madk] = array(
                        'MaDK' => $madk,
                        'NgayDK' => $row['NgayDK'],
                        'HocPhan' => array()
                    );
                }
                $result[$madk]['HocPhan'][] = array(
                    'MaHP' => $row['MaHP'],
                    'TenHP' => $row['TenHP'],
                    'SoTinChi' => $row['SoTinChi']
                );
            }

            return $result;
        } catch (PDOException $e) {
            return array();
        }
    }
}
