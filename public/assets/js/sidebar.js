document.addEventListener('DOMContentLoaded', Init())

function Init() {
    sidebarToggle();
    dropdownToggle();
    userMenuToggle();
}

function sidebarToggle() {
    let sidebar = document.querySelector('#sidebar'),
    sidebarToggle = document.querySelector('#sidebar__toggle');

    sidebarToggle.addEventListener('click', () => {
        if (window.innerWidth >= 1200) {
            sidebar.classList.toggle('sidebar-min');
        } else if (window.innerWidth < 1200) {
            sidebar.classList.toggle('sidebar-active');
        }
    }) 
}

function dropdownToggle() {
    let dropdown = document.querySelector('#dropdown-menu'),
    dropdownToggle = document.querySelector('#dropdown-toggle');

    dropdownToggle.addEventListener('click', () => {
        dropdown.classList.toggle('dropdown-active');
    }) 
}

function userMenuToggle() {
    let userMenu = document.querySelector("#user__menu"),
    userMenuBtn = document.querySelector('#user__menu-btn');

    userMenuBtn.addEventListener('click', () => {
        userMenu.classList.toggle('active');
    })
}