<?php 
    session_start();
    require_once '../config/connect.php';
    require_once '../getRules.php';

    if ($_POST['key']) {
        $groupName = $_POST['groupname'];
        $editGroupDataID = mysqli_real_escape_string($connect, $_POST['groupID']);
        $checkboxvalue = $_POST['value'];
        $checkboxstate = $_POST['state'];
        $date = Date('d.m.Y');

        if ($_POST['key'] == 'addNewGroup') {
            if ($result_arr['addgroup'] == 'true') {
                if (empty($groupName)) {
                    $_SESSION['message'] = 'Вы ничего не ввели. Пожалуйста, заполните поля';
                    exit();
                }

                mysqli_query($connect, "INSERT INTO `groups` (`groupname`) VALUES('$groupName')");
            }
        }

        if ($_POST['key'] == 'getGroupData') {
            $start = mysqli_real_escape_string($connect, $_POST['start']);
            $limit = mysqli_real_escape_string($connect, $_POST['limit']);

            $sql = mysqli_query($connect, "SELECT * FROM groups LIMIT $start, $limit");

            if (mysqli_num_rows($sql) > 0) {
                $response = "";
                while($data = mysqli_fetch_array($sql)) {
                    $response .= '
                        <tr>
                            <td id="groupname_'. $data["id"] .'">' . $data["groupname"] . '</td>
                            <td class="td-options">
                                <button class="btn-options" onclick="editGroupData('.$data["id"].') "><span class="material-icons">create</span></button> 
                                <button class="btn-options" onclick="deleteGroup('.$data["id"].') "><span class="material-icons">remove</span></button>
                            </td>
                        </tr>
                    ';
                }

                exit($response);
            }

            exit('reachedMax');
        }

        if ($_POST['key'] == 'editGroupData') {
            $sql = mysqli_query($connect, "SELECT `groupname` FROM groups WHERE id='$editGroupDataID'");
            $sqlAction = mysqli_query($connect, "SELECT `action`, `sign` FROM actions WHERE groupid='$editGroupDataID'");
            $data = mysqli_fetch_array($sql);
            $responseAction = '';
            $responseSign = '';

            while ($row = mysqli_fetch_array($sqlAction)) {
                $responseAction .= $row['action'].'-';
                $responseSign .= $row['sign'].'-';
            };

            $jsonArray = array(
                'groupname' => $data['groupname'],
                'action' => $responseAction,
                'sign' => $responseSign
            );

            exit(json_encode($jsonArray));
        }

        if ($_POST['key'] == 'updateGroup') {
            if ($result_arr['editgroup'] == 'true') {
                if ($checkboxstate == 'true') {
                    mysqli_query($connect, "UPDATE actions SET `sign`='true' WHERE `groupid`='$editGroupDataID' AND `action`='$checkboxvalue'");
                } else if ($checkboxstate == 'false') {
                    mysqli_query($connect, "UPDATE actions SET `sign`='false' WHERE `groupid`='$editGroupDataID' AND `action`='$checkboxvalue'");
                }
    
                mysqli_query($connect, "UPDATE groups SET `groupname`='$groupName' WHERE `id`='$editGroupDataID'");
                exit('success');
            }
        }

        if ($_POST['key'] == 'deleteGroup') {
            if ($result_arr['deletegroup'] == 'true') {
                mysqli_query($connect, "DELETE FROM groups WHERE id='$editGroupDataID'");
                exit('Группа удалена.');
            }
        }

        mysqli_close($connect);
    }
?>