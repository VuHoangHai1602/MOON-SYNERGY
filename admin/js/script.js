// Cart functionality
let cart = [];
let cartCount = 0;

// Initialize cart from localStorage
function initCart() {
    const savedCart = localStorage.getItem('katinatCart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
        updateCartCount();
    }
}

// Save cart to localStorage
function saveCart() {
    localStorage.setItem('katinatCart', JSON.stringify(cart));
}

// Update cart count display
function updateCartCount() {
    cartCount = cart.reduce((total, item) => total + item.quantity, 0);
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = cartCount;
    }
}

// Add item to cart
function addToCart(name, price) {
    const existingItem = cart.find(item => item.name === name);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            name: name,
            price: price,
            quantity: 1
        });
    }
    
    updateCartCount();
    saveCart();
    showAddToCartNotification(name);
}

// Show notification when item added to cart
function showAddToCartNotification(itemName) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'cart-notification';
    notification.innerHTML = `
        <i class="material-icons">check_circle</i>
        <span>Đã thêm "${itemName}" vào giỏ hàng</span>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: #27ae60;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        z-index: 3000;
        animation: slideInRight 0.3s ease-out;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    `;
    
    document.body.appendChild(notification);
    
    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-in';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Open cart modal
function openCart() {
    const modal = document.getElementById('cartModal');
    if (modal) {
        modal.style.display = 'block';
        renderCartItems();
    }
}

// Close cart modal
function closeCart() {
    const modal = document.getElementById('cartModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Render cart items
function renderCartItems() {
    const cartItemsContainer = document.getElementById('cartItems');
    const totalPriceElement = document.getElementById('totalPrice');
    
    if (!cartItemsContainer) return;
    
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
            <div class="empty-cart">
                <i class="material-icons">shopping_cart</i>
                <p>Giỏ hàng của bạn đang trống</p>
            </div>
        `;
        if (totalPriceElement) {
            totalPriceElement.textContent = '0đ';
        }
        return;
    }
    
    let cartHTML = '';
    let total = 0;
    
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        
        cartHTML += `
            <div class="cart-item">
                <div class="item-info">
                    <div class="item-name">${item.name}</div>
                    <div class="item-price">${formatPrice(item.price)}</div>
                </div>
                <div class="quantity-controls">
                    <button class="qty-btn" onclick="updateQuantity(${index}, -1)">-</button>
                    <span class="quantity">${item.quantity}</span>
                    <button class="qty-btn" onclick="updateQuantity(${index}, 1)">+</button>
                </div>
                <button class="remove-item" onclick="removeFromCart(${index})">
                    <i class="material-icons">delete</i>
                </button>
            </div>
        `;
    });
    
    cartItemsContainer.innerHTML = cartHTML;
    if (totalPriceElement) {
        totalPriceElement.textContent = formatPrice(total);
    }
}

// Update item quantity
function updateQuantity(index, change) {
    if (cart[index]) {
        cart[index].quantity += change;
        
        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }
        
        updateCartCount();
        saveCart();
        renderCartItems();
    }
}

// Remove item from cart
function removeFromCart(index) {
    cart.splice(index, 1);
    updateCartCount();
    saveCart();
    renderCartItems();
}

// Format price
function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price) + 'đ';
}

// Open checkout modal
function openCheckout() {
    if (cart.length === 0) {
        alert('Giỏ hàng của bạn đang trống!');
        return;
    }
    
    closeCart();
    const checkoutModal = document.getElementById('checkoutModal');
    if (checkoutModal) {
        checkoutModal.style.display = 'block';
        renderOrderSummary();
    }
}

// Close checkout modal
function closeCheckout() {
    const modal = document.getElementById('checkoutModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Render order summary
function renderOrderSummary() {
    const orderSummary = document.querySelector('.order-summary');
    if (!orderSummary) return;
    
    let summaryHTML = '<h4><i class="material-icons">receipt</i> Tóm tắt đơn hàng</h4>';
    let total = 0;
    
    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        
        summaryHTML += `
            <div class="summary-item">
                <span>${item.name} x${item.quantity}</span>
                <span>${formatPrice(itemTotal)}</span>
            </div>
        `;
    });
    
    const deliveryFee = 15000;
    const finalTotal = total + deliveryFee;
    
    summaryHTML += `
        <div class="summary-item">
            <span>Phí giao hàng</span>
            <span>${formatPrice(deliveryFee)}</span>
        </div>
        <div class="final-total">
            Tổng cộng: ${formatPrice(finalTotal)}
        </div>
    `;
    
    orderSummary.innerHTML = summaryHTML;
}

// Menu category filtering
function showCategory(category) {
    const sections = document.querySelectorAll('.menu-section');
    const buttons = document.querySelectorAll('.category-btn');
    
    // Update active button
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Show/hide sections
    sections.forEach(section => {
        if (category === 'all' || section.dataset.category === category) {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
        }
    });
}

// Handle checkout form submission
function handleCheckout(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    // Validate required fields
    const requiredFields = ['customerName', 'customerPhone'];
    let isValid = true;
    
    requiredFields.forEach(field => {
        const input = form.querySelector(`#${field}`);
        if (!input.value.trim()) {
            input.style.borderColor = '#e74c3c';
            isValid = false;
        } else {
            input.style.borderColor = '#e0e0e0';
        }
    });
    
    if (!isValid) {
        alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
        return;
    }
    
    // Simulate order processing
    const submitBtn = form.querySelector('.btn-primary');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Đang xử lý...';
    submitBtn.disabled = true;
    
    setTimeout(() => {
        // Get customer info
        const customerInfo = {
            name: form.querySelector('#customerName').value,
            phone: form.querySelector('#customerPhone').value,
            address: form.querySelector('#customerAddress').value
        };
        
        // Show success modal
        showSuccessModal(customerInfo);
        
        // Clear cart
        cart = [];
        updateCartCount();
        saveCart();
        
        // Close checkout modal
        closeCheckout();
        
        // Reset form
        form.reset();
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    }, 2000);
}

