<?php 
    session_start();
    require_once('config/connect.php');

    $user_id = $_SESSION['user']['userid'];

    $result = mysqli_query($connect, "SELECT * FROM `actions` WHERE `groupid` IN (SELECT `groupid` FROM `rights_group` WHERE `userid`='$user_id')");
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $result_arr[$row['action']] = $row['sign'];
        }
    }
?>