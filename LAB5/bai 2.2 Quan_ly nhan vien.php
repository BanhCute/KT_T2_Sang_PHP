<?php
// Lớp Nhân viên (lớp cha)
class NhanVien
{
    protected $hoTen;
    protected $ngaySinh;
    protected $gioiTinh;
    protected $ngayVaoLam;
    protected $heSoLuong;
    protected $soCon;
    protected $luongCoBan = 1500000;
    protected $tienTroCap;
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
        $this->tienTroCap = $soCon * 200000;
    }

    public function tinhLuong()
    {
        $luongChinh = $this->luongCoBan * $this->heSoLuong;
        $phuCapTangCa = $this->tangCa == 'co' ? 200000 : 0;
        return $luongChinh + $phuCapTangCa;
    }

    // Thêm getter cho tienTroCap
    public function getTroCap()
    {
        return $this->tienTroCap;
    }
}

// Lớp Nhân viên văn phòng
class NhanVienVanPhong extends NhanVien
{
    private $soNgayVang;
    private $dmVang = 2;
    private $tienPhatVang = 100000;

    public function __construct($hoTen, $ngaySinh, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $tangCa, $soNgayVang)
    {
        parent::__construct($hoTen, $ngaySinh, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $tangCa);
        $this->soNgayVang = $soNgayVang;
    }

    public function tinhTienPhat()
    {
        $ngayVangVuotDM = max(0, $this->soNgayVang - $this->dmVang);
        return $ngayVangVuotDM * $this->tienPhatVang;
    }

    public function tinhThucLinh()
    {
        return $this->tinhLuong() + $this->getTroCap() - $this->tinhTienPhat();
    }
}

// Lớp Nhân viên sản xuất
class NhanVienSanXuat extends NhanVien
{
    private $soSanPham;
    private $donGiaSP = 100000;

    public function __construct($hoTen, $ngaySinh, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $tangCa, $soSanPham)
    {
        parent::__construct($hoTen, $ngaySinh, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $tangCa);
        $this->soSanPham = $soSanPham;
    }

    public function tinhLuong()
    {
        $luongChinh = parent::tinhLuong();
        $tienSanPham = $this->soSanPham * $this->donGiaSP;
        return $luongChinh + $tienSanPham;
    }

    public function tinhThucLinh()
    {
        return $this->tinhLuong() + $this->getTroCap();
    }
}

// Xử lý form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoTen = $_POST['hoTen'];
    $ngaySinh = $_POST['ngaySinh'];
    $gioiTinh = $_POST['gioiTinh'];
    $ngayVaoLam = $_POST['ngayVaoLam'];
    $heSoLuong = floatval($_POST['heSoLuong']);
    $soCon = intval($_POST['soCon']);
    $tangCa = $_POST['tangCa'];
    $loaiNV = $_POST['loaiNV'];

    if ($loaiNV == 'vanphong') {
        $soNgayVang = intval($_POST['soNgayVang']);
        $nv = new NhanVienVanPhong($hoTen, $ngaySinh, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $tangCa, $soNgayVang);
    } else {
        $soSanPham = intval($_POST['soSanPham']);
        $nv = new NhanVienSanXuat($hoTen, $ngaySinh, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $tangCa, $soSanPham);
    }

    $tienLuong = $nv->tinhLuong();
    $troCap = $nv->getTroCap();
    $thucLinh = $nv->tinhThucLinh();

    // Cập nhật giá trị vào form
    echo "<script>
        document.getElementsByName('tienLuong')[0].value = '" . number_format($tienLuong) . "';
        document.getElementsByName('troCap')[0].value = '" . number_format($troCap) . "';
        document.getElementsByName('thucLinh')[0].value = '" . number_format($thucLinh) . "';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Nhân viên</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
        }

        .form-container {
            border: 2px solid #4a5568;
            border-radius: 5px;
        }

        .form-header {
            background-color: #4a5568;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }

        .form-content {
            padding: 20px;
            background-color: #e8eef7;
        }

        .form-row {
            display: flex;
            margin-bottom: 10px;
        }

        .form-group {
            flex: 1;
            padding: 0 10px;
        }

        .radio-group {
            display: flex;
            gap: 15px;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"] {
            background-color: white;
            border: 1px solid #ced4da;
        }

        .btn-tinh-luong {
            width: 120px;
            margin: 10px auto;
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                QUẢN LÝ NHÂN VIÊN
            </div>
            <div class="form-content">
                <form method="post" action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Họ và tên:</label>
                            <input type="text" name="hoTen" class="form-control" value="Trần Tuấn Anh">
                        </div>
                        <div class="form-group">
                            <label>Số con:</label>
                            <input type="text" name="soCon" class="form-control" value="3">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Ngày sinh:</label>
                            <input type="text" name="ngaySinh" class="form-control" value="10/10/1986">
                        </div>
                        <div class="form-group">
                            <label>Ngày vào làm:</label>
                            <input type="text" name="ngayVaoLam" class="form-control" value="20/11/2010">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Giới tính:</label>
                            <div class="radio-group">
                                <div>
                                    <input type="radio" name="gioiTinh" value="Nam" checked> Nam
                                </div>
                                <div>
                                    <input type="radio" name="gioiTinh" value="Nữ"> Nữ
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Hệ số lương:</label>
                            <input type="text" name="heSoLuong" class="form-control" value="3.33">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Loại nhân viên:</label>
                            <div class="radio-group">
                                <div>
                                    <input type="radio" name="loaiNV" value="vanphong" checked> Văn phòng
                                </div>
                                <div>
                                    <input type="radio" name="loaiNV" value="sanxuat"> Sản xuất
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group" id="vanphong-info">
                            <label>Số ngày vắng:</label>
                            <input type="text" name="soNgayVang" class="form-control" value="1">
                        </div>
                        <div class="form-group" id="sanxuat-info" style="display:none;">
                            <label>Số sản phẩm:</label>
                            <input type="text" name="soSanPham" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tăng ca:</label>
                            <div class="radio-group">
                                <div>
                                    <input type="radio" name="tangCa" value="co"> Có
                                </div>
                                <div>
                                    <input type="radio" name="tangCa" value="khong" checked> Không
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Tiền lương:</label>
                            <input type="text" name="tienLuong" class="form-control" value="4,995,000">
                            <small class="text-muted">đồng</small>
                        </div>
                        <div class="form-group">
                            <label>Trợ cấp:</label>
                            <input type="text" name="troCap" class="form-control" value="600,000">
                            <small class="text-muted">đồng</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Thực lĩnh:</label>
                            <input type="text" name="thucLinh" class="form-control" readonly>
                            <small class="text-muted">đồng</small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-tinh-luong">Tính lương</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementsByName('loaiNV').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('vanphong-info').style.display =
                    this.value === 'vanphong' ? 'block' : 'none';
                document.getElementById('sanxuat-info').style.display =
                    this.value === 'sanxuat' ? 'block' : 'none';
            });
        });
    </script>
</body>

</html>