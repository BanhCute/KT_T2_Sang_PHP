<?php include 'views/layout/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-user-edit mr-2"></i>Sửa thông tin Sinh viên</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="?controller=sinhvien&action=edit&id=<?php echo $sinhvien['MaSV']; ?>"
                method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-id-card mr-2"></i>Mã sinh viên:</label>
                            <input type="text" class="form-control" name="MaSV"
                                value="<?php echo $sinhvien['MaSV']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-user mr-2"></i>Họ tên:</label>
                            <input type="text" class="form-control" name="HoTen"
                                value="<?php echo $sinhvien['HoTen']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-venus-mars mr-2"></i>Giới tính:</label>
                            <select class="form-control" name="GioiTinh">
                                <option value="Nam" <?php echo ($sinhvien['GioiTinh'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                                <option value="Nữ" <?php echo ($sinhvien['GioiTinh'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-calendar-alt mr-2"></i>Ngày sinh:</label>
                            <input type="date" class="form-control" name="NgaySinh"
                                value="<?php echo $sinhvien['NgaySinh']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-graduation-cap mr-2"></i>Ngành học:</label>
                            <select class="form-control" name="MaNganh">
                                <?php foreach ($nganhhoc_list as $nganh): ?>
                                    <option value="<?php echo $nganh['MaNganh']; ?>"
                                        <?php echo ($sinhvien['MaNganh'] == $nganh['MaNganh']) ? 'selected' : ''; ?>>
                                        <?php echo $nganh['TenNganh']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-image mr-2"></i>Hình ảnh:</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="Hinh" id="imageInput"
                            accept="image/*" onchange="previewImage(this);">
                        <label class="custom-file-label" for="imageInput">Chọn file mới...</label>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Hình ảnh hiện tại</h6>
                                </div>
                                <div class="card-body text-center">
                                    <?php if ($sinhvien['Hinh']): ?>
                                        <img src="Content/images/<?php echo basename($sinhvien['Hinh']); ?>"
                                            class="img-thumbnail" style="max-height: 200px;">
                                    <?php else: ?>
                                        <p class="text-muted mb-0">Chưa có hình ảnh</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Hình ảnh mới</h6>
                                </div>
                                <div class="card-body text-center">
                                    <img id="imagePreview" src="#" alt="Preview"
                                        class="img-thumbnail" style="max-height: 200px; display: none;">
                                    <p id="noNewImage" class="text-muted mb-0">Chưa chọn hình mới</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="current_image" value="<?php echo $sinhvien['Hinh']; ?>">
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save mr-2"></i>Cập nhật
                    </button>
                    <a href="?controller=sinhvien&action=index" class="btn btn-secondary px-4">
                        <i class="fas fa-arrow-left mr-2"></i>Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        var preview = document.getElementById('imagePreview');
        var noNewImage = document.getElementById('noNewImage');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                noNewImage.style.display = 'none';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
            noNewImage.style.display = 'block';
        }
    }
</script>

<?php include 'views/layout/footer.php'; ?>