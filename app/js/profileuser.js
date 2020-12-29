$(document).ready(function () {
    let profID = $('#editProfileID').val();

    editProfileData(profID);

    $('#saveprofile').click(function (e) {
        e.preventDefault();

        window.location.reload();
        manageProfileData('updateProfile');
    })
});

function manageProfileData(key) {
    let fullname = $('#username'),
    companyname = $('#companyname'),
    usermail = $('#email'),
    userphone = $('#phone'),
    oldpass = $('#oldpass'),
    newpass = $('#newpass'),
    editProfileID = $('#editProfileID');

    $.ajax({
        url: location.origin +  "/app/profile.php",
        method: "POST",
        data: {
            key: key,
            fullname: fullname.val(),
            companyname: companyname.val(),
            usermail: usermail.val(),
            userphone: userphone.val(),
            oldpass: oldpass.val(),
            newpass: newpass.val(),
            profileID: editProfileID.val()
        },
        dataType: "text",
        success: function (response) {
            if (response != 'success') {
                alert('Настройки сохранены');
            } else {
                fullname.val('');
                companyname.val('');
                userpos.val('');
                usermail.val('');
                userphone.val('');
                oldpass.val('');
                newpass.val('');
            }
        }
    });
}

function editProfileData(profileID) {
    $.ajax({
        url: location.origin +  "/app/profile.php",
        method: "POST",
        data: {
            key: 'editProfileData',
            profileID: profileID
        },
        dataType: "json",
        success: function (response) {
            $('#editProfileID').val(profileID);
            $('#username').val(response.fullname);
            $('#user-name').text(response.fullname);
            $('#companyname').val(response.company);
            $('#userpos').val(response.group).prop("disabled", "true");
            $('#user-pos').text(response.group);
            $('#email').val(response.usermail);
            $('#phone').val(response.phone);
        }
    });
}