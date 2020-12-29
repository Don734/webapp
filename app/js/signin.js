$(document).ready(function () {
    $('#signinbtn').click(function (e) { 
        e.preventDefault();
        
        signUser();
    });
});

function signUser() {
    let usermail = $('#signinemail'),
    userpass = $('#signinpass');

    $.ajax({
        url: location.origin + "/app/auth.php",
        method: "POST",
        data: {
            email: usermail.val(),
            pass: userpass.val()
        },
        dataType: "text",
        success: function (response) {
            if (response != "success") {
                alert('Вы вошли.');
            } else {
                alert('Не верный логин или пароль. Пожалуйта повторите!');
            }
        }
    });
}