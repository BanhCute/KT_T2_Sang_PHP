<?php include 'views/layout/header.php'; ?>

<div class="container">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h2><i class="fas fa-user-graduate mr-2"></i>Danh sách Sinh viên</h2>
        <a href="?controller=sinhvien&action=create" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Thêm Sinh viên
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mã SV</th>
                            <th>Họ Tên</th>
                            <th>Giới Tính</th>
                            <th>Ngày Sinh</th>
                            <th>Hình</th>
                            <th>Ngành</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?php echo $row['MaSV']; ?></td>
                                <td><?php echo $row['HoTen']; ?></td>
                                <td>
                                    <span class="badge badge-<?php echo $row['GioiTinh'] == 'Nam' ? 'primary' : 'info'; ?>">
                                        <?php echo $row['GioiTinh']; ?>
                                    </span>
                                </td>
                                <td><?php echo date('d/m/Y', strtotime($row['NgaySinh'])); ?></td>
                                <td>
                                    <?php if ($row['Hinh']): ?>
                                        <img src="Content/images/<?php echo basename($row['Hinh']); ?>"
                                            class="img-thumbnail" style="max-width: 100px;">
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge badge-secondary"><?php echo $row['MaNganh']; ?></span></td>
                                <td class="action-buttons">
                                    <a href="?controller=sinhvien&action=detail&id=<?php echo $row['MaSV']; ?>"
                                        class="btn btn-info btn-sm" title="Chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="?controller=sinhvien&action=edit&id=<?php echo $row['MaSV']; ?>"
                                        class="btn btn-warning btn-sm" title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="?controller=sinhvien&action=delete&id=<?php echo $row['MaSV']; ?>"
                                        class="btn btn-danger btn-sm" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>