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
    <link rel="stylesheet" href="../assets/css/style.min.css">
    <title>Аккаунт</title>
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
        <?php 
            include_once './inc/sidebar.php';
            $userid = $_SESSION['user']['userid'];
        ?>
        <section class="content">
            <div class="container">
                <h2 class="page__title"><span class="icon material-icons">account_circle</span>Управление аккаунтом</h2>
                <div class="wrapper">
                    <div class="avatar-block">
                        <div class="avatar"><img class="avatar__img" src="../assets/img/favicon.ico" alt="Аватарка"></div>
                        <p class="user-name" id="user-name"></p>
                        <p class="user-pos" id="user-pos"></p>
                        <form id="avatar-form" action="">
                            <label class="input-name" for="myFoto">Выберите фото профиля:</label>
                            <input class="input-file" type="file" name="myFoto" value="Обзор">
                        </form>
                        <p class="date-reg" id="date-reg">Дата регистрации: <span id="date"><?= $_SESSION['user']['date'] ?></span></p>
                    </div>
                    <div class="form-block">
                        <div class="form-header">
                            <p class="form-header-text">Настройки аккаунта</p>
                        </div>
                        <form class="user-forms" method="POST">
                            <h4 class="input-header">Персональная информация:</h4>
                            <div class="col-info">
                                <input class="input-form" id="username" type="text" name="username" placeholder="Имя Фамилия">
                                <input class="input-form" id="companyname" type="text" name="companyname" placeholder="Компания">
                                <input class="input-form" id="birthday" type="text" name="birthday" placeholder="Дата рождения">
                                <input class="input-form" id="userpos" type="text" name="userpos" placeholder="Должность">
                                <input class="input-form" id="editProfileID" type="hidden" name="editProfileID" value="<?php echo $userid ?>">
                            </div>
                            <h4 class="input-header">Контактная информация:</h4>
                            <div class="col-info">
                                <input class="input-form" id="email" type="email" name="email" placeholder="Почта">
                                <input class="input-form" id="phone" type="text" name="phone" placeholder="Телефон">
                            </div>
                            <h4 class="input-header">Дополнительная информация:</h4>
                            <div class="col-info">
                                <textarea class="input-form text-form" id="aboutText" name="aboutText" placeholder="О себе"></textarea>
                                <input class="input-form" id="website" type="text" name="website" placeholder="Сайт">
                            </div>
                            <h4 class="input-header">Управление паролями:</h4>
                            <div class="col-info">
                                <input class="input-form" id="oldpass" type="password" name="oldpassword" placeholder="Старый пароль">
                                <input class="input-form" id="newpass" type="password" name="newpassword" placeholder="Новый пароль">
                            </div>
                            <input class="form-submit" id="saveprofile" type="submit" value="Сохранить">
                        </form>
                    </div>
                    <?php if ($_SESSION['message']) {
                        echo '<p class="msg-error">' . $_SESSION['message'] . '</p>';
                    }

                    unset($_SESSION['message']); ?>
                </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/app/js/profileuser.js"></script>
</body>
</html>