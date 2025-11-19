const userIcon = document.getElementById('userIcon');
const userPopup = document.getElementById('userPopup');

// Kiểm tra xem các phần tử có tồn tại không trước khi thêm Listener
if (userIcon && userPopup) {
    // 1. Toggle popup khi click icon
    userIcon.addEventListener('click', (e) => {
        e.stopPropagation(); // Ngăn sự kiện click lan truyền lên document
        
        // Sử dụng classList.toggle() để quản lý hiển thị (Tốt hơn dùng style.display)
        userPopup.classList.toggle('show');
    });

    // 2. Ẩn popup khi click ra ngoài
    document.addEventListener('click', (e) => {
        // Kiểm tra xem click có nằm ngoài userIcon và userPopup không
        if (!userIcon.contains(e.target) && !userPopup.contains(e.target)) {
            userPopup.classList.remove('show');
        }
    });
}