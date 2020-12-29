document.addEventListener('DOMContentLoaded', Init())

function Init() {
    filterToggle();
}

function filterToggle() {
    let filter = document.querySelector('#filter'),
    filterToggle = document.querySelector('#filter-toggle');

    filterToggle.addEventListener('click', () => {
        filter.classList.toggle('active');
    }) 
}