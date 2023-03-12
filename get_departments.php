<?php
header('Access-Control-Allow-Origin: *');
include('connection.php');
$departments= $mysqli->prepare('select id, name from departments');
$departments->execute();

$array = $departments->get_result();
$response = [];
while ($a = $array->fetch_assoc()) {
    $response[] = $a;
}
echo json_encode($response);

?>