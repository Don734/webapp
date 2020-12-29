<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/connect.php';

    $sql = mysqli_query($connect, "SELECT `groupname` FROM `groups`");
?>

<div class="modalForm" id="modalAddUser">
    <button class="modalForm__close" id="modalClose"><span class="material-icons">close</span></button>
    <form class="modalForm-control" method="POST">
        <div class="modalForm__col">
            <label for="fullname">Имя Фамилия:</label>
            <input class="modalForm__control" id="fullname" type="text" name="fullname">
        </div>
        <div class="modalForm__col">
            <label for="email">Почта:</label>
            <input class="modalForm__control" id="usermail" type="email" name="usermail">
        </div>
        <div class="modalForm__col">
            <label for="password">Пароль:</label>
            <input class="modalForm__control" id="pass" type="password" name="pass">
        </div>
        <div class="modalForm__col">
            <label for="company">Компания:</label>
            <input class="modalForm__control" id="company" type="text" name="company">
        </div>
        <div class="modalForm__col">
            <label for="phone">Телефон:</label>
            <input class="modalForm__control" id="phone" type="text" name="phone">
        </div>
        <div class="modalForm__col">
            <label for="group">Группа:</label>
            <select class="modalForm__control" id="group" name="group">
                <?php
                    if (mysqli_num_rows($sql) > 0) {
                        while($data = mysqli_fetch_array($sql)) {
                            echo '<option value="' . $data['groupname'] . '">' . $data['groupname'] . '</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="modalForm__col">
            <input class="modalForm__control" id="editUserDataID" type="hidden" name="editUserDataID">
        </div>
        <div class="modalForm__col">
            <input class="modalForm__submit" id="addNewUser" onclick="manageUserData('addUser')" type="submit" value="Добавить">
        </div>
    </form>

    <?php if ($_SESSION['message']) {
        echo '<p class="msg-error">' . $_SESSION['message'] . '</p>';
    }
    
    unset($_SESSION['message']); ?>
</div>