<?php include 'views/layout/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="text-center">ĐĂNG NHẬP</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form action="?controller=auth&action=login" method="POST">
                        <div class="form-group">
                            <label for="MaSV">Mã sinh viên:</label>
                            <input type="text" class="form-control" id="MaSV" name="MaSV"
                                required placeholder="Nhập mã sinh viên">
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="?controller=sinhvien&action=index" class="text-decoration-none">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>