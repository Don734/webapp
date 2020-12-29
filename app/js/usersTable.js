$(document).ready( function () {
    getUserData(0, 10);
});

function manageUserData(key) {
    let fullname = $("#fullname"),
    usermail = $("#usermail"),
    pass = $("#pass"),
    company = $("#company"),
    phone = $("#phone"),
    group = $("#group"),
    editUserID = $("#editUserDataID");

    $.ajax({
        url: location.origin + "/app/controllers/addUser.php",
        method: "POST",
        data: {
            key: key,
            fullname: fullname.val(),
            email: usermail.val(),
            pass: pass.val(),
            company: company.val(),
            phone: phone.val(),
            group: group.val(),
            userID: editUserID.val()
        },
        dataType: "text",
        success: function (response) {
            if (response != "success") {
                alert('Успешно!');
            } else {
                $("#fullname_"+editUserID.val()).html(fullname.val());
                usermail.val('');
                pass.val('');
                company.val('');
                phone.val('');
                group.val('');
                $("#modalAddUser").removeClass('active');
                $("#addNewUser").attr('value', 'Добавить').attr('onclick', "manageUserData('addUser')");
            }
        }
    });
}

function getUserData(start, limit) {
    $.ajax({
        url: location.origin + '/app/controllers/addUser.php',
        method: "POST",
        data: {
            key: 'getUserData',
            start: start,
            limit: limit
        },
        dataType: "text",
        success: function (response) {
            if (response != "reachedMax") {
                $('#tbody_users').append(response);
                start += limit;
                getUserData(start, limit);
            } else {
                $('#users_table').DataTable({
                    autoWidth: false,
                    columns: [
                        {title: 'Почта'},
                        {title: 'Имя'},
                        {title: 'Компания'},
                        {title: 'Телефон'},
                        {title: 'Группа'},
                        {title: 'Дата создания'},
                        {title: ''}
                    ]
                });
            }
        }
    });
}

function editUserData(userID) {
    $.ajax({
        url: location.origin + '/app/controllers/addUser.php',
        method: 'POST',
        dataType: "json",
        data: {
            key: 'editUserData',
            userID: userID
        }, success: function (response) {
            $("#editUserDataID").val(userID);
            $("#fullname").val(response.fullname);
            $("#usermail").val(response.usermail);
            // $("#pass").val(response.userpass).prop("disabled", "true");
            $("#company").val(response.company);
            $("#phone").val(response.phone);
            $("#group").val(response.group);
            $("#modalAddUser").addClass('active');
            $("#addNewUser").attr('value', 'Сохранить').attr('onclick', "manageUserData('updateUser')");
        }
    })
}

function deleteUserData(userID) {
    if (confirm('Вы уверены?')) {
        $.ajax({
            url: location.origin + '/app/controllers/addUser.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'deleteUserData',
                userID: userID
            }, success: function (response) {
                $("#fullname_"+userID).parent().remove();
                alert('Пользователь удалён!');
            }
        })
    }
}