<?php 
    session_start();
    require_once '../config/connect.php';
    require_once '../getRules.php';

    if (isset($_POST['key'])) {
        $rowID = mysqli_real_escape_string($connect_tables, $_POST['rowID']);
        $project_name = filter_var(trim($_POST['project']), FILTER_SANITIZE_STRING);
        $desc = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
        $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $score = filter_var(trim($_POST['score']), FILTER_SANITIZE_STRING);
        $codeproduct = filter_var(trim($_POST['codeproduct']), FILTER_SANITIZE_STRING);
        $count = $_POST['count'];
        $prev_count = $_POST['prev_count'];
        $unit = $_POST['unit'];
        $date = Date('d.m.Y');
        $dateTime = $date . Date(' H:m:s');

        if ($_POST['key'] == 'addNew') {
            if ($result_arr['addtable'] == 'true') {
                if (empty($project_name) && empty($desc) && empty($name) && empty($codeproduct) && empty($unit) && empty($count)) {
                    $_SESSION['message'] = 'Вы ничего не ввели. Пожалуйста, заполните поля';
                    exit();
                } else {
                    mysqli_query($connect_tables, "INSERT INTO `coming` (`project`, `description`, `name`, `score`, `codeprod`, `unit`, `prev_count`, `count`, `created_at`) VALUES('$project_name', '$desc', '$name', '$score', '$codeproduct', '$unit', '0', '$count', '$dateTime')");
                    mysqli_query($connect_tables, "INSERT INTO `expens` (`project`, `description`, `name`, `score`, `codeprod`, `unit`, `count`, `created_at`) VALUES('$project_name', '$desc', '$name', '$score', '$codeproduct', '$unit', '0', '$dateTime')");
                    mysqli_query($connect_tables, "INSERT INTO `editstory` (`date`, `tablename`, `action`, `project`, `description`, `name`, `score`, `codeprod`, `unit`, `count`) VALUES('$date', 'Приход', 'Создана', '$project_name', '$desc', '$name', '$score', '$codeproduct', '$unit', '$count')");
                    $_SESSION['message'] = 'Сохранено.';
                }
            }
        }

        if ($_POST['key'] == 'getComingData') {
            $start = mysqli_real_escape_string($connect_tables, $_POST['start']);
            $limit = mysqli_real_escape_string($connect_tables, $_POST['limit']);

            $sqlComing = mysqli_query($connect_tables, "SELECT * FROM coming LIMIT $start, $limit");

            if (mysqli_num_rows($sqlComing) > 0) {
                $response = "";
                while($dataComing = mysqli_fetch_array($sqlComing)) {
                    $response .= '
                        <tr>
                            <td id="project_'. $dataComing["id"] .'">' . $dataComing["project"] . '</td>
                            <td>' . $dataComing["description"] . '</td>
                            <td>' . $dataComing["name"] . '</td>
                            <td>' . $dataComing["score"] . '</td>
                            <td>' . $dataComing["codeprod"] . '</td>
                            <td>' . $dataComing["unit"] . '</td>
                            <td>' . $dataComing["prev_count"] . '</td>
                            <td>' . $dataComing["count"] . '</td>
                            <td>' . $dataComing["created_at"] . '</td>
                            <td class="td-options">
                                <button class="btn-options" onclick="editComing('.$dataComing["id"].') "><span class="material-icons">create</span></button> 
                                <button class="btn-options" onclick="deleteData('.$dataComing["id"].') "><span class="material-icons">remove</span></button>
                            </td>
                        </tr>
                    ';
                }
                exit($response);
            }

            exit('reachedMax');
        }

        if ($_POST['key'] == 'getExpensData') {
            $start = mysqli_real_escape_string($connect_tables, $_POST['start']);
            $limit = mysqli_real_escape_string($connect_tables, $_POST['limit']);

            $sqlExpens = mysqli_query($connect_tables, "SELECT * FROM expens LIMIT $start, $limit");

            if (mysqli_num_rows($sqlExpens) > 0) {
                $response = "";
                while($dataExpens = mysqli_fetch_array($sqlExpens)) {
                    $response .= '
                        <tr>
                            <td id="project_'. $dataExpens["id"] .'">' . $dataExpens["project"] . '</td>
                            <td>' . $dataExpens["description"] . '</td>
                            <td>' . $dataExpens["name"] . '</td>
                            <td>' . $dataExpens["score"] . '</td>
                            <td>' . $dataExpens["codeprod"] . '</td>
                            <td>' . $dataExpens["unit"] . '</td>
                            <td>' . $dataExpens["count"] . '</td>
                            <td>' . $dataExpens["created_at"] . '</td>
                            <td class="td-options">
                                <button class="btn-options" onclick="editExpens('.$dataExpens["id"].') "><span class="material-icons">create</span></button> 
                                <button class="btn-options" onclick="deleteData('.$dataExpens["id"].') "><span class="material-icons">remove</span></button>
                            </td>
                        </tr>
                    ';
                }
                exit($response);
            }

            exit('reachedMax');
        }

        if ($_POST['key'] == 'getBalanceData') {
            $start = mysqli_real_escape_string($connect_tables, $_POST['start']);
            $limit = mysqli_real_escape_string($connect_tables, $_POST['limit']);

            $sqlBalance = mysqli_query($connect_tables, "SELECT * FROM balance LIMIT $start, $limit");

            if (mysqli_num_rows($sqlBalance) > 0) {
                $response = "";
                while($dataBalance = mysqli_fetch_array($sqlBalance)) {
                    $response .= '
                        <tr>
                            <td id="project_'. $dataBalance["id"] .'">' . $dataBalance["project"] . '</td>
                            <td>' . $dataBalance["description"] . '</td>
                            <td>' . $dataBalance["name"] . '</td>
                            <td>' . $dataBalance["score"] . '</td>
                            <td>' . $dataBalance["codeprod"] . '</td>
                            <td>' . $dataBalance["unit"] . '</td>
                            <td>' . $dataBalance["count"] . '</td>
                            <td>' . $dataBalance["created_at"] . '</td>
                            <td class="td-options">
                                <input class="btn-options" type="hidden" onload="editBalance('.$dataBalance["id"].') "></input> 
                                <button class="btn-options" onclick="deleteData('.$dataBalance["id"].') "><span class="material-icons">remove</span></button>
                            </td>
                        </tr>
                    ';
                }
                exit($response);
            }

            exit('reachedMax');
        }

        if ($_POST['key'] == 'getStoryData') {
            $start = mysqli_real_escape_string($connect_tables, $_POST['start']);
            $limit = mysqli_real_escape_string($connect_tables, $_POST['limit']);

            $sqlStory = mysqli_query($connect_tables, "SELECT * FROM editstory LIMIT $start, $limit");

            if (mysqli_num_rows($sqlStory) > 0) {
                $response = "";
                while($dataStory = mysqli_fetch_array($sqlStory)) {
                    $response .= '
                        <tr>
                            <td>' . $dataStory["date"] . '</td>
                            <td id="tablename_'. $dataStory["id"] .'">' . $dataStory["tablename"] . '</td>
                            <td>' . $dataStory["action"] . '</td>
                            <td>' . $dataStory["project"] . '</td>
                            <td>' . $dataStory["description"] . '</td>
                            <td>' . $dataStory["name"] . '</td>
                            <td>' . $dataStory["score"] . '</td>
                            <td>' . $dataStory["codeprod"] . '</td>
                            <td>' . $dataStory["unit"] . '</td>
                            <td>' . $dataStory["count"] . '</td>
                            <td class="td-options">
                                <button class="btn-options" onclick="deleteData('.$dataStory["id"].') "><span class="material-icons">remove</span></button>
                            </td>
                        </tr>
                    ';
                }
                exit($response);
            }

            exit('reachedMax');
        }

        if ($_POST['key'] == 'getRowComingData') {
            $rowID = mysqli_real_escape_string($connect_tables, $_POST['rowID']);
            $sql = mysqli_query($connect_tables, "SELECT * FROM coming WHERE id='$rowID'");
            $data = mysqli_fetch_array($sql);
            $jsonArray = array(
                'project' => $data['project'],
                'description' => $data['description'],
                'name' => $data['name'],
                'score' => $data['score'],
                'codeprod' => $data['codeprod'],
                'unit' => $data['unit'],
                'count' => $data['count'],
            );

            exit(json_encode($jsonArray));
        }

        if ($_POST['key'] == 'getRowExpensData') {
            $rowID = mysqli_real_escape_string($connect_tables, $_POST['rowID']);
            $sql = mysqli_query($connect_tables, "SELECT * FROM expens WHERE id='$rowID'");
            $data = mysqli_fetch_array($sql);
            $jsonArray = array(
                'project' => $data['project'],
                'description' => $data['description'],
                'name' => $data['name'],
                'score' => $data['score'],
                'codeprod' => $data['codeprod'],
                'unit' => $data['unit'],
                'count' => $data['count']
            );

            exit(json_encode($jsonArray));
        }

        if ($_POST['key'] == 'updateComingData') {
            if ($result_arr['edittable'] == 'true') {
                $sum = $count + $prev_count;
                mysqli_query($connect_tables, "UPDATE coming SET `project`='$project_name', `description`='$desc', `name`='$name', `score`='$score', `codeprod`='$codeproduct', `unit`='$unit', `prev_count`='$prev_count', `count`='$sum' WHERE id='$rowID'");
                mysqli_query($connect_tables, "INSERT INTO `editstory` (`date`, `tablename`, `action`, `project`, `description`, `name`, `score`, `codeprod`, `unit`, `count`) VALUES('$date', 'Приход', 'Изменена', '$project_name', '$desc', '$name', '$score', '$codeproduct', '$unit', '$count')");
                exit('success');
            }
        }

        if ($_POST['key'] == 'updateExpensData') {
            if ($result_arr['edittable'] == 'true') {
                mysqli_query($connect_tables, "UPDATE expens SET `count`='$count' WHERE id='$rowID'");
                // mysqli_query($connect_tables, "UPDATE coming INNER JOIN expens ON coming.id = expens.id INNER JOIN balance ON balance.id = coming.id SET balance.count = coming.count - expens.count");
                mysqli_query($connect_tables, "INSERT INTO `balance` SET `project`='$project_name', `description`='$desc', `name`='$name', `score`='$score', `codeprod`='$codeproduct', `unit`='$unit', `count` = (SELECT coming.count - expens.count FROM coming, expens WHERE coming.id=expens.id), `created_at`='$dateTime'");
                mysqli_query($connect_tables, "INSERT INTO `editstory` (`date`, `tablename`, `action`, `project`, `description`, `name`, `score`, `codeprod`, `unit`, `count`) VALUES('$date', 'Расход', 'Изменена', '$project_name', '$desc', '$name', '$score', '$codeproduct', '$unit', '$count')");
                mysqli_query($connect_tables, "INSERT INTO `editstory` SET `date`='$date', `tablename`='Остаток', `action`='Изменена', `project`='$project_name', `description`='$desc', `name`='$name', `score`='$score', `codeprod`='$codeproduct', `unit`='$unit', `count` = (SELECT `count` FROM balance WHERE id='$rowID')");
                exit('success');
            }
        }

        if ($_POST['key'] == 'deleteRow') {
            if ($result_arr['deletetable'] == 'true') {
                mysqli_query($connect_tables, "DELETE FROM coming WHERE id='$rowID'");
                mysqli_query($connect_tables, "DELETE FROM expens WHERE id='$rowID'");
                mysqli_query($connect_tables, "DELETE FROM balance WHERE id='$rowID'");
                mysqli_query($connect_tables, "DELETE FROM editstory WHERE id='$rowID'");
                exit('Таблица удалена');
            }
        }

        mysqli_close($connect_tables);
    }
?>