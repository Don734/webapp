$(document).ready(function () {
    getGroupData(0, 10);
})

function manageGroupData(key) {
    let groupName = $("#groupname"),
    editGroupID = $("#editGroupID");

    $.ajax({
        url: location.origin + "/app/controllers/addGroup.php",
        method: "POST",
        data: {
            key: key,
            groupname: groupName.val(),
            groupID: editGroupID.val(),
        },
        dataType: "json",
        success: function (response) {
            if (response != "success") {
                alert('Успешно!');
            } else {
                $("#groupname_"+editGroupID.val()).html(groupName.val());
                $("#modalAddGroup").removeClass('active');
                $("#addNewGroup").attr('value', 'Добавить').attr('onclick', "manageGroupData('addNewGroup')");
            }
        }
    })
}

function setRulesGroup(key) {
    let checkbox = $(".chkbox"),
    groupName = $("#groupname"),
    editGroupID = $("#editGroupID");

    for (let i = 0; i < checkbox.length; i++) {
        const element = checkbox[i];

        $.ajax({
            url: location.origin + "/app/controllers/addGroup.php",
            method: "POST",
            data: {
                key: key,
                value: element.id,
                state: element.checked,
                groupname: groupName.val(),
                groupID: editGroupID.val(),
            },
            dataType: "json",
            success: function (response) {
                if (response != "success") {
                    alert('Успешно!');
                }
            }
        });
    }
}

function getGroupData(start, limit) {
    $.ajax({
        url: location.origin + "/app/controllers/addGroup.php",
        method: "POST",
        data: {
            key: 'getGroupData',
            start: start,
            limit: limit
        },
        dataType: "text",
        success: function (response) {
            if (response != "reachedMax") {
                if ($('#tbody_groups').text().length < 1) {
                    $('#tbody_groups').append(response);
                    start += limit;
                    getGroupData(start, limit);
                }
                return false;
            } else {
                $('#groups_table').DataTable({
                    autoWidth: false,
                    columns: [
                        {title: 'Название группы'},
                        {title: ''}
                    ]
                });
            }
        }
    });
}

function editGroupData(groupID) {
    $.ajax({
        url: location.origin + "/app/controllers/addGroup.php",
        method: 'POST',
        dataType: "json",
        data: {
            key: 'editGroupData',
            groupID: groupID
        }, success: function (response) {
            saveCheckbox(response.action, response.sign)
            $("#editGroupID").val(groupID);
            $("#groupname").val(response.groupname);
            $("#modalAddGroup").addClass('active');
            $("#addNewGroup").attr('value', 'Сохранить').attr('onclick', "setRulesGroup('updateGroup')");
        }
    })
}

function deleteGroup(groupID) {
    if (confirm('Вы уверены?')) {
        $.ajax({
            url: location.origin + "/app/controllers/addGroup.php",
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'deleteGroup',
                groupID: groupID
            }, success: function (response) {
                $("#groupname_"+groupID).parent().remove();
                alert(response);
            }
        })
    }
}

function saveCheckbox(actionName, sign) {
    let actionArray = actionName.split(/-/g),
    signArray = sign.split(/-/g);

    actionArray.pop();
    signArray.pop();

    document.querySelectorAll(".chkbox").forEach((el, i) => {
        el.checked = signArray[i] === "true";
    })
}