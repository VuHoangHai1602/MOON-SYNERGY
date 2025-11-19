<?php
// Bắt đầu session để lưu trữ trạng thái đăng nhập
session_start();

// Xử lý Đăng xuất
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();    // Xóa tất cả biến session
    session_destroy(); // Hủy session
    header('Location: index.php'); // Quay lại trang chủ
    exit();
}

// KIỂM TRA TRẠNG THÁI ĐĂNG NHẬP DỰA TRÊN TÊN SESSION TỪ LOGIN.PHP
// Tên session đúng là 'dangky' (đã thấy trong code login.php của bạn)
$isLoggedIn = isset($_SESSION['dangky']);
$username = $isLoggedIn ? $_SESSION['dangky'] : '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moon Synergy</title>
    <link rel="stylesheet" href="css/style.css">
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
                    <img src="pages/img/Logo.png" alt="Logo">
                </div>
                <button class="mobile-menu-btn text-white" onclick="toggleMobileMenu()">
                    <i class="material-icons">menu</i>
                </button>
                <nav class="nav" id="mobileNav">
                    <a href="index.php" class="nav-link active text-white">
                        <i class="material-icons">home</i>
                        <span>Trang chủ</span>
                    </a>
                    <a href="pages/menu.php" class="nav-link text-white">
                        <i class="material-icons">restaurant_menu</i>
                        <span>Sản phẩm</span>
                    </a>
                    <a href="pages/stores.php" class="nav-link text-white">
                        <i class="material-icons">store</i>
                        <span>Cửa hàng</span>
                    </a>
                    <a href="pages/about.php" class="nav-link text-white">
                        <i class="material-icons">info</i>
                        <span>Về chúng tôi</span>
                    </a>
                </nav>
                <div class="header-actions">
                    <div class="search-box">
                        <input type="text" placeholder="Tìm kiếm...">
                        <button class="search-btn"><i class="material-icons">search</i></button>
                    </div>

                    <!-- User Icon với Popup -->
                    <div class="user-wrapper">
                    <div class="user-icon" id="userIcon">
        <?php echo $isLoggedIn ? htmlspecialchars($username) : '👤'; ?>
    </div>
    <div class="popup" id="userPopup">
        <?php if ($isLoggedIn): ?>
            <a href="index.php?action=logout">Đăng xuất</a>
        <?php else: ?>
            <a href="pages/login.php">Login</a>
            <a href="pages/register.php">Register</a>
        <?php endif; ?>
    </div>
