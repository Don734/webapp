<?php 
    session_start();
    require_once '../config/connect.php';
    require_once '../getRules.php';

    if (isset($_POST['key'])) {
        $editUserDataID = mysqli_real_escape_string($connect, $_POST['userID']);
        $fullname = filter_var(trim($_POST['fullname']), FILTER_SANITIZE_STRING);
        $usermail = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
        $company = filter_var(trim($_POST['company']), FILTER_SANITIZE_STRING);
        $phone = $_POST['phone'];
        $groupname = $_POST['group'];
        $date = Date('d.m.Y');

        if ($_POST['key'] == 'addUser') {
            if ($result_arr['adduser'] == 'true') {
                if (empty($fullname) && empty($usermail) && empty($pass) && empty($phone) && empty($groupname)) {
                    $_SESSION['message'] = 'Вы ничего не ввели. Пожалуйста, заполните поля';
                    exit();
                }
    
                $pass = md5($pass."gasfdfwr1947");
                mysqli_query($connect, "INSERT INTO `users` (`email`, `pass`, `fullname`, `company`, `phone`, `position`, `date`) VALUES('$usermail', '$pass', '$fullname', '$company', '$phone', '$groupname', '$date')");
                $_SESSION['message'] = 'Пользователь добавлен.';
            }
        }

        if ($_POST['key'] == 'getUserData') {
            $start = mysqli_real_escape_string($connect, $_POST['start']);
            $limit = mysqli_real_escape_string($connect, $_POST['limit']);

            $sql = mysqli_query($connect, "SELECT `id`, `email`, `fullname`, `company`, `phone`, `position`, `date` FROM users LIMIT $start, $limit");

            if (mysqli_num_rows($sql) > 0) {
                $response = "";
                while($data = mysqli_fetch_array($sql)) {
                    $response .= '
                        <tr>
                            <td>' . $data["email"] . '</td>
                            <td id="fullname_'. $data["id"] .'">' . $data["fullname"] . '</td>
                            <td>' . $data["company"] . '</td>
                            <td>' . $data["phone"] . '</td>
                            <td>' . $data["position"] . '</td>
                            <td>' . $data["date"] . '</td>
                            <td class="td-options">
                                <button class="btn-options" onclick="editUserData('.$data["id"].') "><span class="material-icons">create</span></button> 
                                <button class="btn-options" onclick="deleteUserData('.$data["id"].') "><span class="material-icons">remove</span></button>
                            </td>
                        </tr>
                    ';
                }

                exit($response);
            }

            exit('reachedMax');
        }

        if ($_POST['key'] == 'editUserData') {
            $sql = mysqli_query($connect, "SELECT `email`, `pass`, `fullname`, `company`, `phone`, `position` FROM users WHERE id='$editUserDataID'");
            $data = mysqli_fetch_array($sql);
            $jsonArray = array(
                'usermail' => $data['email'],
                'userpass' => $data['pass'],
                'fullname' => $data['fullname'],
                'company' => $data['company'],
                'phone' => $data['phone'],
                'group' => $data['position']
            );

            exit(json_encode($jsonArray));
        }

        if ($_POST['key'] == 'updateUser') {
            if ($result_arr['edituser'] == 'true') {
                mysqli_query($connect, "UPDATE users SET `email`='$usermail', `fullname`='$fullname', `company`='$company', `phone`='$phone', `position`='$groupname' WHERE id='$editUserDataID'");
                $sql = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`='$editUserDataID'");
                $data = mysqli_fetch_array($sql);

                exit('success');
                
                if(!empty($pass)) {
                    $pass = md5($pass."gasfdfwr1947");
                    mysqli_query($connect, "UPDATE `users` SET `pass`='$pass' WHERE id='$editUserDataID'");
                    exit('Пароль изменён');
                }
            }
        }

        if ($_POST['key'] == 'deleteUserData') {
            if ($result_arr['deleteuser'] == 'true') {
                mysqli_query($connect, "DELETE FROM users WHERE id='$editUserDataID'");
                mysqli_query($connect, "DELETE FROM rights_group WHERE userid='$editUserDataID'");
                exit('Пользователь удалён.');
            }
        }

        mysqli_close($connect);
    }

    header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/public/pages/users');
?>