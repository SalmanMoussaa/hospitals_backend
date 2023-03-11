<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('connection.php');

$email = $_POST['email'];
$password = $_POST['password'];

$query = $mysqli->prepare('select * from users where email=? AND password=?');
$query->bind_param('ss', $email,$password);
$query->execute();
?>