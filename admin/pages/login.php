<?php
session_start();
// Đảm bảo đường dẫn này là chính xác
include('../admincp/config/config.php'); 

$thongbao = '';

// --- XỬ LÝ ĐĂNG NHẬP ---
if(isset($_POST['dangnhap'])){
    $email = trim($_POST['email']);
    $matkhau = md5(trim($_POST['matkhau']));
    // Mã hóa mật khẩu sau khi đã loại bỏ khoảng trắng

    $sql_dangnhap = "SELECT * FROM tbl_dangky WHERE email='".$email."' AND matkhau='".$matkhau."' LIMIT 1";
    $row_dangnhap = mysqli_query($mysqli, $sql_dangnhap);
    $count = mysqli_num_rows($row_dangnhap);

    if($count > 0){
        $row_data = mysqli_fetch_array($row_dangnhap);
        $_SESSION['dangky'] = $row_data['hovaten']; // <-- Dùng tên này trong index.php
        $_SESSION['id_khachhang'] = $row_data['id_dangky'];
        // Chuyển hướng đến trang chủ hoặc trang sau khi đăng nhập thành công
        header("Location:../index.php"); 
        exit();
    } else {
        $thongbao = '<p style="color:red; text-align:center;">Sai Email hoặc Mật khẩu. Vui lòng thử lại.</p>';
    }
}


// --- KIỂM TRA THÔNG BÁO ĐĂNG KÝ THÀNH CÔNG ---
$email_tu_dangky = '';
if(isset($_SESSION['dangky_thanhcong'])){
    $thongbao = '<p style="color:green; text-align:center;">Đăng ký thành công! Vui lòng Đăng nhập để tiếp tục.</p>';
    // Nếu bạn muốn tự động điền email của tài khoản vừa đăng ký
    if (isset($_SESSION['email_moi_dangky'])) {
        $email_tu_dangky = $_SESSION['email_moi_dangky'];
    }

    // Xóa session thông báo để không hiển thị lại sau khi reload
    unset($_SESSION['dangky_thanhcong']);
    unset($_SESSION['email_moi_dangky']);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moon Synergy - Login</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/stylesLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="transition-all duration-300" id="mainBody">
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
                    <a href="../index.php" class="nav-link active text-white">
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

    <div class="container-login">
        <div class="login-card">
            <h2>Đăng nhập</h2>
            
            <?php echo $thongbao; ?> <form action="" method="POST"> <label>Email</label>
                <input type="email" name="email" placeholder="Nhập email..." value="<?php echo htmlspecialchars($email_tu_dangky); ?>" required>

                <label>Mật khẩu</label>
                <input type="password" name="matkhau" placeholder="Nhập mật khẩu..." required> <button type="submit" name="dangnhap" class="btn-login">Đăng nhập</button> <p class="signup">
                    Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>