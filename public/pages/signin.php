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
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/public/assets/css/style.min.css">

    <title>Авторизация</title>
</head>
<body>
    <main class="main">
        <section class="sign-block">
            <div class="brand"><h1>Логотип</h1></div>
            <div class="form-block">
                <h2 class="form-header">Авторизация</h2>
                <form class="signup-form" action="../../app/auth.php" method="POST">
                    <div class="form__col">
                        <input class="form__input" type="email" name="signinemail" placeholder="Email">
                        <input class="form__input" type="password" name="signinpass" placeholder="Пароль">
                    </div>
                    <div class="form__col">
                        <input id="remember" type="checkbox" name="remember">
                        <label for="remember">Запомнить пароль?</label>
                    </div>
                    <div class="btn-block">
                        <input class="form__submit" type="submit" name="signin" value="Войти">
                    </div>
                </form>
            </div>
            <?php if ($_SESSION['message']) {
                    echo '<p class="msg-error">' . $_SESSION['message'] . '</p>';
                }
            unset($_SESSION['message']); ?>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/app/js/signin.js"></script> -->
</body>
</html>