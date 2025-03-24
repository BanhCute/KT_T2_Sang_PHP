<?php
abstract class NhanVien
{
    protected $hoTen;
    protected $ngaySinh;
    protected $gioiTinh;
    protected $ngayVaoLam;
    protected $heSoLuong;
    protected $soCon;
    protected $luongCoBan = 1500000;
    protected $tangCa;

    public function __construct($hoTen, $ngaySinh, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $tangCa)
    {
        $this->hoTen = $hoTen;
        $this->ngaySinh = $ngaySinh;
        $this->gioiTinh = $gioiTinh;
        $this->ngayVaoLam = $ngayVaoLam;
        $this->heSoLuong = $heSoLuong;
        $this->soCon = $soCon;
        $this->tangCa = $tangCa;
    }

    public function getTroCap()
    {
        return $this->soCon * 200000;
    }

    abstract public function tinhLuong();
    abstract public function tinhThucLinh();
}
