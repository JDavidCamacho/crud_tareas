function toggleMenu(event) {
    event.preventDefault(); // Evita que el enlace realice una acción predeterminada
    const parent = event.target.closest('li');
    const subMenu = parent.querySelector('.nav.nav-second-level');
    if (subMenu) {
        const isVisible = subMenu.style.display === 'block';
        subMenu.style.display = isVisible ? 'none' : 'block'; // Alterna entre mostrar/ocultar
    }
}