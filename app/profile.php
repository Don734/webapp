<?php 
    session_start();
    require_once './config/connect.php';

    if (isset($_POST['key'])) {
        $editProfileId = mysqli_real_escape_string($connect, $_POST['profileID']);
        $fullname = filter_var(trim($_POST['fullname']), FILTER_SANITIZE_STRING);
        $companyname = filter_var(trim($_POST['companyname']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['usermail']), FILTER_SANITIZE_STRING);
        $phone = $_POST['userphone'];
        $oldpass = filter_var(trim($_POST['oldpass']), FILTER_SANITIZE_STRING);
        $newpass = filter_var(trim($_POST['newpass']), FILTER_SANITIZE_STRING);

        if ($_POST['key'] == 'editProfileData') {
            $sql = mysqli_query($connect, "SELECT `email`, `fullname`, `company`, `phone`, `position` FROM users WHERE id='$editProfileId'");
            $data = mysqli_fetch_array($sql);
            $jsonArray = array(
                'usermail' => $data['email'],
                'fullname' => $data['fullname'],
                'company' => $data['company'],
                'phone' => $data['phone'],
                'group' => $data['position']
            );

            exit(json_encode($jsonArray));
        }

        if ($_POST['key'] == 'updateProfile') {
            mysqli_query($connect, "UPDATE `users` SET `email`='$email', `fullname`='$fullname', `company`='$companyname', `phone`='$phone' WHERE id='$editProfileId'");
            
            $sql = mysqli_query($connect, "SELECT * FROM `users` WHERE id='$editProfileId' ");
            $data = mysqli_fetch_array($sql);

            $oldpass = md5($oldpass."gasfdfwr1947");

            if(!empty($oldpass) && !empty($newpass)) {
                if ($oldpass != $data['pass']) {
                    exit();
                } else {
                    $newpass = md5($newpass."gasfdfwr1947");
                    mysqli_query($connect, "UPDATE `users` SET `pass`='$newpass' WHERE id='$editProfileId'");
                }
            }
        }

        mysqli_close($connect);
    }
?>