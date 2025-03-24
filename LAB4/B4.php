<?php
$uploadDir = 'uploads/';
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'application/pdf'];
$maxFileSize = 5 * 1024 * 1024; // 5MB

// Kiểm tra và tạo thư mục uploads nếu chưa tồn tại
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true); // Tạo thư mục với quyền 0755
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadedFiles = $_FILES['files'];
    $fileCount = count($uploadedFiles['name']);
    $uploadStatus = [];

    for ($i = 0; $i < $fileCount; $i++) {
        $fileName = $uploadedFiles['name'][$i];
        $fileTmpName = $uploadedFiles['tmp_name'][$i];
        $fileSize = $uploadedFiles['size'][$i];
        $fileType = $uploadedFiles['type'][$i];

        // Kiểm tra loại file
        if (!in_array($fileType, $allowedTypes)) {
            $uploadStatus[] = "$fileName: Loại file không hợp lệ. Vui lòng chọn file hình ảnh hoặc PDF.";
            continue;
        }

        // Kiểm tra kích thước file
        if ($fileSize > $maxFileSize) {
            $uploadStatus[] = "$fileName: Kích thước file vượt quá 5MB. Vui lòng chọn file nhỏ hơn.";
            continue;
        }

        // Đổi tên file
        $newFileName = uniqid() . '-' . basename($fileName);
        $uploadFilePath = $uploadDir . $newFileName;

        // Di chuyển file vào thư mục uploads
        if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
            $uploadStatus[] = "$fileName: Upload thành công. ";
        } else {
            $uploadStatus[] = "$fileName: Upload thất bại.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #e0f7fa;
            /* Màu nền xanh nước biển nhạt */
            padding: 20px;
        }

        h1 {
            color: #00796b;
            /* Màu xanh nước biển đậm */
            text-align: center;
            margin-bottom: 20px;
        }

        .upload-form {
            background: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            max-width: 500px;
        }

        .status-list {
            margin-top: 20px;
        }

        .status-list li {
            font-size: large;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            margin: 10px 0;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        .status-list li img {
            max-width: 200px;
            margin-right: 10px;
        }

        .status-list li a {
            color: #007bff;
            text-decoration: none;
            flex-grow: 1;
        }

        .status-list li a:hover {
            text-decoration: underline;
        }

        button {
            background-color: #00796b;
            /* Màu xanh nước biển đậm */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #004d40;
            /* Màu xanh nước biển tối hơn khi hover */
        }
    </style>
</head>

<body>
    <h1><i class="fas fa-upload"></i> Upload File</h1>
    <div class="upload-form">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" name="files[]" multiple required class="form-control-file">
            </div>
            <button type="submit" class="btn btn-success btn-block">
                <i class="fas fa-cloud-upload-alt"></i> Upload
            </button>
        </form>
    </div>

    <?php if (isset($uploadStatus)): ?>
        <h2 class="text-center">Kết quả upload:</h2>
        <ul class="status-list list-unstyled">
            <?php foreach ($uploadStatus as $status): ?>
                <li><?php echo $status; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <h2 class="text-center">Danh sách file đã upload:</h2>
    <ul class="status-list list-unstyled">
        <?php
        $files = scandir($uploadDir);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $filePath = $uploadDir . $file;
                $fileType = mime_content_type($filePath);
                if (strpos($fileType, 'image') !== false) {
                    echo "<li><img src='$filePath' alt='$file'> $file</li>";
                } elseif ($fileType === 'application/pdf') {
                    echo "<li><i class='fas fa-file-pdf'></i> <a href='$filePath' target='_blank'>$file</a></li>";
                } else {
                    echo "<li>$file</li>";
                }
            }
        }
        ?>
    </ul>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>