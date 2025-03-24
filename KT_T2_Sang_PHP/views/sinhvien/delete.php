<?php include 'views/layout/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-user-times mr-2"></i>Xác nhận xóa Sinh viên</h2>
    </div>

    <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <strong>Cảnh báo:</strong> Bạn có chắc chắn muốn xóa sinh viên này? Hành động này không thể hoàn tác!
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Thông tin sinh viên</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <?php if ($sinhvien['Hinh']): ?>
                        <img src="Content/images/<?php echo basename($sinhvien['Hinh']); ?>"
                            class="img-thumbnail mb-3" style="max-width: 200px;">
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%"><i class="fas fa-id-card mr-2"></i>Mã sinh viên:</th>
                            <td><?php echo $sinhvien['MaSV']; ?></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-user mr-2"></i>Họ tên:</th>
                            <td><?php echo $sinhvien['HoTen']; ?></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-venus-mars mr-2"></i>Giới tính:</th>
                            <td><?php echo $sinhvien['GioiTinh']; ?></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-calendar-alt mr-2"></i>Ngày sinh:</th>
                            <td><?php echo date('d/m/Y', strtotime($sinhvien['NgaySinh'])); ?></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-graduation-cap mr-2"></i>Mã ngành:</th>
                            <td><?php echo $sinhvien['MaNganh']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form action="?action=delete&id=<?php echo $sinhvien['MaSV']; ?>" method="POST" class="mt-4 text-center">
        <button type="submit" class="btn btn-danger btn-lg px-4" name="confirm_delete">
            <i class="fas fa-trash-alt mr-2"></i>Xác nhận xóa
        </button>
        <a href="?action=index" class="btn btn-secondary btn-lg px-4">
            <i class="fas fa-times mr-2"></i>Hủy
        </a>
    </form>
</div>

<?php include 'views/layout/footer.php'; ?>