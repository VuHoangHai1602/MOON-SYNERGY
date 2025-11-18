const userIcon = document.getElementById('userIcon');
const userPopup = document.getElementById('userPopup');

// Toggle popup khi click icon
userIcon.addEventListener('click', (e) => {
  e.stopPropagation(); // tránh đóng ngay lập tức
  userPopup.style.display = userPopup.style.display === 'flex' ? 'none' : 'flex';
});

// Ẩn popup khi click ra ngoài
document.addEventListener('click', () => {
  userPopup.style.display = 'none';
});
