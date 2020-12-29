<?php session_start();

    if (!$_SESSION['user']) {
        header('Location: signin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="../assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../assets/css/style.min.css">
    <title>Web App</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="top-bar">
                <a class="navbar-brand" href="#">Логотип</a>
                <div class="right-block">
                    <?php 
                        include_once './inc/user-settings.php';
                    ?>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <?php include_once './inc/sidebar.php'; ?>
        <section class="content">
            <div class="container">
                <h2 class="page__title"><span class="icon material-icons">assignment</span>Отчёты</h2>
                <div class="filter__content">
                    <div class="table__rep" id="table_rep-wrap">
                        <table class="display" id="table_edited">
                            <tbody id="tbody_edited"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="filter-block" id="filter">
                <h2 class="page__title"><span class="icon material-icons">filter_alt</span>Фильтр</h2>
                <form class="filter-form">
                    <div class="filter-col">
                        <label for="firstDate">Дата с:</label>
                        <input class="filter-input" id="firstDate" name="firstDate" type="text">
                        <label for="twoDate">Дата по:</label>
                        <input class="filter-input" id="twoDate" name="twoDate" type="text">
                    </div>
                    <div class="filter-col">
                        <label for="part">Раздел:</label>
                        <select class="filter-input" id="part" name="part" type="text">
                            <option value="Приход">Приход</option>
                            <option value="Расход">Расход</option>
                            <option value="Остаток">Остаток</option>
                        </select>
                        <label for="action">Действие:</label>
                        <select class="filter-input" id="action" name="action" type="text">
                            <option value="Создана">Создана</option>
                            <option value="Изменена">Изменена</option>
                            <option value="Удалена">Удалена</option>
                        </select>
                    </div>
                    <div class="filter-col">
                        <label for="projectRep">Проект:</label>
                        <input class="filter-input" id="projectRep" name="projectRep" type="text">
                    </div>
                    <div class="filter-col">
                        <label for="descriptionRep">Описание:</label>
                        <input class="filter-input" id="descriptionRep" name="descriptionRep" type="text">
                    </div>
                    <div class="filter-col">
                        <label for="nameRep">Наименование:</label>
                        <input class="filter-input" id="nameRep" name="nameRep" type="text">
                    </div>
                    <div class="filter-col">
                        <label for="codeprodRep">Код продукта:</label>
                        <input class="filter-input" id="codeprodRep" name="codeprodRep" type="text">
                        <input class="submitRep" id="submitFilter" type="submit" value="Отправить">
                        <input class="submitRep" id="resetFilter" name="resetFilter" type="reset" value="Сбросить">
                    </div>
                </form>
                <button class="filter-toggle" id="filter-toggle"><span class="icon material-icons">filter_alt</span></button>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../assets/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="../assets/js/jszip.min.js"></script>
    <script type="text/javascript" src="../assets/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="../assets/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="../assets/js/buttons.html5.min.js"></script>
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/app/js/mytables.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/filter.js"></script>
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/app/js/filterTables.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>