</div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-slider">
            <div class="hero-slide active">
                <img src="pages/img/qua-tang-ban-gai_3_.jpg" alt="Banner 1">
            </div>
            <div class="hero-slide">
                <img src="pages/img/quasinhnhat.jpg" alt="Banner 2">
            </div>
            <div class="hero-slide">
                <img src="pages/img/meothantai.jpg" alt="Banner 3">
            </div>
            <div class="hero-slide">
                <img src="pages/img/banner-qua-tang-20-10.jpg" alt="Banner 4">
            </div>
        </div>
        <div class="slider-controls">
            <button class="prev-btn" onclick="changeSlide(-1)">‹</button>
            <button class="next-btn" onclick="changeSlide(1)">›</button>
        </div>
        <div class="slider-dots">
            <span class="dot active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
            <span class="dot" onclick="currentSlide(6)"></span>
        </div>
    </section>

    <!-- Menu Categories -->
    <section class="menu-categories bg-sky-50">
        <div class="container">
            <h2 class="section-title animate-slide-up">Thực đơn</h2>
            <div class="category-grid">
                <div class="category-card animate-scale-in hover-lift" style="animation-delay: 0.2s;">
                    <img src="pages/img/bong_tai_doi_buom_1_.jpg" alt="Trang Sức">
                    <h3 class="animate-slide-left" style="animation-delay: 0.4s;">Trà Sức</h3>
                    <p class="animate-slide-left" style="animation-delay: 0.6s;">Dành cho phái đẹp</p>
                </div>
                <div class="category-card animate-scale-in hover-lift" style="animation-delay: 0.4s;">
                    <img src="pages/img/gau_bong_1.jpg" alt="Gấu Bông">
                    <h3 class="animate-slide-right" style="animation-delay: 0.6s;">Gấu Bông</h3>
                    <p class="animate-slide-right" style="animation-delay: 0.8s;">Tình yêu dễ thương</p>
                </div>
                <div class="category-card animate-scale-in hover-lift" style="animation-delay: 0.6s;">
                    <img src="pages/img/tui-coi-no-ren-vintage-1.jpg" alt="Túi">
                    <h3 class="animate-slide-left" style="animation-delay: 0.8s;">Túi</h3>
                    <p class="animate-slide-left" style="animation-delay: 1s;">Dễ thương, thuận tiện</p>
                </div>
                <div class="category-card animate-scale-in hover-lift" style="animation-delay: 0.8s;">
                    <img src="pages/img/hop-nhac-pha-le-piano_3_.png" alt="Sản phẩm đặc biệt">
                    <h3 class="animate-slide-right" style="animation-delay: 1s;">Sản phẩm đặc biệt</h3>
                    <p class="animate-slide-right" style="animation-delay: 1.2s;">Phiên bản giới hạn</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section bg-white">
        <div class="container">
            <div class="about-content">
                <div class="about-text animate-slide-left">
                    <h2 class="section-title animate-zoom-in">Về Moon Synergy</h2>
                    <p class="about-description animate-slide-up" style="animation-delay: 0.3s;">Moon Synergy được thành lập để có thể giải quyết những vấn đề mà bao người thường hay mắc phải đó là nên tặng gì cho người hình yêu.</p>
                    <div class="about-stats">
                        <div class="stat-item animate-bounce-up" style="animation-delay: 0.5s;">
                            <h3 class="animate-zoom-in" style="animation-delay: 0.7s;">50+</h3>
                            <p class="animate-slide-up" style="animation-delay: 0.9s;">Cửa hàng</p>
                        </div>
                        <div class="stat-item animate-bounce-up" style="animation-delay: 0.7s;">
                            <h3 class="animate-zoom-in" style="animation-delay: 0.9s;">1M+</h3>
                            <p class="animate-slide-up" style="animation-delay: 1.1s;">Khách hàng</p>
                        </div>
                        <div class="stat-item animate-bounce-up" style="animation-delay: 0.9s;">
                            <h3 class="animate-zoom-in" style="animation-delay: 1.1s;">100+</h3>
                            <p class="animate-slide-up" style="animation-delay: 1.3s;">Sản phẩm</p>
                        </div>
                    </div>
                    <a href="about.html" class="about-btn animate__animated animate__fadeInUp animate__delay-4s">Tìm hiểu thêm</a>
                </div>
                <div class="columns-3xs animate__animated animate__fadeInRight ...">
                    <img class="aspect-3/2 hover:animate__pulse ..." src="https://katinat.vn/wp-content/uploads/2024/04/about-us-1024x1024.jpeg" />
                    <img class="aspect-square hover:animate__pulse ..." src="https://katinat.vn/wp-content/uploads/2023/12/z4954237620148_8ce7483a89041061967e58482debee67.jpg" />
                    <img class="aspect-square hover:animate__pulse ..." src="https://katinat.vn/wp-content/uploads/2024/04/365428055_274844375244430_8459792611511768501_n.jpeg" />
                    <!-- ... -->
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products bg-sky-950">
        <div class="container">
            <h2 class="section-title text-white" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8); font-weight: 800; color: #ffffff !important;">Sản phẩm nổi bật</h2>
            <div class="product-grid">
                <div class="product-card special-edition animate-flip-in hover-scale" style="animation-delay: 0.2s;">
                    <img src="pages/img/hop_nhac_dan_piano_go_5_.jpg" alt="Hộp Nhạc Piano">
                    <div class="product-info">
                        <h4 class="animate-slide-left" style="animation-delay: 0.4s;">Hộp Nhạc Piano</h4>
                        <p class="description animate-slide-up" style="animation-delay: 0.6s;">Hương vị đậm đà của Robusta Buôn Mê Thuột</p>
                        <p class="price animate-zoom-in" style="animation-delay: 0.8s;">45.000đ</p>
                        <button class="add-to-cart hover-glow animate-bounce-up" style="animation-delay: 1s;" onclick="addToCart('Cà Phê Phin Mê', 45000)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="product-card special-edition">
                    <img src="pages/img/g_u_3.jpg" alt="Gấu bông tốt nghiệp">
                    <div class="product-info">
                        <h4>Gấu bông tốt nghiệp</h4>
                        <p class="description">Vị dịu nhẹ của matcha hòa quyện với tàu hủ mịn mượt</p>
                        <p class="price">65.000đ</p>
                        <button class="add-to-cart" onclick="addToCart('Iki Matcha Tàu Hủ', 65000)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="product-card special-edition">
                    <img src="pages/img/day_chuyen_bac_bong_tuyet_2_.jpg" alt="dây chuyền bạc bông tuyết">
                    <div class="product-info">
                        <h4>dây chuyền bạc bông tuyết</h4>
                        <p class="description">Kết hợp khoai môn nghiền mịn, sữa dừa non ngọt thanh</p>
                        <p class="price">58.000đ</p>
                        <button class="add-to-cart" onclick="addToCart('Taro Coco', 58000)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="product-card special-edition">
                    <img src="ơages/img/tui-dung-do-hinh-sweet-cat_1.jpg" alt="Túi Hình Con Mèo">
                    <div class="product-info">
                        <h4>Túi Hình Con Mèo<span class="limited-badge">Phiên bản giới hạn</span></h4>
                        <p class="description">Phiên bản giới hạn mừng Tết Ất Tỵ 2025</p>
                        <p class="price">85.000đ</p>
                        <button class="add-to-cart" onclick="addToCart('Ly Như Ý', 85000)">Thêm vào giỏ</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section bg-sky-100">
        <div class="container">
            <h2 class="section-title animate__animated animate__fadeInUp">Sản phẩm mới nhất</h2>
            <div class="news-grid">
                <div class="product-card special-edition animate-flip-in hover-scale" style="animation-delay: 0.2s;">
                    <img src="pages/img/tui-dung-my-pham_4_.jpg" alt="Túi Đựng Mỹ Phẩm">
                    <div class="product-info">
                        <h4 class="animate-slide-left" style="animation-delay: 0.4s;">Túi Đựng Mỹ Phẩm</h4>
                        <p class="description animate-slide-up" style="animation-delay: 0.6s;">Hương vị đậm đà của Robusta Buôn Mê Thuột</p>
                        <p class="price animate-zoom-in" style="animation-delay: 0.8s;">45.000đ</p>
                        <button class="add-to-cart hover-glow animate-bounce-up" style="animation-delay: 1s;" onclick="addToCart('Túi Đựng Mỹ Phẩm', 45000)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="product-card special-edition animate-flip-in hover-scale" style="animation-delay: 0.2s;">
                    <img src="pages/img/hop_nhac_dan_piano_go_dang_dung_1_.jpg" alt="Hộp nhạc piano gỗ dạng đứng">
                    <div class="product-info">
                        <h4 class="animate-slide-left" style="animation-delay: 0.4s;">Hộp nhạc piano gỗ dạng đứng</h4>
                        <p class="description animate-slide-up" style="animation-delay: 0.6s;">Hương vị đậm đà của Robusta Buôn Mê Thuột</p>
                        <p class="price animate-zoom-in" style="animation-delay: 0.8s;">45.000đ</p>
                        <button class="add-to-cart hover-glow animate-bounce-up" style="animation-delay: 1s;" onclick="addToCart('Hộp nhạc piano gỗ dạng đứng', 45000)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="product-card special-edition animate-flip-in hover-scale" style="animation-delay: 0.2s;">
                    <img src="pages/img/gau_bong_1.jpg" alt="Gấu Bông">
                    <div class="product-info">
                        <h4 class="animate-slide-left" style="animation-delay: 0.4s;">Gấu Bông</h4>
                        <p class="description animate-slide-up" style="animation-delay: 0.6s;">Hương vị đậm đà của Robusta Buôn Mê Thuột</p>
                        <p class="price animate-zoom-in" style="animation-delay: 0.8s;">45.000đ</p>
                        <button class="add-to-cart hover-glow animate-bounce-up" style="animation-delay: 1s;" onclick="addToCart('Gấu Bông', 45000)">Thêm vào giỏ</button>
                    </div>
                </div>
                <div class="product-card special-edition animate-flip-in hover-scale" style="animation-delay: 0.2s;">
                    <img src="pages/img/day-chuyen-bac-chu-meo-nghich-ngom-5_1.jpg" alt="Dây Chuyền Chú Mèo Nghịch Ngợm">
                    <div class="product-info">
                        <h4 class="animate-slide-left" style="animation-delay: 0.4s;">Dây Chuyền Chú Mèo Nghịch Ngợm</h4>
                        <p class="description animate-slide-up" style="animation-delay: 0.6s;">Hương vị đậm đà của Robusta Buôn Mê Thuột</p>
                        <p class="price animate-zoom-in" style="animation-delay: 0.8s;">45.000đ</p>
                        <button class="add-to-cart hover-glow animate-bounce-up" style="animation-delay: 1s;" onclick="addToCart('Dây Chuyền Chú Mèo Nghịch Ngợm', 45000)">Thêm vào giỏ</button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="menu.html" class="btn-primary animate-glow hover-bounce" style="animation-delay: 1.5s;">Xem tất cả sản phẩm</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Về Moon Synergy</h4>
                    <ul>
                        <li><a href="about.html">Giới thiệu</a></li>
                        <li><a href="#">Tuyển dụng</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Sản phẩm</h4>
                    <ul>
                        <li><a href="#">Balo</a></li>
                        <li><a href="#">Gấu Bông</a></li>
                        <li><a href="#">Máy Phát Nhạc</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Hỗ trợ</h4>
                    <ul>
                        <li><a href="#">Chính sách</a></li>
                        <li><a href="#">Điều khoản</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Liên hệ</h4>
                    <p><i class="material-icons">phone</i> 0833760087</p>
                    <p><i class="material-icons">email</i> hai.2474802010102@vanlanguni.vn</p>
                    <div class="social-links">
                        <a href="#"><i class="material-icons">facebook</i></a>
                        <a href="#"><i class="material-icons">camera_alt</i></a>
                        <a href="#"><i class="material-icons">alternate_email</i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/mobile-functions.js"></script>
    <script src="js/scriptpopup.js"></script>
</body>
</html>