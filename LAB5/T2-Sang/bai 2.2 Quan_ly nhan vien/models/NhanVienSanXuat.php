<?php
require_once 'NhanVien.php';

class NhanVienSanXuat extends NhanVien
{
    private $soSanPham;

    public function __construct($hoTen, $ngaySinh, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $tangCa, $soSanPham)
    {
        parent::__construct($hoTen, $ngaySinh, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $tangCa);
        $this->soSanPham = $soSanPham;
    }

    public function tinhLuong()
    {
        $luongChinh = $this->luongCoBan * $this->heSoLuong;
        $phuCapTangCa = $this->tangCa == 'co' ? 200000 : 0;
        $tienSanPham = $this->soSanPham * 100000;
        return $luongChinh + $phuCapTangCa + $tienSanPham;
    }

    public function tinhThucLinh()
    {
        return $this->tinhLuong() + $this->getTroCap();
    }
}
