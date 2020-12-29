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
    <link rel="stylesheet" type="text/css" href="../assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="../assets/css/style.min.css">
    <title>Web App</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="top-bar">
                <a class="navbar-brand" href="#">Логотип</a>
                <div class="right-block">
                    <?php include_once './inc/user-settings.php'; ?>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <?php include_once './inc/sidebar.php'; ?>
        <section class="content">
            <h2 class="page__title"><span class="icon material-icons">trending_down</span>Расход</h2>
            <div class="container_table">
                <div class="table__col active" id="tbody_expens-wrap">
                    <table class="display" id="table_expens">
                        <tbody id="tbody_expens"></tbody>
                    </table>
                </div>
            </div>
        </section>
        <?php include_once './inc/modal.php'; ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../assets/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="../assets/js/jszip.min.js"></script>
    <script type="text/javascript" src="../assets/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="../assets/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="../assets/js/buttons.html5.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/modalOpen.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/app/js/mytables.js"></script>
</body>
</html>