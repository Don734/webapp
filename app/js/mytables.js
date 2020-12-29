$(document).ready( function () {
    getComingData(0, 10);
    getExpensData(0, 10);
    getBalanceData(0, 10);
    getStoryData(0, 10);
});

function editComing(rowID) {
    $.ajax({
        url: location.origin + '/app/controllers/comingtables.php',
        method: 'POST',
        dataType: "json",
        data: {
            key: 'getRowComingData',
            rowID: rowID
        }, success: function (response) {
            $("#editDataID").val(rowID);
            $("#project").val(response.project);
            $("#description").val(response.description);
            $("#name").val(response.name);
            $("#score").val(response.score);
            $("#codeproduct").val(response.codeprod);
            $("#unit").val(response.unit);
            $("#prev_count").val(response.count);
            $("#count").val(response.count);
            $("#modal").addClass('active');
            $("#send").attr('value', 'Сохранить').attr('onclick', "manageData('updateComingData')");
        }
    })
}

function editExpens(rowID) {
    $.ajax({
        url: location.origin + '/app/controllers/comingtables.php',
        method: 'POST',
        dataType: "json",
        data: {
            key: 'getRowExpensData',
            rowID: rowID
        }, success: function (response) {
            $("#editDataID").val(rowID);
            $("#project").val(response.project);
            $("#description").val(response.description);
            $("#name").val(response.name);
            $("#score").val(response.score);
            $("#codeproduct").val(response.codeprod);
            $("#unit").val(response.unit);
            $("#count").val(response.count);
            $("#modal").addClass('active');
            $("#send").attr('value', 'Сохранить').attr('onclick', "manageData('updateExpensData');");
        }
    })
}

function deleteData(rowID) {
    if (confirm('Вы уверены?')) {
        $.ajax({
            url: location.origin + '/app/controllers/comingtables.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'deleteRow',
                rowID: rowID
            }, success: function (response) {
                $("#project_"+rowID).parent().remove();
                $("#tablename_"+rowID).parent().remove();
                alert(response);
            }
        })
    }
}

function getComingData(start, limit) {
    $.ajax({
        url: location.origin + '/app/controllers/comingtables.php',
        method: 'POST',
        dataType: 'text',
        data: {
            key: 'getComingData',
            start: start,
            limit: limit
        },
        success: function (response) {
            if (response != "reachedMax") {
                $('#tbody_tableid').append(response);
                start += limit;
                getComingData(start, limit);
            } else {
                $("#table_id").DataTable({
                    dom: 'Blfrtip',
                    buttons: [ 'excel' ],
                    columns: [
                        { title: "Проект" },
                        { title: "Описание" },
                        { title: "Наименование" },
                        { title: "Счёт №" },
                        { title: "Код Продукта" },
                        { title: "Ед. изм." },
                        { title: "Пред. Количество" },
                        { title: "Текущ. Количество" },
                        { title: "Создано" },
                        { title: "" }
                    ]
                });
            }
        }
    })
}

function getExpensData(start, limit) {
    $.ajax({
        url: location.origin + '/app/controllers/comingtables.php',
        method: 'POST',
        dataType: 'text',
        data: {
            key: 'getExpensData',
            start: start,
            limit: limit
        },
        success: function (response) {
            if (response != "reachedMax") {
                $('#tbody_expens').append(response);
                start += limit;
                getExpensData(start, limit);
            } else {
                $("#table_expens").DataTable({
                    dom: 'Blfrtip',
                    buttons: [ 'excel' ],
                    columns: [
                        { title: "Проект" },
                        { title: "Описание" },
                        { title: "Наименование" },
                        { title: "Счёт №" },
                        { title: "Код Продукта" },
                        { title: "Ед. изм." },
                        { title: "Количество" },
                        { title: "Создано" },
                        { title: "" }
                    ]
                });
            }
        }
    })
}

function getBalanceData(start, limit) {
    $.ajax({
        url: location.origin + '/app/controllers/comingtables.php',
        method: 'POST',
        dataType: 'text',
        data: {
            key: 'getBalanceData',
            start: start,
            limit: limit
        },
        success: function (response) {
            if (response != "reachedMax") {
                $('#tbody_balance').append(response);
                start += limit;
                getBalanceData(start, limit);
            } else {
                $("#table_balance").DataTable({
                    dom: 'Blfrtip',
                    buttons: [ 'excel' ],
                    columns: [
                        { title: "Проект" },
                        { title: "Описание" },
                        { title: "Наименование" },
                        { title: "Счёт №" },
                        { title: "Код Продукта" },
                        { title: "Ед. изм." },
                        { title: "Количество" },
                        { title: "Создано" },
                        { title: "" }
                    ]
                });
            }
        }
    })
}

function getStoryData(start, limit) {
    $.ajax({
        url: location.origin + '/app/controllers/comingtables.php',
        method: 'POST',
        data: {
            key: 'getStoryData',
            start: start,
            limit: limit
        },
        dataType: "text",
        success: function (response) {
            if (response != "reachedMax") {
                $('#tbody_edited').append(response);
                start += limit;
                getStoryData(start, limit);
            } else {
                $("#table_edited").DataTable({
                    columns: [
                        { title: "Дата" },
                        { title: "Раздел" },
                        { title: "Действие" },
                        { title: "Проект" },
                        { title: "Описание" },
                        { title: "Наименование" },
                        { title: "Счёт №" },
                        { title: "Код Продукта" },
                        { title: "Ед. изм." },
                        { title: "Количество" },
                        { title: "" }
                    ]
                });
            }
        }
    });
}

function manageData(key) {
    var project = $("#project"),
    desc = $("#description"),
    name = $("#name"),
    score = $("#score"),
    codeproduct = $("#codeproduct"),
    unit = $("#unit"),
    prev_count = $("#prev_count"),
    count = $("#count"),
    editRowID = $("#editDataID");

    $.ajax({
        url: location.origin + '/app/controllers/comingtables.php',
        method: 'POST',
        dataType: 'text',
        data: {
            key: key,
            project: project.val(),
            description: desc.val(),
            name: name.val(),
            score: score.val(),
            codeproduct: codeproduct.val(),
            unit: unit.val(),
            prev_count: prev_count.val(),
            count: count.val(),
            rowID: editRowID.val()
        }, success: function (response) {
            if (response != "success") {
                alert('Добавлено');
            } else {
                $("#project_"+editRowID.val()).html(project.val());
                desc.val('');
                name.val('');
                score.val('');
                unit.val('');
                prev_count.val('');
                count.val('');
                $("#modal").removeClass('active');
                $("#send").attr('value', 'Добавить').attr('onclick', "manageData('addNew')");
            }
        }
    })
}