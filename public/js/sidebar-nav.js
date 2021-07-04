const btnSidebarOpen = document.querySelector('#__btnSidebarOpen');
const sidebarBackdrop = document.querySelector('#__sidebarBackdrop');
const sidebarMenu = document.querySelector('#__sidebarMenu');

btnSidebarOpen.addEventListener('click', () => {
    sidebarBackdrop.classList.remove('opacity-0');
    sidebarBackdrop.classList.remove('pointer-events-none');
    sidebarMenu.classList.remove('-translate-x-full');
    sidebarMenu.classList.add('translate-x-0');
});

sidebarBackdrop.addEventListener('click', () => {
    sidebarBackdrop.classList.add('opacity-0');
    sidebarBackdrop.classList.add('pointer-events-none');
    sidebarMenu.classList.remove('translate-x-0');
    sidebarMenu.classList.add('-translate-x-full');
});


$('.nav-link').on('click', function(event) {
    if ($(this).attr('href') == '#') {
        event.preventDefault();
        return false;
    }
});