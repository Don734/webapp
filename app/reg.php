<?php 
    session_start();
    require_once './config/connect.php';

    $fullname = filter_var(trim($_POST['fullname']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['usermail']), FILTER_SANITIZE_EMAIL);
    $pass = filter_var(trim($_POST['userpass']), FILTER_SANITIZE_STRING);
    $passrep = filter_var(trim($_POST['userpassrep']), FILTER_SANITIZE_STRING);
    $date = Date('d.m.Y');

    if (mb_strlen($pass) < 4 || mb_strlen($pass) > 32) {
        $_SESSION['message'] = "Длина пароля недопустима!";
        header('Location: ../pages/signup.php');
        exit();
    }

    if ($pass === $passrep) {
        $pass = md5($pass."gasfdfwr1947");

        mysqli_query($connect, "INSERT INTO `users` (`email`, `pass`, `fullname`, `company`, `phone`, `position`, `date`) VALUES('$email', '$pass', '$fullname', ' ', ' ', ' ', '$date')");
        $_SESSION['message'] = 'Регистрация прошла успешно';
        header('Location: ../public/pages/signin.php');
    } else {
        $_SESSION['message'] = 'Пароли не совподают';
        header('Location: ../public/pages/signup.php');
        exit();
    }

    mysqli_close($connect);
?>