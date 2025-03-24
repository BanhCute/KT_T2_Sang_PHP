    <footer class="bg-dark text-light mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6">
                    <h5>Hệ thống đăng ký học phần</h5>
                    <p class="mb-0">© <?php echo date('Y'); ?> Bản quyền thuộc về Trường Đại học</p>
                </div>
                <div class="col-md-6 text-md-right">
                    <div class="social-links">
                        <a href="#" class="text-light mr-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-light mr-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Chỉ ẩn các alert có class auto-hide
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert.auto-hide").fadeOut("slow");
            }, 3000);
        });

        // Thêm animation cho các nút
        $('.btn').hover(
            function() {
                $(this).addClass('shadow-sm');
            },
            function() {
                $(this).removeClass('shadow-sm');
            }
        );
    </script>
    </body>

    </html>