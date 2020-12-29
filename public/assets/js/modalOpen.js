$(document).ready(function () {
    $('#addUser').click(function () {
        $('#modalAddUser').addClass('active');
    })

    $('#addGroup').click(function () {
        $('#modalAddGroup').addClass('active');
    })

    $('#addProject').click(function () {
        $('#modal').addClass('active');
    })

    $('.modalForm__close').click(function () {
        $(this).parent().removeClass('active');
    })

    $('.accordion__title').click(function () {
        $(this).siblings().slideToggle(300);
        $(this).toggleClass('active');
    })
})