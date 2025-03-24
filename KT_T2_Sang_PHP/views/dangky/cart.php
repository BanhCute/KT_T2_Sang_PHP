<?php include 'views/layout/header.php'; ?>

<?php
// Ở đầu file hoặc trong controller
$sinhvien = $this->sinhVien->getById($_SESSION['MaSV']);
?>

<div class="container">
    <h2>Đăng Kí Học Phần</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show auto-hide">
            <?php echo $message; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show auto-hide">
            <?php echo $error; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                        <th>Số lượng còn lại</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tongTinChi = 0;
                    $soHocPhan = 0;
                    foreach ($_SESSION['cart'] as $hp):
                        $tongTinChi += $hp['SoTinChi'];
                        $soHocPhan++;
                    ?>
                        <tr>
                            <td><?php echo $hp['MaHP']; ?></td>
                            <td><?php echo $hp['TenHP']; ?></td>
                            <td><?php echo $hp['SoTinChi']; ?></td>
                            <td><?php echo $hp['SoLuongDuKien']; ?> slot</td>
                            <td>
                                <a href="?controller=dangky&action=remove&mahp=<?php echo $hp['MaHP']; ?>"
                                    class="btn btn-danger btn-sm">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-info">
                        <td colspan="3">
                            <strong>Số học phần: <?php echo $soHocPhan; ?></strong>
                        </td>
                        <td colspan="2">
                            <strong>Tổng số tín chỉ: <?php echo $tongTinChi; ?></strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="card mt-3 mb-3">
            <div class="card-body">
                <h5 class="card-title">Thông tin đăng ký</h5>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Mã sinh viên:</strong></td>
                                <td><?php echo isset($_SESSION['MaSV']) ? $_SESSION['MaSV'] : ''; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Họ tên:</strong></td>
                                <td><?php echo isset($_SESSION['HoTen']) ? $_SESSION['HoTen'] : ''; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Ngành học:</strong></td>
                                <td><?php echo isset($sinhvien['MaNganh']) ? $sinhvien['MaNganh'] : 'Chưa cập nhật'; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Ngày đăng ký:</strong></td>
                                <td><?php echo date('d/m/Y'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Số học phần:</strong></td>
                                <td><?php echo $soHocPhan; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tổng số tín chỉ:</strong></td>
                                <td><?php echo $tongTinChi; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="alert alert-warning">
                    <strong>Lưu ý:</strong>
                    <ul>
                        <li>Vui lòng kiểm tra kỹ thông tin trước khi xác nhận đăng ký</li>
                        <li>Sau khi xác nhận đăng ký, bạn không thể thay đổi thông tin</li>
                        <li>Số lượng slot còn lại của mỗi học phần có thể thay đổi</li>
                    </ul>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="?controller=hocphan&action=index" class="btn btn-secondary">Tiếp tục đăng ký</a>
                    <div>
                        <a href="?controller=dangky&action=clear" class="btn btn-danger">Xóa Đăng Ký</a>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">
                            Xác nhận đăng ký
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận đăng ký học phần</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc chắn muốn đăng ký các học phần này?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <a href="?controller=dangky&action=save" class="btn btn-primary">Xác nhận</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info permanent-alert">
            Chưa có học phần nào được chọn.
            <a href="?controller=hocphan&action=index">Quay lại đăng ký</a>
        </div>
    <?php endif; ?>

    <div class="mt-5">
        <h3>Các học phần đã đăng ký trước đó</h3>
        <?php if (!empty($dangky_cu)): ?>
            <?php foreach ($dangky_cu as $dk): ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Mã ĐK: <?php echo $dk['MaDK']; ?></h5>
                            <span>Ngày ĐK: <?php echo date('d/m/Y', strtotime($dk['NgayDK'])); ?></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Mã HP</th>
                                    <th>Tên Học Phần</th>
                                    <th>Số Tín Chỉ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tongTC = 0;
                                foreach ($dk['HocPhan'] as $hp):
                                    $tongTC += $hp['SoTinChi'];
                                ?>
                                    <tr>
                                        <td><?php echo $hp['MaHP']; ?></td>
                                        <td><?php echo $hp['TenHP']; ?></td>
                                        <td><?php echo $hp['SoTinChi']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table-info">
                                    <td colspan="2"><strong>Tổng số tín chỉ:</strong></td>
                                    <td><strong><?php echo $tongTC; ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info">
                Chưa có học phần nào được đăng ký trước đó.
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>