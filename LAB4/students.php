<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Danh sách sinh viên (sử dụng session để lưu trữ)
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [
        ['id' => 1, 'fullname' => 'Nguyen van A', 'email' => 'Tructhach@gmail.com'],
        ['id' => 2, 'fullname' => 'Nguyen van B', 'email' => 'Tructhach@gmail.com'],
        ['id' => 3, 'fullname' => 'Nguyen Van C', 'email' => 'Tructhach@gmail.com'],
    ];
}

// Hàm thêm sinh viên
function addStudent($fullname, $email)
{
    $student = [
        'id' => count($_SESSION['students']) + 1,
        'fullname' => $fullname,
        'email' => $email,
    ];
    $_SESSION['students'][] = $student;
}

// Hàm xóa sinh viên
function deleteStudent($id)
{
    foreach ($_SESSION['students'] as $key => $student) {
        if ($student['id'] == $id) {
            unset($_SESSION['students'][$key]);
            break;
        }
    }
}

// Hàm lấy danh sách sinh viên
function getStudents()
{
    return $_SESSION['students'];
}
