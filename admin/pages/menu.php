<?php
session_start();
include('../admincp/config/config.php');

$paymentSuccess = false;

if(isset($_POST['khachhang'])){
    $tenkhachhang = $_POST['hovaten'];
    $dienthoai    = $_POST['sdt'];
    $email        = $_POST['email'];
    $diachi       = $_POST['diachi'];

    $sql = "INSERT INTO tbl_khachhang(tenkhachhang,dienthoai,email,diachi)
            VALUES ('$tenkhachhang','$dienthoai','$email','$diachi')";

    if(mysqli_query($mysqli, $sql)){
        $paymentSuccess = true;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thực đơn - Katinat</title>
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
                    <a href="menu.php" class="nav-link active text-white">
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
                    <button class="cart-btn text-white" onclick="openCart()">
                        <i class="material-icons">shopping_cart</i> 
                        <span class="cart-count">0</span>
                    </button>
                </div>
            </div>
            <div class="mobile-search" id="mobileSearch">
                <input type="text" placeholder="Tìm kiếm sản phẩm...">
                <button class="search-btn"><i class="material-icons">search</i></button>
            </div>
        </div>
    </header>

    <!-- Menu Page -->
    <section class="menu-page bg-[url('https://katinat.vn/wp-content/uploads/2023/03/bg-coffee-beans.jpg')] bg-fixed bg-cover bg-center">
        <div class="bg-sky-50/90 min-h-screen">
        <div class="container">
            <h1 class="page-title animate__animated animate__fadeInDown">Danh Mục</h1>
            
            <!-- Menu Categories -->
            <div class="menu-categories-nav animate__animated animate__fadeInUp">
                <button class="category-btn active hover:animate__pulse" onclick="showCategory('all')">Tất cả</button>
                <button class="category-btn hover:animate__pulse" onclick="showCategory('tra-sua')">Gấu Bông</button>
                <button class="category-btn hover:animate__pulse" onclick="showCategory('ca-phe')">Dây Chuyền</button>
                <button class="category-btn hover:animate__pulse" onclick="showCategory('tra-trai-cay')">Hộp Nhạc</button>
                <button class="category-btn hover:animate__pulse" onclick="showCategory('dac-biet')">Sản phẩm đặc biệt</button>
            </div>

            <!-- Gấu Bông -->
            <div class="menu-section" data-category="tra-sua">
                <h2 class="menu-section-title">Gấu Bông</h2>
                <div class="menu-grid">
                    <div class="menu-item animate__animated animate__fadeInUp animate__delay-1s hover:animate__pulse">
                        <img src="img/gau_bong_1.jpg" alt="Gấu Bông 1">
                        <div class="menu-item-info">
                            <h3>Gấu Bông 1</h3>
                            <p>Dễ Thương</p>
                            <div class="price">65.000đ</div>
                            <button class="add-to-cart-btn hover:animate__bounce" onclick="addToCart('Gấu Bông 1', 65000)">Thêm vào giỏ</button>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="img/gau_bong_cute_3_1.jpg" alt="Gấu Bông 2">
                        <div class="menu-item-info">
                            <h3>Gấu Bông 2</h3>
                            <p>Dễ Thương</p>
                            <div class="price">55.000đ</div>
                            <button class="add-to-cart-btn" onclick="addToCart('Gấu Bông 2', 55000)">Thêm vào giỏ</button>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="img/gau_bong_cute_4_1.jpg" alt="Gấu Bông 3">
                        <div class="menu-item-info">
                            <h3>Gấu Bông 3</h3>
                            <p>Dễ Thương</p>
                            <div class="price">45.000đ</div>
                            <button class="add-to-cart-btn" onclick="addToCart('Gấu Bông 3', 45000)">Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dây Chuyền -->
            <div class="menu-section" data-category="ca-phe">
                <h2 class="menu-section-title">Dây Chuyền</h2>
                <div class="menu-grid">
                    <div class="menu-item">
                        <img src="img/day-chuyen-bac-trai-tim-0.jpg" alt="Dây Chuyền Bạc Trái Tim">
                        <div class="menu-item-info">
                            <h3>Dây Chuyền Bạc Trái Tim</h3>
                            <p>Hình dáng phù hợp với mọi người phụ nữ của bạn</p>
                            <div class="price">45.000đ</div>
                            <button class="add-to-cart-btn" onclick="addToCart('Dây Chuyền Bạc Trái Tim', 45000)">Thêm vào giỏ</button>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="img/day_chuyen_bac_bong_tuyet_2_.jpg" alt="Dây Chuyền Bạc Bông Tuyết">
                        <div class="menu-item-info">
                            <h3>Dây Chuyền Bạc Bông Tuyết</h3>
                            <p>Vẽ đẹp lạnh lẽo</p>
                            <div class="price">35.000đ</div>
                            <button class="add-to-cart-btn" onclick="addToCart('Dây Chuyền Bạc Bông Tuyết', 35000)">Thêm vào giỏ</button>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="img/day-chuyen-bac-chu-meo-nghich-ngom-5_1.jpg" alt="Dây Chuyền Bạc Chú Mèo Nghịch Ngợm">
                        <div class="menu-item-info">
                            <h3>Dây Chuyền Bạc Chú Mèo Nghịch Ngợm</h3>
                            <p>Chú mèo nghịch ngợm của tôi</p>
                            <div class="price">30.000đ</div>
                            <button class="add-to-cart-btn" onclick="addToCart('Dây Chuyền Bạc Chú Mèo Nghịch Ngợm', 30000)">Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hộp Nhạc -->
            <div class="menu-section" data-category="tra-trai-cay">
                <h2 class="menu-section-title">Hộp Nhạc</h2>
                <div class="menu-grid">
                    <div class="menu-item">
                        <img src="img/hop_nhac_dan_piano_go_dang_dung_1_.jpg" alt="Hộp Nhạc Gỗ 1">
                        <div class="menu-item-info">
                            <h3>Hộp Nhạc Gỗ 1</h3>
                            <p>Mang vẻ đẹp thanh lịch</p>
                            <div class="price">58.000đ</div>
                            <button class="add-to-cart-btn" onclick="addToCart('Hộp Nhạc Gỗ 1', 58000)">Thêm vào giỏ</button>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="img/hop_nhac_bac_4.jpg" alt="Hộp Nhạc Gỗ 2">
                        <div class="menu-item-info">
                            <h3>Hộp Nhạc Gỗ 2</h3>
                            <p>Gọn và Hay</p>
                            <div class="price">40.000đ</div>
                            <button class="add-to-cart-btn" onclick="addToCart('Hộp Nhạc Gỗ 2', 40000)">Thêm vào giỏ</button>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="img/hop_nhac_dan_piano_go_5_.jpg" alt="Hộp Nhạc Gỗ 3">
                        <div class="menu-item-info">
                            <h3>Hộp Nhạc Gỗ 3</h3>
                            <p>Màu đen lịch lãm kèm điệu nhạc du dương</p>
                            <div class="price">42.000đ</div>
                            <button class="add-to-cart-btn" onclick="addToCart('Hộp Nhạc Gỗ 3', 42000)">Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sản phẩm đặc biệt -->
            <div class="menu-section" data-category="dac-biet">
                <h2 class="menu-section-title">Sản phẩm đặc biệt</h2>
                <div class="menu-grid">
                    <div class="menu-item">
                        <img src="img/hop-nhac-pha-le-piano_3_.png" alt="Hộp Nhạc Pha Lê">
                        <div class="menu-item-info">
                            <h3>Hộp Nhạc Pha Lê</h3>
                            <p>Vẻ đẹp thanh cao cùng với tiếng nhạc du dương</p>
                            <div class="price">75.000đ</div>
                            <button class="add-to-cart-btn" onclick="addToCart('Hộp Nhạc Pha Lê', 175000)">Thêm vào giỏ</button>
                        </div>
                    </div>
                    <div class="menu-item special-edition">
                        <img src="img/tui-tote-nhung-tam-tho-beo-2.jpg" alt="Túi Đeo Hình Con Thỏ">
                        <div class="menu-item-info">
                            <h3>Túi Đeo Hình Con Thỏ<span class="limited-badge">Phiên bản giới hạn</span></h3>
                            <p>Phiên bản giới hạn mừng Tết Ất Tỵ 2025</p>
                            <div class="price">85.000đ</div>
                            <button class="add-to-cart-btn" onclick="addToCart('Ly Như Ý', 85000)">Thêm vào giỏ</button>
                        </div>
                    </div>
                    <div class="menu-item special-edition">
                        <img src="img/g_u_3.jpg" alt="Gấu Graduate">
                        <div class="menu-item-info">
                            <h3>Gấu Graduate<span class="limited-badge">Phiên bản Tốt Nghiệp</span></h3>
                            <p>Phiên bản Tốt Nghiệp</p>
                            <div class="price">78.000đ</div>
                            <button class="add-to-cart-btn" onclick="addToCart('Gấu Graduate', 78000)">Thêm vào giỏ</button>
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

    <!-- Cart Modal -->
    <div id="cartModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="material-icons">shopping_cart</i> Giỏ hàng</h3>
                <span class="close" onclick="closeCart()">&times;</span>
            </div>
            <div class="cart-items" id="cartItems">
                <!-- Cart items will be populated here -->
            </div>
            <div class="cart-total">
                <div class="total-price">Tổng cộng: <span id="totalPrice">0đ</span></div>
                <button class="checkout-btn" onclick="openCheckout()">Thanh toán</button>
            </div>
        </div>
    </div>

    <!-- Checkout Modal -->
 <form action="" method="POST">
<div id="checkoutModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="material-icons">payment</i> Thông tin thanh toán</h3>
            <span class="close" onclick="closeCheckout()">&times;</span>
        </div>

        <div id="checkoutForm" class="checkout-form">

            <div class="form-section">
                <h4><i class="material-icons">person</i> Thông tin khách hàng</h4>

                <div class="form-group">
                    <input type="text" id="customerName" name="hovaten" placeholder="Họ và tên" required>
                </div>

                <div class="form-group">
                    <input type="tel" id="customerPhone" name="sdt" placeholder="Số điện thoại" required>
                </div>

                <div class="form-group">
                    <input type="email" id="customerEmail" name="email" placeholder="Email">
                </div>

                <div class="form-group">
                    <textarea id="customerAddress" name="diachi" placeholder="Địa chỉ giao hàng" rows="3"></textarea>
                </div>
            </div>

            <div class="form-section">
                <h4><i class="material-icons">credit_card</i> Phương thức thanh toán</h4>
                <div class="payment-methods">
                    <label class="payment-option">
                        <input type="radio" name="paymentMethod" value="cash" checked>
                        <span><i class="material-icons">money</i> Tiền mặt</span>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="paymentMethod" value="bank">
                        <span><i class="material-icons">account_balance</i> Chuyển khoản ngân hàng</span>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="paymentMethod" value="momo">
                        <span><i class="material-icons">phone_android</i> Ví MoMo</span>
                    </label>
                </div>
            </div>

            <div id="bankInfo" class="bank-info" style="display: none;">
                <h4><i class="material-icons">account_balance</i> Thông tin chuyển khoản</h4>
                <div class="bank-details">
                    <p><strong>Ngân hàng:</strong> Vietcombank</p>
                    <p><strong>Số tài khoản:</strong> 1234567890</p>
                    <p><strong>Chủ tài khoản:</strong> CONG TY KATINAT</p>
                    <p><strong>Nội dung:</strong> <span id="transferContent"></span></p>
                </div>
            </div>

            <div class="order-summary">
                <h4><i class="material-icons">receipt</i> Tóm tắt đơn hàng</h4>
                <div id="orderSummary"></div>
                <div class="final-total">Tổng thanh toán: <span id="finalTotal">0đ</span></div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="closeCheckout()">Hủy</button>
                <button type="submit" name="khachhang" class="btn-primary">Xác nhận đặt hàng</button>
            </div>

        </div>
    </div>
</div>
</form> 
   <!-- NHÚNG MODALS -->
    <?php include 'modal.php'; ?>

    <!-- AUTO SHOW SUCCESS MODAL SAU KHI SUBMIT -->
    <?php if ($paymentSuccess) : ?>
    <script>
        window.addEventListener("load", function() {
            document.getElementById("promoOverlay")?.remove(); // Ẩn promo nếu có
            let modal = document.getElementById("successModal");
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        });
    </script>
    <?php endif; ?>
    <script src="../js/script.js"></script>
    <script src="../js/mobile-functions.js"></script>
    <script src="../js/scriptpopup.js"></script>
</body>
</html>