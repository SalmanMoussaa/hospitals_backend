<?php
header('Access-Control-Allow-Origin: *');
include('connection.php');
$id = $_GET['id'];

$query = $mysqli->prepare('select h.name, i.total_amount, i.date_issued from invoices i join hospitals h on i.hospital_id = h.id where user_id = ? ORDER BY date_issued DESC LIMIT 1');
$query->bind_param('i', $id);
$query->execute();

$array = $query->get_result();
$response = [];
while ($a = $array->fetch_assoc()) {
    $response[] = $a;
}
echo json_encode($response);
?>