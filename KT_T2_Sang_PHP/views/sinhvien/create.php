<?php include 'views/layout/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-user-plus mr-2"></i>Thêm Sinh viên mới</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="?controller=sinhvien&action=create" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-id-card mr-2"></i>Mã sinh viên:</label>
                            <input type="text" class="form-control" name="MaSV" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-user mr-2"></i>Họ tên:</label>
                            <input type="text" class="form-control" name="HoTen" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-venus-mars mr-2"></i>Giới tính:</label>
                            <select class="form-control" name="GioiTinh">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-calendar-alt mr-2"></i>Ngày sinh:</label>
                            <input type="date" class="form-control" name="NgaySinh" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-graduation-cap mr-2"></i>Ngành học:</label>
                            <select class="form-control" name="MaNganh">
                                <option value="CNTT">Công nghệ thông tin</option>
                                <option value="QTKD">Quản trị kinh doanh</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-image mr-2"></i>Hình ảnh:</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="Hinh" id="imageInput" accept="image/*" onchange="previewImage(this);">
                        <label class="custom-file-label" for="imageInput">Chọn file...</label>
                    </div>
                    <div class="mt-3">
                        <img id="imagePreview" src="#" alt="Preview" class="img-thumbnail" style="max-width: 200px; display: none;">
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save mr-2"></i>Lưu
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
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>

<?php include 'views/layout/footer.php'; ?>