<?php
header('Access-Control-Allow-Origin: *');
include('connection.php');
$id = $_GET['id'];

$employees = $mysqli->prepare('select user_id, blood_type, EHR from patients_info where user_id = ?');
$employees->bind_param('i', $id);
$employees->execute();
$array = $employees->get_result();
$response = [];
while ($a = $array->fetch_assoc()) {
    $response[] = $a;
}
echo json_encode($response);
?>