<?php
require_once 'NhanVien.php';

class NhanVienVanPhong extends NhanVien
{
    private $soNgayVang;

    public function __construct($hoTen, $ngaySinh, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $tangCa, $soNgayVang)
    {
        parent::__construct($hoTen, $ngaySinh, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $tangCa);
        $this->soNgayVang = $soNgayVang;
    }

    public function tinhLuong()
    {
        $luongChinh = $this->luongCoBan * $this->heSoLuong;
        $phuCapTangCa = $this->tangCa == 'co' ? 200000 : 0;
        return $luongChinh + $phuCapTangCa;
    }

    public function tinhThucLinh()
    {
        $tienPhat = max(0, $this->soNgayVang - 2) * 100000;
        return $this->tinhLuong() + $this->getTroCap() - $tienPhat;
    }
}
