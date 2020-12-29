<?php session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/config/connect.php';

    if (!$_SESSION['user']) {
        header('Location: signin.php');
    }

    $countComing = mysqli_query($connect_tables, "SELECT * FROM coming");
    $amountComing = $countComing->num_rows;
    $countExpens = mysqli_query($connect_tables, "SELECT * FROM expens");
    $amountExpens = $countExpens->num_rows;
    $countBalance = mysqli_query($connect_tables, "SELECT * FROM balance");
    $amountBalance = $countBalance->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../assets/css/style.min.css">
    <title>Web App</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="top-bar">
                <a class="navbar-brand" href="#">Логотип</a>
                <div class="right-block">
                    <?php include_once './inc/user-settings.php';?>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <?php include_once './inc/sidebar.php';?>
        <section class="content">
            <div class="container">
                <h2 class="page__title"><span class="icon material-icons">border_all</span>Панель</h2>
                <div class="row">
                    <div class="col">
                        <div class="left-block">
                            <h4 class="col__title">Приход</h4>
                            <span class="numbers" id="coming"><?= $amountComing; ?></span>
                        </div>
                        <span class="material-icons icon bg-green">trending_up</span>
                        <div class="old-week">
                            <p class="old-week-name">На прошлой неделе: <span class="value">6</span></p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="left-block">
                            <h4 class="col__title">Расход</h4>
                            <span class="numbers" id="consum"><?= $amountExpens; ?></span>
                        </div>
                        <span class="material-icons icon bg-red">trending_down</span>
                        <div class="old-week">
                            <p class="old-week-name">На прошлой неделе: <span class="value">6</span></p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="left-block">
                            <h4 class="col__title">Остаток</h4>
                            <span class="numbers" id="balance"><?= $amountBalance; ?></span>
                        </div>
                        <span class="material-icons icon bg-yellow">trending_flat</span>
                        <div class="old-week">
                            <p class="old-week-name">На прошлой неделе: <span class="value">6</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/app/js/mytables.js"></script>
    <script src="../assets/js/sidebar.js"></script>
</body>
</html>