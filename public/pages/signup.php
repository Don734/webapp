<?php session_start();

    if ($_SESSION['user']) {
        header('Location: dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../assets/css/style.min.css">

    <title>Регистрация</title>
</head>
<body>
    <main class="main">
        <section class="sign-block">
            <div class="brand"><h1>Логотип</h1></div>
            <div class="form-block">
                <h2 class="form-header">Регистрация</h2>
                <form class="signup-form" action="" method="POST">
                    <input class="form__input" type="text" name="fullname" placeholder="Имя и Фамилия">
                    <input class="form__input" type="email" name="usermail" placeholder="Email">
                    <input class="form__input" type="password" name="userpass" placeholder="Пароль">
                    <input class="form__input" type="password" name="userpassrep" placeholder="Повторите пароль">
                    <div class="btn-block">
                        <a class="form__link" href="./signin.php">Вход</a>
                        <input class="form__submit" type="submit" name="signup" value="Зарегистрироваться">
                    </div>
                </form>
            </div>
            <?php if ($_SESSION['message']) {
                    echo '<p class="msg-error">' . $_SESSION['message'] . '</p>';
                }
            unset($_SESSION['message']); ?>
        </section>
    </main>
</body>
</html>