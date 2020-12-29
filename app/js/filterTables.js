$(document).ready(function () {
    $('#submitFilter').click(function (e) {
        e.preventDefault();

        manageFilterData('filterData');
    });
})

function manageFilterData(key) {
    let dataFrom = $('#firstDate'),
    dataBy = $('#twoDate'),
    part = $('#part'),
    projectRep = $('#projectRep'),
    descriptionRep = $('#descriptionRep'),
    nameRep = $('#nameRep'),
    codeprodRep = $('#codeprodRep'),
    action = $('#action'),
    resetFilter = $('#resetFilter');

    $.ajax({
        url: location.origin + "/app/filter.php",
        method: 'POST',
        data: {
            key: key,
            dataFrom: dataFrom.val(),
            dataBy: dataBy.val(),
            part: part.val(),
            projectRep: projectRep.val(),
            descriptionRep: descriptionRep.val(),
            nameRep: nameRep.val(),
            codeprodRep: codeprodRep.val(),
            action: action.val()
        },
        dataType: "text",
        success: function (response) {
            if (response != "reachedMax") {
                alert('Данные отфильтрованы');
                $('#tbody_edited').html(response);
            } else {
                $("#table_edited").DataTable({
                    destroy: true,
                    columns: [
                        { title: "Дата" },
                        { title: "Раздел" },
                        { title: "Действие" },
                        { title: "Проект" },
                        { title: "Описание" },
                        { title: "Наименование" },
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