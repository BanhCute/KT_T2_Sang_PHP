<?php include 'views/layout/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-book mr-2"></i>Danh sách Học Phần</h2>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <h3>Tổng học phần</h3>
                <p class="h4 mb-0"><?php echo count($hocphans); ?></p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mã HP</th>
                            <th>Tên Học Phần</th>
                            <th>Số Tín Chỉ</th>
                            <th>Số lượng dự kiến</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hocphans as $hp): ?>
                            <tr>
                                <td><strong><?php echo $hp['MaHP']; ?></strong></td>
                                <td><?php echo $hp['TenHP']; ?></td>
                                <td>
                                    <span class="badge badge-primary">
                                        <?php echo $hp['SoTinChi']; ?> tín chỉ
                                    </span>
                                </td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <?php
                                        $percent = ($hp['SoLuongDuKien'] / 100) * 100;
                                        $colorClass = $percent > 50 ? 'bg-success' : ($percent > 20 ? 'bg-warning' : 'bg-danger');
                                        ?>
                                        <div class="progress-bar <?php echo $colorClass; ?>"
                                            role="progressbar"
                                            style="width: <?php echo $percent; ?>%"
                                            aria-valuenow="<?php echo $hp['SoLuongDuKien']; ?>"
                                            aria-valuemin="0"
                                            aria-valuemax="100">
                                            <?php echo $hp['SoLuongDuKien']; ?> slot
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($hp['SoLuongDuKien'] > 0): ?>
                                        <button onclick="window.location.href='?controller=dangky&action=add&mahp=<?php echo $hp['MaHP']; ?>'"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus-circle mr-1"></i>Đăng ký
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-secondary btn-sm" disabled>
                                            <i class="fas fa-ban mr-1"></i>Hết slot
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>