<?php
session_start();
require 'students.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteStudent($id);
}

header('Location: student-list.php');
exit();
