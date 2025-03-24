<?php
class HocPhan
{
    private $conn;
    private $table_name = "HocPhan";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($mahp)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $mahp);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
