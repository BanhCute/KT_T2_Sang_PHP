<?php
session_start();
require_once 'models/NhanVienVanPhong.php';
require_once 'models/NhanVienSanXuat.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    $_SESSION['ketQua'] = [
        'tienLuong' => $nv->tinhLuong(),
        'troCap' => $nv->getTroCap(),
        'thucLinh' => $nv->tinhThucLinh(),
        'loaiNV' => $loaiNV
    ];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Quản lý Nhân viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: #4a5568;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .form-content {
            padding: 20px;
            background: #f8f9fa;
        }

        .form-row {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .form-group {
            flex: 1;
            margin-right: 20px;
        }

        .form-group:last-child {
            margin-right: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #4a5568;
            font-weight: 500;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .radio-group {
            display: flex;
            gap: 15px;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .radio-group input[type="radio"] {
            margin-right: 5px;
        }

        .result-group {
            background: white;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }

        .result-group input[type="text"] {
            background: #f8f9fa;
        }

        .btn-tinh-luong {
            background: #4a5568;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 200px;
            margin: 20px auto;
            display: block;
            font-size: 16px;
        }

        .btn-tinh-luong:hover {
            background: #2d3748;
        }

        .currency-suffix {
            color: #718096;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">QUẢN LÝ NHÂN VIÊN</div>
        <div class="form-content">
            <form method="post" id="employeeForm">
                <div class="form-row">
                    <div class="form-group">
                        <label>Họ và tên:</label>
                        <input type="text" name="hoTen" value="<?php echo isset($_POST['hoTen']) ? $_POST['hoTen'] : 'Trần Tuấn Anh'; ?>">
                    </div>
                    <div class="form-group">
                        <label>Số con:</label>
                        <input type="text" name="soCon" value="<?php echo isset($_POST['soCon']) ? $_POST['soCon'] : '3'; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Ngày sinh:</label>
                        <input type="text" name="ngaySinh" value="<?php echo isset($_POST['ngaySinh']) ? $_POST['ngaySinh'] : '10/10/1986'; ?>">
                    </div>
                    <div class="form-group">
                        <label>Ngày vào làm:</label>
                        <input type="text" name="ngayVaoLam" value="<?php echo isset($_POST['ngayVaoLam']) ? $_POST['ngayVaoLam'] : '20/11/2010'; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Giới tính:</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="gioiTinh" value="Nam" <?php echo (!isset($_POST['gioiTinh']) || $_POST['gioiTinh'] == 'Nam') ? 'checked' : ''; ?>> Nam
                            </label>
                            <label>
                                <input type="radio" name="gioiTinh" value="Nữ" <?php echo (isset($_POST['gioiTinh']) && $_POST['gioiTinh'] == 'Nữ') ? 'checked' : ''; ?>> Nữ
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Hệ số lương:</label>
                        <input type="text" name="heSoLuong" value="<?php echo isset($_POST['heSoLuong']) ? $_POST['heSoLuong'] : '3.33'; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Loại nhân viên:</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="loaiNV" value="vanphong" <?php echo (!isset($_POST['loaiNV']) || $_POST['loaiNV'] == 'vanphong') ? 'checked' : ''; ?>> Văn phòng
                            </label>
                            <label>
                                <input type="radio" name="loaiNV" value="sanxuat" <?php echo (isset($_POST['loaiNV']) && $_POST['loaiNV'] == 'sanxuat') ? 'checked' : ''; ?>> Sản xuất
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-row" id="vanphong-info" <?php echo (isset($_POST['loaiNV']) && $_POST['loaiNV'] == 'sanxuat') ? 'style="display:none;"' : ''; ?>>
                    <div class="form-group">
                        <label>Số ngày vắng:</label>
                        <input type="text" name="soNgayVang" value="<?php echo isset($_POST['soNgayVang']) ? $_POST['soNgayVang'] : '1'; ?>">
                    </div>
                </div>

                <div class="form-row" id="sanxuat-info" <?php echo (!isset($_POST['loaiNV']) || $_POST['loaiNV'] == 'vanphong') ? 'style="display:none;"' : ''; ?>>
                    <div class="form-group">
                        <label>Số sản phẩm:</label>
                        <input type="text" name="soSanPham" value="<?php echo isset($_POST['soSanPham']) ? $_POST['soSanPham'] : ''; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tăng ca:</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="tangCa" value="co" <?php echo (isset($_POST['tangCa']) && $_POST['tangCa'] == 'co') ? 'checked' : ''; ?>> Có
                            </label>
                            <label>
                                <input type="radio" name="tangCa" value="khong" <?php echo (!isset($_POST['tangCa']) || $_POST['tangCa'] == 'khong') ? 'checked' : ''; ?>> Không
                            </label>
                        </div>
                    </div>
                </div>

                <div class="result-group">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Tiền lương:</label>
                            <input type="text" name="tienLuong" value="<?php echo isset($_SESSION['ketQua']) ? number_format($_SESSION['ketQua']['tienLuong']) : ''; ?>">
                            <span class="currency-suffix">đồng</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Trợ cấp:</label>
                            <input type="text" name="troCap" value="<?php echo isset($_SESSION['ketQua']) ? number_format($_SESSION['ketQua']['troCap']) : ''; ?>">
                            <span class="currency-suffix">đồng</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Thực lĩnh:</label>
                            <input type="text" name="thucLinh" readonly value="<?php echo isset($_SESSION['ketQua']) ? number_format($_SESSION['ketQua']['thucLinh']) : ''; ?>">
                            <span class="currency-suffix">đồng</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-tinh-luong">Tính lương</button>
            </form>
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