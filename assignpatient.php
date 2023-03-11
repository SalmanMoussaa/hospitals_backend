<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $json_data = file_get_contents('php://input'); 
        $data = json_decode($json_data, true); 
        $hostpital_id = $data['hospital_id'];
        $user_id = $data['user_id'];
        $query = $mysqli->prepare('SELECT * FROM  hospital_users WHERE user_id = ?');
        $query->bind_param('i', $user_id);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();
        if (isset($data)) {
            $response = ['Patient is already assigned to a hospital'];
        } 
        
        else {
            $query = $mysqli->prepare('INSERT INTO hospital_users (hospital_id, user_id) VALUES (?, ?)');
            $query->bind_param('ss', $hospital_id, $user_id);
            $query->execute();
            $response = ['Patient assigned successfully'];
        }
        echo json_encode($response);
    }
}
?>