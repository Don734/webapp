<?php 
    session_start();
    require_once './config/connect.php';

    if (isset($_POST['key'])) {
        $dataFrom = $_POST['dataFrom'];
        $dataBy = $_POST['dataBy'];
        $part = $_POST['part'];
        $action = $_POST['action'];
        $projectRep = $_POST['projectRep'];
        $descriptionRep = $_POST['descriptionRep'];
        $nameRep = $_POST['nameRep'];
        $codeprodRep = $_POST['codeprodRep'];

        if ($_POST['key'] == 'filterData') {
            $sql = "SELECT * FROM editstory WHERE `date` BETWEEN '$dataFrom' AND '$dataBy'";
            
            $sqlFilter = mysqli_query($connect_tables, $sql);

            if (mysqli_num_rows($sqlFilter) > 0) {
                $response = "";
                while($dataFilter = mysqli_fetch_array($sqlFilter)) {
                    $response .= '
                        <tr>
                            <td>' . $dataFilter["date"] . '</td>
                            <td>' . $dataFilter["tablename"] . '</td>
                            <td>' . $dataFilter["action"] . '</td>
                            <td>' . $dataFilter["project"] . '</td>
                            <td>' . $dataFilter["description"] . '</td>
                            <td>' . $dataFilter["name"] . '</td>
                            <td>' . $dataFilter["codeprod"] . '</td>
                            <td>' . $dataFilter["unit"] . '</td>
                            <td>' . $dataFilter["count"] . '</td>
                            <td class="td-options">
                                <button class="btn-options" onclick="deleteData('.$dataFilter["id"].') "><span class="material-icons">remove</span></button>
                            </td>
                        </tr>
                    ';
                }
                
                exit($response);
            }

            exit('reachedMax');
        }
    }
?>