<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/connect.php';

    $sql = mysqli_query($connect, "SELECT `fullname` FROM `users`");
?>

<div class="modalForm" id="modalAddGroup">
    <button class="modalForm__close" id="modalClose"><span class="material-icons">close</span></button>
    <form class="modalForm-control" method="POST">
        <div class="modalForm__col">
            <label for="project">Название группы:</label>
            <input class="modalForm__control" id="groupname" type="text" name="groupname">
        </div>
        <div class="modalForm__col">
            <input class="modalForm__control" id="editGroupID" type="hidden" name="editGroupID">
        </div>
        <div class="modalForm__col">
            <div class="container">
                <div class="item">
                    <div class="accordion__title">Привилегии <span class="material-icons icon">keyboard_arrow_down</span></div>
                    <div class="accordion__item">
                        <input class="chkbox" id="adduser" name="adduser" value="adduser" type="checkbox">
                        <label for="adduser">Добавлять пользователей</label><br>
                        <input class="chkbox" id="edituser" name="edituser" value="edituser" type="checkbox">
                        <label for="edituser">Редактировать пользователей</label><br>
                        <input class="chkbox" id="deleteuser" name="deleteuser" value="deleteuser" type="checkbox">
                        <label for="deleteuser">Удалять пользователей</label><br>
                        <input class="chkbox" id="addgroup" name="addgroup" value="addgroup" type="checkbox">
                        <label for="addgroup">Создавать группы</label><br>
                        <input class="chkbox" id="editgroup" name="editgroup" value="editgroup" type="checkbox">
                        <label for="editgroup">Редактировать группы</label><br>
                        <input class="chkbox" id="deletegroup" name="deletegroup" value="deletegroup" type="checkbox">
                        <label for="deletegroup">Удалять группы</label><br>
                        <input class="chkbox" id="addtable" name="addtable" value="addtable" type="checkbox">
                        <label for="addtable">Создавать таблицы</label><br>
                        <input class="chkbox" id="edittable" name="edittable" value="edittable" type="checkbox">
                        <label for="edittable">Редактировать таблицы</label><br>
                        <input class="chkbox" id="deletetable" name="deletetable" value="deletetable" type="checkbox">
                        <label for="deletetable">Удалять таблицы</label><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="modalForm__col">
            <input class="modalForm__submit" id="addNewGroup" onclick="manageGroupData('addNewGroup')" type="submit" value="Добавить">
        </div>
    </form>
</div>