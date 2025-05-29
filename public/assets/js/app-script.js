const navbar_home_content = document.getElementById('navbar-home-content')
const navbar_home_menu = document.getElementById('navbar-home-menu')
const navbar_home_button = document.getElementById('navbar-home-button')

const navbar_home_container_logo = document.getElementById('navbar-home-container-logo')
const navbar_home_container_login = document.getElementById('navbar-home-container-login')

function updateScreen() {
    if (window.innerWidth <= 991) {
        navbar_home_button.classList.remove('btn-outline-light', 'shadow-m')
        navbar_home_button.classList.add('btn-dark')
        navbar_home_content.classList.add('shadow-m')
        navbar_home_menu.classList.remove('shadow-m')

        // navbar_home_content.classList.add('bg-danger')
        // navbar_home_content.classList.remove('bg-transparent')

        // navbar_home_content.classList.add('bg-transparent')
        // navbar_home_content.classList.remove('bg-clrdang')
    } else {
        navbar_home_button.classList.remove('btn-dark')
        navbar_home_button.classList.add('btn-outline-light', 'shadow-m')
        navbar_home_content.classList.remove('shadow-m')
        navbar_home_menu.classList.add('shadow-m')

        // navbar_home_content.classList.add('bg-transparent')
        // navbar_home_content.classList.remove('bg-danger')

        // navbar_home_content.classList.add('bg-clrdang')
        // navbar_home_content.classList.remove('bg-transparent')
    }
}
updateScreen();
window.addEventListener('resize', updateScreen);

document.addEventListener('DOMContentLoaded', function () {
    const navbar_home_button_drop = document.getElementById('navbar-home-button-drop')
    const navbar_home_resp = document.querySelectorAll('.navbar-home-resp')
    const navbar_home_container_logo = document.getElementById('navbar-home-container-logo')
    const navbar_home_container_drop = document.getElementById('navbar-home-container-drop')

    navbar_home_button_drop.addEventListener('click', function () {

        if (navbar_home_container_logo.classList.contains('col-10')) {
            navbar_home_container_logo.classList.remove('col-10')
            navbar_home_container_logo.classList.remove('justify-content-start')
            navbar_home_button_drop.classList.remove('position-relative')

            navbar_home_container_logo.classList.add('col-12')
            navbar_home_container_logo.classList.add('justify-content-center')
            navbar_home_button_drop.classList.add('position-right-center')
        } else {
            navbar_home_container_logo.classList.remove('col-12')
            navbar_home_container_logo.classList.remove('justify-content-center')
            navbar_home_button_drop.classList.remove('position-right-center')
            
            navbar_home_container_logo.classList.add('col-10')
            navbar_home_container_logo.classList.add('justify-content-start')
            navbar_home_button_drop.classList.add('position-relative')
        }

        navbar_home_resp.forEach(item => {
            if (item.classList.contains('d-none')) {
                item.classList.remove('d-none')
                item.classList.add('d-flex')
            } else {
                item.classList.remove('d-flex')
                item.classList.add('d-none')
            }
        });
    });
});

window.addEventListener('scroll', function () {
    const button = document.getElementById('button-login');
    
    if (window.scrollY >= 200 && button) {
      button.id = 'button-login-scrolled';

      if (window.innerWidth >= 991) {
        navbar_home_container_logo.classList.add('d-none')
        navbar_home_container_logo.classList.remove('d-flex')
        navbar_home_container_login.classList.add('d-none')
        navbar_home_container_login.classList.remove('d-flex')
      }
    } else {
      const scrolledButton = document.getElementById('button-login-scrolled');
      if (window.scrollY < 200 && scrolledButton) {
        scrolledButton.id = 'button-login';

        if (window.innerWidth >= 991) {
            navbar_home_container_logo.classList.add('d-flex')
            navbar_home_container_logo.classList.remove('d-none')
            navbar_home_container_login.classList.add('d-flex')
            navbar_home_container_login.classList.remove('d-none')
        }
      }
    }
  });