<div class="modalForm" id="modal">
    <button class="modalForm__close" id="modalClose"><span class="material-icons">close</span></button>
    <form class="modalForm-control" method="POST">
        <div class="modalForm__col">
            <label for="project">Название проекта:</label>
            <input class="modalForm__control" id="project" type="text" name="project">
        </div>
        <div class="modalForm__col">
            <label for="description">Описание:</label>
            <input class="modalForm__control" id="description" type="text" name="description">
        </div>
        <div class="modalForm__col">
            <label for="name">Наименование:</label>
            <input class="modalForm__control" id="name" type="text" name="name">
        </div>
        <div class="modalForm__col">
            <label for="codeproduct">Код продукта:</label>
            <input class="modalForm__control" id="codeproduct" type="text" name="codeproduct">
        </div>
        <div class="modalForm__col">
            <label for="unit">Ед. изм.:</label>
            <select class="modalForm__control" id="unit" name="unit">
                <option value="шт.">шт.</option>
                <option value="к-т.">к-т.</option>
            </select>
        </div>
        <div class="modalForm__col count">
            <label for="count">Количество:</label>
            <input class="modalForm__control" id="count" type="text" name="count">
        </div>
        <div class="modalForm__col">
            <input id="editDataID" type="hidden" value="0">
        </div>
        <div class="modalForm__col">
            <input class="modalForm__submit" id="send" onclick="manageData('addNew')" type="submit" value="Добавить">
        </div>
    </form>

    <?php if ($_SESSION['message']) {
        echo '<p class="msg-error">' . $_SESSION['message'] . '</p>';
    }
    
    unset($_SESSION['message']); ?>
</div>