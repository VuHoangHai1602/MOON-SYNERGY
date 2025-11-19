<?php
session_start();
include('../admincp/config/config.php');

if(isset($_POST['dangky'])){
// Đảm bảo trim() cho cả email, tên và mật khẩu
    $tenkhachhang = trim($_POST['hovaten']);
    $dienthoai    = trim($_POST['dienthoai']);
    $email        = trim($_POST['email']);
    
    // Mã hóa mật khẩu sau khi đã trim
    $matkhau      = md5(trim($_POST['matkhau']));
    // LƯU Ý QUAN TRỌNG: Mã này vẫn dễ bị tấn công SQL Injection.
    // Nên sử dụng PreparedStatement (mysqli_stmt_prepare) để bảo mật hơn.
    $sql_dangky = mysqli_query($mysqli,"INSERT INTO tbl_dangky(hovaten,email,dienthoai,matkhau) VALUES ('$tenkhachhang','$email','$dienthoai','$matkhau')") ;

    if($sql_dangky){
        // Lưu thông báo và email vào session
        $_SESSION['dangky_thanhcong'] = true;
        $_SESSION['email_moi_dangky'] = $email; 
        
        // Chuyển hướng đến trang đăng nhập
        header("Location:login.php");
        exit(); // Thoát để đảm bảo không có code nào được thực thi sau header
    } else {
        echo '<p style="color:red">Đăng ký thất bại. Vui lòng thử lại.</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moon Synergy - Đăng ký</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/stylesLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="transition-all duration-300" id="mainBody">

    <!-- Header -->
    <header class="header bg-sky-950">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="img/Logo.png" alt="Logo">
                </div>
                <button class="mobile-menu-btn text-white" onclick="toggleMobileMenu()">
                    <i class="material-icons">menu</i>
                </button>
                <nav class="nav" id="mobileNav">
                    <a href="../index.php" class="nav-link text-white">
                        <i class="material-icons">home</i>
                        <span>Trang chủ</span>
                    </a>
                    <a href="menu.php" class="nav-link text-white">
                        <i class="material-icons">restaurant_menu</i>
                        <span>Sản phẩm</span>
                    </a>
                    <a href="stores.php" class="nav-link text-white">
                        <i class="material-icons">store</i>
                        <span>Cửa hàng</span>
                    </a>
                    <a href="about.php" class="nav-link text-white">
                        <i class="material-icons">info</i>
                        <span>Về chúng tôi</span>
                    </a>
                </nav>
                <div class="header-actions">
                    <div class="search-box">
                        <input type="text" placeholder="Tìm kiếm...">
                        <button class="search-btn"><i class="material-icons">search</i></button>
                    </div>
                    <button class="search-toggle-btn text-white" onclick="toggleSearch()">
                        <i class="material-icons">search</i>
                    </button>
                </div>
            </div>
            <div class="mobile-search" id="mobileSearch">
                <input type="text" placeholder="Tìm kiếm sản phẩm...">
                <button class="search-btn"><i class="material-icons">search</i></button>
            </div>
        </div>
    </header>
    <!-- REGISTER WRAPPER -->
    <div class="container-login">
        <div class="login-card">
            <h2>Đăng ký</h2>

            <form action ="" method="POST">
                <label>Họ và tên</label>
                <input type="text" name="hovaten" placeholder="Nhập họ và tên..." required>

                <label>Email</label>
                <input type="email" name="email" placeholder="Nhập email..." required>

                <label>Số điện thoại</label>
                <input type="tel" name="dienthoai" placeholder="Nhập số điện thoại..." required>

                <label>Mật khẩu</label>
                <input type="password" name="matkhau" placeholder="Nhập mật khẩu..." required>

                <label>Nhập lại mật khẩu</label>
                <input type="password" placeholder="Xác nhận mật khẩu..." required>

                <button type="submit" name="dangky" class="btn-login">Đăng ký</button>

                <p class="signup">
                    Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>
