<?php 
    session_start();
    require_once './config/connect.php';

    $email = $_POST['signinemail'];
    $pass = $_POST['signinpass'];

    $pass = md5($pass."gasfdfwr1947");
    $result = mysqli_query($connect, "SELECT * FROM users WHERE `email` = '$email' AND `pass` = '$pass'");

    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user'] = [
            "userid" => $user['id'],
            "email" => $user['email'],
            "fullname" => $user['fullname'],
            "position" => $user['position'],
            "date" => $user['date']
        ];

        $userid = $_SESSION['user']['userid'];
        $groupname = $_SESSION['user']['position'];

        mysqli_query($connect, "INSERT IGNORE INTO `rights_group` SET `userid`='$userid', `groupid`=(SELECT groups.id FROM groups WHERE `groupname`='$groupname')");
        
        $_SESSION['status'] = 'В сети';
        header('Location: ../public/pages/dashboard.php');
    } else {
        $_SESSION['message'] = 'Не верный логин или пароль';
        header('Location: ../public/pages/signin.php');
        exit();
    }

    mysqli_close($connect);
?>