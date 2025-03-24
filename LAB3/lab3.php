<?php
// lab3.php

// Khởi tạo biến để kiểm tra xem có hiển thị kết quả hay không
$show_result = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy điểm từ form
    $diem_toan = (float)$_POST['toan'];
    $diem_ly = (float)$_POST['ly'];
    $diem_hoa = (float)$_POST['hoa'];
    $khu_vuc = $_POST['khu_vuc'];

    // Tính tổng điểm
    $tong_diem = $diem_toan + $diem_ly + $diem_hoa;

    // Cộng điểm ưu tiên theo khu vực
    switch ($khu_vuc) {
        case 'KV1':
        case 'KV2':
            $tong_diem += 5; // Cộng 5 điểm cho KV1 và KV2
            break;
        case 'KV3':
            $tong_diem += 3; // Cộng 3 điểm cho KV3
            break;
        default:
            break; // KV4 không được cộng điểm
    }

    // Xếp loại
    if ($tong_diem >= 27) {
        $xep_loai = "Xuất sắc";
    } elseif ($tong_diem >= 24) {
        $xep_loai = "Giỏi";
    } elseif ($tong_diem >= 21) {
        $xep_loai = "Khá";
    } else {
        $xep_loai = "Trung bình";
    }

    // Đánh dấu để hiển thị kết quả
    $show_result = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xếp loại kết quả tuyển sinh</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        label {
            display: inline-block;
            width: 150px;
            margin-bottom: 10px;
            color: #34495e;
        }

        input[type="text"],
        select {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        h2 {
            color: #2c3e50;
            margin-top: 30px;
        }

        .ket-qua {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post">    
            <h1>Điểm thi tuyển sinh</h1>
            <div>
                <label for="toan">Điểm môn Toán:</label>
                <input type="text" id="toan" name="toan" required
                    value="<?php echo isset($_POST['toan']) ? $_POST['toan'] : ''; ?>">
            </div>
            <div>
                <label for="ly">Điểm môn Lý:</label>
                <input type="text" id="ly" name="ly" required
                    value="<?php echo isset($_POST['ly']) ? $_POST['ly'] : ''; ?>">
            </div>
            <div>
                <label for="hoa">Điểm môn Hóa:</label>
                <input type="text" id="hoa" name="hoa" required
                    value="<?php echo isset($_POST['hoa']) ? $_POST['hoa'] : ''; ?>">
            </div>
            <div>
                <label for="khu_vuc">Chọn khu vực:</label>
                <select id="khu_vuc" name="khu_vuc">
                    <option value="KV1" <?php echo (isset($_POST['khu_vuc']) && $_POST['khu_vuc'] == 'KV1') ? 'selected' : ''; ?>>Khu vực 1</option>
                    <option value="KV2" <?php echo (isset($_POST['khu_vuc']) && $_POST['khu_vuc'] == 'KV2') ? 'selected' : ''; ?>>Khu vực 2</option>
                    <option value="KV3" <?php echo (isset($_POST['khu_vuc']) && $_POST['khu_vuc'] == 'KV3') ? 'selected' : ''; ?>>Khu vực 3</option>
                    <option value="KV4" <?php echo (isset($_POST['khu_vuc']) && $_POST['khu_vuc'] == 'KV4') ? 'selected' : ''; ?>>Khu vực 4</option>
                </select>
            </div>
            <input type="submit" value="Xếp loại">
        </form>

        <?php if ($show_result): ?>
            <div class="ket-qua">
                <h2>Kết quả xếp loại</h2>
                <p>Tổng điểm: <?php echo $tong_diem; ?></p>
                <p>Xếp loại: <?php echo $xep_loai; ?></p>
                <p>Điểm ưu tiên: <?php echo $tong_diem - ($diem_toan + $diem_ly + $diem_hoa); ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>