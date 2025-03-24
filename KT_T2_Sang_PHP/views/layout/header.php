<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống đăng ký học phần</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-color: #1a75ff;
            --secondary-color: #004de6;
            --light-blue: #e6f0ff;
            --border-radius: 8px;
        }

        /* Navbar styling */
        .navbar {
            background-color: var(--primary-color) !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--light-blue) !important;
            transform: translateY(-2px);
        }

        /* Page content */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            padding: 20px;
        }

        /* Card styling */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
            padding: 15px 20px;
        }

        /* Button styling */
        .btn {
            border-radius: 5px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Table styling */
        .table {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table thead th {
            background: var(--light-blue);
            color: var(--secondary-color);
            border-bottom: 2px solid var(--primary-color);
            font-weight: 600;
        }

        .table tbody tr:hover {
            background-color: rgba(26, 117, 255, 0.05);
        }

        /* User info in navbar */
        .user-info {
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Active nav item */
        .nav-item.active .nav-link {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        /* Form styling */
        .form-control {
            border-radius: var(--border-radius);
            padding: 10px 15px;
            border: 1px solid #dee2e6;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(26, 117, 255, 0.25);
        }

        /* Image styling */
        .img-preview {
            border-radius: var(--border-radius);
            border: 2px solid #dee2e6;
            padding: 5px;
        }

        /* Alert styling */
        .alert {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Page header */
        .page-header {
            margin-bottom: 30px;
            border-bottom: 2px solid var(--light-blue);
            padding-bottom: 15px;
        }

        /* Action buttons */
        .action-buttons .btn {
            margin: 0 5px;
        }

        /* Stats card */
        .stats-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .stats-card h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        /* Điều chỉnh select box */
        .form-control {
            height: auto !important;
            padding: 8px 12px;
        }

        select.form-control {
            padding-right: 30px !important;
            /* Thêm khoảng trống cho mũi tên dropdown */
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        /* Tăng chiều cao cho option trong select */
        select.form-control option {
            padding: 8px 12px;
        }

        /* Đảm bảo select box hiển thị đầy đủ nội dung */
        .form-group select {
            width: 100%;
            min-height: 38px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-graduation-cap mr-2"></i>
                Đăng ký học phần
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php echo ($_GET['controller'] ?? '') == 'sinhvien' ? 'active' : ''; ?>">
                        <a class="nav-link" href="?controller=sinhvien">
                            <i class="fas fa-user-graduate mr-1"></i> Sinh Viên
                        </a>
                    </li>
                    <li class="nav-item <?php echo ($_GET['controller'] ?? '') == 'hocphan' ? 'active' : ''; ?>">
                        <a class="nav-link" href="?controller=hocphan">
                            <i class="fas fa-book mr-1"></i> Học Phần
                        </a>
                    </li>
                    <li class="nav-item <?php echo ($_GET['controller'] ?? '') == 'dangky' ? 'active' : ''; ?>">
                        <a class="nav-link" href="?controller=dangky&action=cart">
                            <i class="fas fa-shopping-cart mr-1"></i> Đăng Ký
                        </a>
                    </li>
                </ul>
                <?php if (isset($_SESSION['MaSV'])): ?>
                    <div class="user-info">
                        <i class="fas fa-user mr-1"></i>
                        <?php echo $_SESSION['HoTen'] ?? $_SESSION['MaSV']; ?>
                        <a href="?controller=auth&action=logout" class="btn btn-outline-light btn-sm ml-2">
                            <i class="fas fa-sign-out-alt"></i> Đăng xuất
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>