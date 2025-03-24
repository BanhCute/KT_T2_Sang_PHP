<?php include 'views/layout/header.php'; ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Đăng ký học phần thành công!</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Thông tin sinh viên</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Mã sinh viên:</strong></td>
                            <td><?php echo $sinhvien['MaSV']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Họ tên:</strong></td>
                            <td><?php echo $sinhvien['HoTen']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Ngành học:</strong></td>
                            <td><?php echo isset($sinhvien['CNTT']) ? 'Công nghệ thông tin' : 'Chưa cập nhật'; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Thông tin đăng ký</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Mã đăng ký:</strong></td>
                            <td><?php echo $registration['MaDK']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Ngày đăng ký:</strong></td>
                            <td><?php echo date('d/m/Y', strtotime($registration['NgayDK'])); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <h5 class="mt-4">Danh sách học phần đã đăng ký</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã HP</th>
                            <th>Tên Học Phần</th>
                            <th>Số Tín Chỉ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tongTinChi = 0;
                        foreach ($registration['HocPhan'] as $hp):
                            $tongTinChi += $hp['SoTinChi'];
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
                            <td><strong><?php echo $tongTinChi; ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-4 text-center">
                <a href="?controller=hocphan&action=index" class="btn btn-primary">Tiếp tục đăng ký</a>
                <a href="?controller=dangky&action=cart" class="btn btn-secondary">Xem giỏ đăng ký</a>
            </div>
        </div>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>