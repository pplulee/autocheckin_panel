<?php
include("header.php");
$result = mysqli_query($conn, "SELECT id FROM tasks;");
if (mysqli_num_rows($result) == 0) {
    $data = array(
        'status' => 'fail',
        'message' => '没有任务'
    );
}else{
    $list = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row['id'];
    }
    $data = array(
        'status' => 'success',
        'id_list' => implode(",",$list)
    );
}
echo json_encode($data,JSON_UNESCAPED_UNICODE);
