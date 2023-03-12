<?php 
header('Access-Control-Allow-Origin: *');
include('connection.php');
$hospitals= $mysqli->prepare('select id, name from hospitals');
$hospitals->execute();

$array = $hospitals->get_result();
$response = [];
while ($a = $array->fetch_assoc()) {
    $response[] = $a;
}
echo json_encode($response);

?>