// Close modal when clicking outside
window.onclick = function(event) {
    const cartModal = document.getElementById('cartModal');
    const checkoutModal = document.getElementById('checkoutModal');
    
    if (event.target === cartModal) {
        closeCart();
    }
    
    if (event.target === checkoutModal) {
        closeCheckout();
    }
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Slideshow functionality
let slideIndex = 1;

function changeSlide(n) {
    showSlide(slideIndex += n);
}

function currentSlide(n) {
    showSlide(slideIndex = n);
}

function showSlide(n) {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.dot');
    
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    if (slides[slideIndex - 1]) {
        slides[slideIndex - 1].classList.add('active');
    }
    if (dots[slideIndex - 1]) {
        dots[slideIndex - 1].classList.add('active');
    }
}

// Auto slideshow
function autoSlide() {
    slideIndex++;
    showSlide(slideIndex);
}

// Promotion modal functions
function closePromoModal() {
    const overlay = document.getElementById('promoOverlay');
    overlay.style.display = 'none';
}

function usePromoCode() {
    showNotification('Mã khuyến mãi TET2025 đã được áp dụng!', 'success');
    closePromoModal();
}

// Success modal functions
function showSuccessModal(customerInfo) {
    const modal = document.getElementById('successModal');
    const deliveryTime = document.getElementById('deliveryTime');
    const deliveryAddress = document.getElementById('deliveryAddress');
    
    // Calculate delivery time
    const now = new Date();
    const deliveryStart = new Date(now.getTime() + 15 * 60000);
    const deliveryEnd = new Date(now.getTime() + 20 * 60000);
    
    deliveryTime.textContent = `${deliveryStart.getHours()}:${deliveryStart.getMinutes().toString().padStart(2, '0')} - ${deliveryEnd.getHours()}:${deliveryEnd.getMinutes().toString().padStart(2, '0')}`;
    
    if (customerInfo && customerInfo.address) {
        deliveryAddress.textContent = customerInfo.address;
    }
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Notification function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    const bgColor = type === 'success' ? 'from-green-500 to-green-600' : 'from-sky-500 to-sky-600';
    
    notification.className = `fixed top-20 right-4 bg-gradient-to-r ${bgColor} text-white px-6 py-3 rounded-xl shadow-lg z-50 transform transition-all duration-300 translate-x-full`;
    notification.style.boxShadow = '0 0 20px rgba(34, 197, 94, 0.3)';
    notification.innerHTML = `
        <div class="flex items-center gap-2">
            <i class="material-icons">${type === 'success' ? 'check_circle' : 'info'}</i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// News slider functionality
let newsSlideIndex = 1;

function changeNewsSlide(n) {
    showNewsSlide(newsSlideIndex += n);
}

function currentNewsSlide(n) {
    showNewsSlide(newsSlideIndex = n);
}

function showNewsSlide(n) {
    const slides = document.querySelectorAll('.news-slide');
    const dots = document.querySelectorAll('.news-dot');
    
    if (n > slides.length) { newsSlideIndex = 1 }
    if (n < 1) { newsSlideIndex = slides.length }
    
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    if (slides[newsSlideIndex - 1]) {
        slides[newsSlideIndex - 1].classList.add('active');
    }
    if (dots[newsSlideIndex - 1]) {
        dots[newsSlideIndex - 1].classList.add('active');
    }
}

// Auto news slideshow
function autoNewsSlide() {
    newsSlideIndex++;
    showNewsSlide(newsSlideIndex);
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    initCart();
    
    // Show promo modal without blur
    // Modal will show automatically on page load
    
    // Add event listener for checkout form
    const checkoutForm = document.getElementById('checkoutForm');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', handleCheckout);
    }
    
    // Start auto slideshow
    setInterval(autoSlide, 5000);
    
    // Start auto news slideshow
    if (document.querySelector('.news-slider')) {
        setInterval(autoNewsSlide, 4000);
    }
});

// Search functionality
function handleSearch() {
    const searchInput = document.querySelector('.search-box input');
    const searchTerm = searchInput.value.toLowerCase().trim();
    
    if (!searchTerm) return;
    
    // If on menu page, filter menu items
    if (window.location.pathname.includes('menu.html')) {
        const menuItems = document.querySelectorAll('.menu-item');
        
        menuItems.forEach(item => {
            const itemName = item.querySelector('h3').textContent.toLowerCase();
            const itemDescription = item.querySelector('p').textContent.toLowerCase();
            
            if (itemName.includes(searchTerm) || itemDescription.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
}

// Add search event listeners
document.addEventListener('DOMContentLoaded', function() {
    const searchBtn = document.querySelector('.search-btn');
    const searchInput = document.querySelector('.search-box input');
    
    if (searchBtn) {
        searchBtn.addEventListener('click', handleSearch);
    }
    
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                handleSearch();
            }
        });
    }
});
// Responsive scaling handler
function handleResponsiveScaling() {
    const width = window.innerWidth;
    const body = document.body;
    
    body.classList.remove('mobile', 'tablet', 'desktop', 'large-desktop');
    
    if (width >= 1200) {
        body.classList.add('large-desktop');
    } else if (width >= 992) {
        body.classList.add('desktop');
    } else if (width >= 769) {
        body.classList.add('tablet');
    } else {
        body.classList.add('mobile');
    }
    
    if (width <= 768) {
        const animatedElements = document.querySelectorAll('.animate__animated');
        animatedElements.forEach(el => {
            el.style.animationDuration = '0.5s';
            el.style.animationDelay = '0.1s';
        });
    }
}

// Handle window resize
window.addEventListener('resize', function() {
    handleResponsiveScaling();
    
    if (window.innerWidth > 768) {
        const nav = document.getElementById('mobileNav');
        const search = document.getElementById('mobileSearch');
        if (nav) nav.classList.remove('active');
        if (search) search.classList.remove('active');
    }
});

// Orientation change handler
window.addEventListener('orientationchange', function() {
    setTimeout(handleResponsiveScaling, 100);
});

// Initialize responsive scaling on load
document.addEventListener('DOMContentLoaded', function() {
    handleResponsiveScaling();
});

