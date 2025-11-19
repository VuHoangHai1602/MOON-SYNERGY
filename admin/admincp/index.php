<?php

session_start();
if(!isset($_SESSION['dangnhap'])){
    header('Location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminCP</title>
    <link rel="stylesheet" href="../admincp/css/style1.css">
</head>
<body>

<header class="admin_header">
    <h2>Admin Control Panel</h2>
</header>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <?php
            if(isset($_GET['dangxuat']) && $_GET['dangxuat']==1){
                unset($_SESSION['dangnhap']);
                header('Location:login.php');
            }
        ?>
        <ul>
            
            <li><a href="index.php?action=quanlydanhmucsanpham&query=them">Quản lý danh mục</a></li>
            <li><a href="index.php?action=quanlysp&query=them">Quản lý sản phẩm</a></li>
            <li><a href="index.php?action=quanlitaikhoan&query=lietke">Quản lý tài khoản</a></li>
            <li><a href ="index.php?dangxuat=1">Đăng xuất</a></li>
        </ul>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="content">
        <?php
            include("config/config.php");
            include("modules/main.php");
            
        ?>
    </main>

</div>

</body>
</html>
