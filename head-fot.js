let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');
let main = document.querySelector('.main');

// Abrir/cerrar menú cuando se hace clic en el icono
menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');
    main.classList.toggle('open');
}

// Cerrar menú cuando se hace clic en cualquier parte de la página
document.onclick = (e) => {
    // Si el clic NO fue en el menú ni en la barra de navegación
    if (e.target !== menu && e.target !== navbar) {
        menu.classList.remove('bx-x');
        navbar.classList.remove('open');
        main.classList.remove('open');
    }
}
