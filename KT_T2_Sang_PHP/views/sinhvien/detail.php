<?php include 'views/layout/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-user-circle mr-2"></i>Thông tin chi tiết Sinh viên</h2>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Hồ sơ sinh viên</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <?php if (!empty($sinhvien['Hinh'])): ?>
                        <img src="Content/images/<?php echo basename($sinhvien['Hinh']); ?>"
                            class="img-thumbnail mb-3" style="max-width: 250px;">
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-image mr-2"></i>Không có hình ảnh
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <table class="table table-hover">
                        <tr>
                            <th width="30%"><i class="fas fa-id-card mr-2"></i>Mã sinh viên:</th>
                            <td><strong><?php echo $sinhvien['MaSV']; ?></strong></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-user mr-2"></i>Họ tên:</th>
                            <td><?php echo $sinhvien['HoTen']; ?></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-venus-mars mr-2"></i>Giới tính:</th>
                            <td>
                                <span class="badge badge-<?php echo $sinhvien['GioiTinh'] == 'Nam' ? 'primary' : 'info'; ?>">
                                    <?php echo $sinhvien['GioiTinh']; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-calendar-alt mr-2"></i>Ngày sinh:</th>
                            <td><?php echo date('d/m/Y', strtotime($sinhvien['NgaySinh'])); ?></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-graduation-cap mr-2"></i>Mã ngành:</th>
                            <td>
                                <span class="badge badge-secondary">
                                    <?php echo $sinhvien['MaNganh']; ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <a href="?action=edit&id=<?php echo $sinhvien['MaSV']; ?>" class="btn btn-warning px-4">
            <i class="fas fa-edit mr-2"></i>Sửa
        </a>
        <a href="?action=delete&id=<?php echo $sinhvien['MaSV']; ?>" class="btn btn-danger px-4">
            <i class="fas fa-trash-alt mr-2"></i>Xóa
        </a>
        <a href="?action=index" class="btn btn-secondary px-4">
            <i class="fas fa-arrow-left mr-2"></i>Quay lại
        </a>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>