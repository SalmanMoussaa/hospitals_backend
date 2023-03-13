<?php
header('Access-Control-Allow-Origin: *');
include('connection.php');
$employee = $_POST['employee'];
$description = $_POST['description'];
$department = $_POST['department'];

$service = $mysqli->prepare('insert into services (patient_id, employee_id, description, department_id, cost, approved) values(?,?,?,?,?,?)');
$approved = 0;
$cost = '100';
$service->bind_param('iisisi', $decoded_payload->id, $employee, $description, $department, $cost, $approved);
$service->execute();
$service->store_result();
$response['status'] = 'requested';
echo json_encode($response);
?>