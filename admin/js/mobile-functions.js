// Mobile menu functions
function toggleMobileMenu() {
    const nav = document.getElementById('mobileNav');
    nav.classList.toggle('active');
}

function toggleSearch() {
    const search = document.getElementById('mobileSearch');
    search.classList.toggle('active');
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const nav = document.getElementById('mobileNav');
    const menuBtn = document.querySelector('.mobile-menu-btn');
    const search = document.getElementById('mobileSearch');
    const searchBtn = document.querySelector('.search-toggle-btn');
    
    if (nav && !nav.contains(event.target) && !menuBtn.contains(event.target)) {
        nav.classList.remove('active');
    }
    
    if (search && !search.contains(event.target) && !searchBtn.contains(event.target)) {
        search.classList.remove('active');
    }
});

// Touch feedback for buttons
function addTouchFeedback() {
    const buttons = document.querySelectorAll('button, .nav-link, .category-card, .product-card, .news-card');
    
    buttons.forEach(button => {
        button.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
        });
        
        button.addEventListener('touchend', function() {
            this.style.transform = 'scale(1)';
        });
    });
}

// Initialize mobile functions
document.addEventListener('DOMContentLoaded', function() {
    addTouchFeedback();
});