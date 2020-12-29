$(document).ready(function () {
    $('.settings__link').click(function (e) {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(e.target.hash).addClass('active');
        $(e.target.hash).siblings().removeClass('active');
    })

    $('.table__link').click(function (e) {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(e.target.hash).addClass('active');
        $(e.target.hash).siblings().removeClass('active');
    })
})