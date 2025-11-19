<?php
// Bắt đầu session để lưu trữ trạng thái đăng nhập
session_start();

// Xử lý Đăng xuất
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();    // Xóa tất cả biến session
    session_destroy(); // Hủy session
    header('Location: stores.php'); // Quay lại trang chủ
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
    <title>Cửa hàng - Moon Synergy</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
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
                    <a href="stores.php" class="nav-link active text-white">
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

    <!-- Store Locator -->
    <section class="store-page bg-[url('https://katinat.vn/wp-content/uploads/2023/03/bg-store.jpg')] bg-fixed bg-cover bg-center">
        <div class="bg-sky-50/90 min-h-screen">
        <div class="container">
            <h1 class="page-title animate__animated animate__fadeInDown">Hệ thống cửa hàng Moon Synergy</h1>
            
            <!-- Map Container -->
            <div class="map-container animate__animated animate__fadeIn">
                <div id="map"></div>
            </div>

            <!-- Store List -->
            <div class="stores-grid">
                <div class="store-card animate__animated animate__fadeInUp animate__delay-1s hover:animate__pulse" data-lat="10.7769" data-lng="106.7009">
                    <div class="store-image">
                        <img src="https://katinat.vn/wp-content/uploads/2023/03/katinat-store-1.jpg" alt="Moon Synergy Nguyễn Huệ">
                        <div class="store-status open">Đang mở</div>
                    </div>
                    <div class="store-info">
                        <h3>Moon Synergy Nguyễn Huệ</h3>
                        <p><i class="material-icons">location_on</i> 57 Nguyễn Huệ, Quận 1, TP.HCM</p>
                        <p><i class="material-icons">access_time</i> 7:00 - 22:00</p>
                        <p><i class="material-icons">phone</i> (028) 3822 1234</p>
                        <div class="store-features">
                            <span class="feature"><i class="material-icons">wifi</i> WiFi</span>
                            <span class="feature"><i class="material-icons">ac_unit</i> Điều hòa</span>
                            <span class="feature"><i class="material-icons">local_parking</i> Bãi xe</span>
                        </div>
                        <div class="store-actions">
                            <button class="direction-btn" onclick="openGoogleMaps(10.7769, 106.7009, 'Moon Synergy Nguyễn Huệ')">
                                <i class="material-icons">directions</i> Chỉ đường
                            </button>
                            <button class="call-btn" onclick="callStore('02838221234')">
                                <i class="material-icons">phone</i> Gọi
                            </button>
                        </div>
                    </div>
                </div>

                <div class="store-card" data-lat="10.7829" data-lng="106.6958">
                    <div class="store-image">
                        <img src="https://katinat.vn/wp-content/uploads/2023/03/katinat-store-2.jpg" alt="Moon Synergy Lê Lợi">
                        <div class="store-status open">Đang mở</div>
                    </div>
                    <div class="store-info">
                        <h3>Moon Synergy Lê Lợi</h3>
                        <p><i class="material-icons">location_on</i> 123 Lê Lợi, Quận 1, TP.HCM</p>
                        <p><i class="material-icons">access_time</i> 6:30 - 23:00</p>
                        <p><i class="material-icons">phone</i> (028) 3829 5678</p>
                        <div class="store-features">
                            <span class="feature"><i class="material-icons">wifi</i> WiFi</span>
                            <span class="feature"><i class="material-icons">ac_unit</i> Điều hòa</span>
                            <span class="feature"><i class="material-icons">delivery_dining</i> Giao hàng</span>
                        </div>
                        <div class="store-actions">
                            <button class="direction-btn" onclick="openGoogleMaps(10.7829, 106.6958, 'Moon Synergy Lê Lợi')">
                                <i class="material-icons">directions</i> Chỉ đường
                            </button>
                            <button class="call-btn" onclick="callStore('02838295678')">
                                <i class="material-icons">phone</i> Gọi
                            </button>
                        </div>
                    </div>
                </div>

                <div class="store-card" data-lat="10.7756" data-lng="106.7019">
                    <div class="store-image">
                        <img src="https://katinat.vn/wp-content/uploads/2023/03/katinat-store-3.jpg" alt="Moon Synergy Đồng Khởi">
                        <div class="store-status open">Đang mở</div>
                    </div>
                    <div class="store-info">
                        <h3>Moon Synergy Đồng Khởi</h3>
                        <p><i class="material-icons">location_on</i> 89 Đồng Khởi, Quận 1, TP.HCM</p>
                        <p><i class="material-icons">access_time</i> 7:00 - 22:30</p>
                        <p><i class="material-icons">phone</i> (028) 3821 9999</p>
                        <div class="store-features">
                            <span class="feature"><i class="material-icons">wifi</i> WiFi</span>
                            <span class="feature"><i class="material-icons">ac_unit</i> Điều hòa</span>
                            <span class="feature"><i class="material-icons">outdoor_grill</i> Sân thượng</span>
                        </div>
                        <div class="store-actions">
                            <button class="direction-btn" onclick="openGoogleMaps(10.7756, 106.7019, 'Moon Synergy Đồng Khởi')">
                                <i class="material-icons">directions</i> Chỉ đường
                            </button>
                            <button class="call-btn" onclick="callStore('02838219999')">
                                <i class="material-icons">phone</i> Gọi
                            </button>
                        </div>
                    </div>
                </div>

                <div class="store-card" data-lat="10.8142" data-lng="106.6438">
                    <div class="store-image">
                        <img src="https://katinat.vn/wp-content/uploads/2023/03/katinat-store-4.jpg" alt="Moon Synergy Tân Bình">
                        <div class="store-status closed">Đã đóng</div>
                    </div>
                    <div class="store-info">
                        <h3>Moon Synergy Tân Bình</h3>
                        <p><i class="material-icons">location_on</i> 456 Cộng Hòa, Quận Tân Bình, TP.HCM</p>
                        <p><i class="material-icons">access_time</i> 6:00 - 22:00</p>
                        <p><i class="material-icons">phone</i> (028) 3844 7777</p>
                        <div class="store-features">
                            <span class="feature"><i class="material-icons">wifi</i> WiFi</span>
                            <span class="feature"><i class="material-icons">ac_unit</i> Điều hòa</span>
                            <span class="feature"><i class="material-icons">local_parking</i> Bãi xe</span>
                            <span class="feature"><i class="material-icons">delivery_dining</i> Giao hàng</span>
                        </div>
                        <div class="store-actions">
                            <button class="direction-btn" onclick="openGoogleMaps(10.8142, 106.6438, 'Moon Synergy Tân Bình')">
                                <i class="material-icons">directions</i> Chỉ đường
                            </button>
                            <button class="call-btn" onclick="callStore('02838447777')">
                                <i class="material-icons">phone</i> Gọi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
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

    <script src="../js/script.js"></script>
    <script src="../js/mobile-functions.js"></script>
    <script src="../js/scriptpopup.js"></script>
</body>
</html>