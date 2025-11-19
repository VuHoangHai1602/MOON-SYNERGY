<?php
// Bắt đầu session để lưu trữ trạng thái đăng nhập
session_start();

// Xử lý Đăng xuất
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();    // Xóa tất cả biến session
    session_destroy(); // Hủy session
    header('Location: about.php'); // Quay lại trang chủ
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
    <title>Về Moon Synergy - Câu chuyện thương hiệu</title>
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
                <nav class="nav">
                    <a href="../index.php" class="nav-link text-white">Trang chủ</a>
                    <a href="menu.php" class="nav-link text-white">Sản phẩm</a>
                    <a href="stores.php" class="nav-link text-white">Cửa hàng</a>
                    <a href="about.php" class="nav-link active text-white">Về chúng tôi</a>
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
        </div>
    </header>

    <!-- About Page -->
    <section class="about-page bg-sky-50">
        <div class="container">
            <h1 class="page-title animate__animated animate__fadeInDown">Về Moon Synergy</h1>
            
            <!-- Hero About -->
            <div class="about-hero animate__animated animate__fadeIn">
                <img src="https://katinat.vn/wp-content/uploads/2021/04/about-us-banner.jpg" alt="Về Moon Synergy">
                <div class="hero-overlay animate__animated animate__fadeInUp animate__delay-1s">
                    <h2>Cửa hàng lưu niệm Moon Synergy</h2>
                    <p>Thương hiệu quà lưu niệm hàng đầu Việt Nam</p>
                </div>
            </div>

            <!-- Story Section -->
            <div class="story-section">
                <div class="story-grid">
                    <div class="story-text animate__animated animate__fadeInLeft">
                        <h3>Câu chuyện thương hiệu</h3>
                        <p>Moon Synergy được thành lập để có thể giải quyết những vấn đề mà bao người thường hay mắc phải đó là nên tặng gì cho người hình yêu</p>
                        <p>Với hơn 15 năm phát triển, Moon Synergy hiểu được vấn đề đó nên thương hiệu không ngừng nổ lực cải thiện việc phục vụ và tư vấn nhiệt tình</p>
                    </div>
                    <div class="story-image animate__animated animate__fadeInRight">
                        <img src="https://katinat.vn/wp-content/uploads/2021/04/katinat-story-1.jpg" alt="Lịch sử Moon Synergy">
                    </div>
                </div>
                
                <div class="story-grid reverse">
                    <div class="story-image">
                        <img src="https://katinat.vn/wp-content/uploads/2021/04/katinat-quality.jpg" alt="Chất lượng Moon Synergy">
                    </div>
                    <div class="story-text">
                        <h3>Cam kết thành công</h3>
                        <p>Tại Moon Synergy, chúng tôi luôn đặt chất lượng lên hàng đầu. Mỗi sản phẩm đều được lựa chọn kỹ lưỡng từ nguyên liệu đến nguồn gốc.</p>
                        <p>Đội ngũ nhân viên chuyên nghiệp của chúng tôi được đào tạo bài bản và đam mê, luôn sẵn sàng mang đến cho quý khách hàng những lời khuyên và những món quà phù hợp.</p>
                    </div>
                </div>
            </div>

            <!-- Values Section -->
            <div class="values-section">
                <h3 class="section-title">Giá trị cốt lõi</h3>
                <div class="values-grid">
                    <div class="value-card animate__animated animate__fadeInUp animate__delay-1s hover:animate__pulse">
                        <i class="material-icons">favorite</i>
                        <h4>Tình yêu</h4>
                        <p>Tình yêu với nghề và khách hàng là động lực để chúng tôi không ngừng cải tiến</p>
                    </div>
                    <div class="value-card animate__animated animate__fadeInUp animate__delay-2s hover:animate__pulse">
                        <i class="material-icons">star</i>
                        <h4>Chất lượng</h4>
                        <p>Cam kết mang đến những sản phẩm chất lượng cao với nguồn gốc rõ ràng và chính hãng</p>
                    </div>
                    <div class="value-card animate__animated animate__fadeInUp animate__delay-3s hover:animate__pulse">
                        <i class="material-icons">people</i>
                        <h4>Cộng đồng</h4>
                        <p>Xây dựng cộng đồng yêu thương và chia sẻ những giá trị tích cực</p>
                    </div>
                    <div class="value-card animate__animated animate__fadeInUp animate__delay-4s hover:animate__pulse">
                        <i class="material-icons">eco</i>
                        <h4>Bền vững</h4>
                        <p>Phát triển bền vững và bảo vệ môi trường cho thế hệ tương lai</p>
                    </div>
                </div>
            </div>

            <!-- Team Section -->
            <div class="team-section">
                <h3 class="section-title">Đội ngũ lãnh đạo</h3>
                <div class="team-grid">
                    <div class="team-member">
                        <img src="" alt="CEO">
                        <h4>Vũ Hoàng Hải</h4>
                        <p>Tổng Giám đốc</p>
                        <span>15 năm kinh nghiệm trong ngành F&B</span>
                    </div>
                    <div class="team-member">
                        <img src="" alt="CTO">
                        <h4>Phạm Hoài Bảo</h4>
                        <p>Giám đốc Vận hành</p>
                        <span>Chuyên gia về quản lý chuỗi cửa hàng</span>
                    </div>
                </div>
            </div>

            <!-- Achievements -->
            <div class="achievements-section">
                <h3 class="section-title">Thành tựu đạt được</h3>
                <div class="achievements-grid">
                    <div class="achievement-item">
                        <div class="achievement-number">50+</div>
                        <p>Cửa hàng trên toàn quốc</p>
                    </div>
                    <div class="achievement-item">
                        <div class="achievement-number">1M+</div>
                        <p>Khách hàng tin yêu</p>
                    </div>
                    <div class="achievement-item">
                        <div class="achievement-number">100+</div>
                        <p>Sản phẩm đa dạng</p>
                    </div>
                    <div class="achievement-item">
                        <div class="achievement-number">15+</div>
                        <p>Năm phát triển</p>
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
    <script src="../js/scriptpopup.js"></script>
</body>
</html>