const catalogBtn = document.querySelector('.catalog-header');
const catalogDropdown = document.querySelector('.catalog-dropdown');

catalogBtn.addEventListener('click', () => {
    catalogDropdown.style.display = catalogDropdown.style.display === 'flex' ? 'none' : 'flex';
});

// Закрытие при клике вне блока
document.addEventListener('click', (e) => {
    if (!catalogDropdown.contains(e.target) && !catalogBtn.contains(e.target)) {
        catalogDropdown.style.display = 'none';
    }
});