// handel toggle functionality of the menu
document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu_toggle');
    const navMenu = document.getElementById('nav_menu');

    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        menuToggle.classList.toggle('open');
    });
});