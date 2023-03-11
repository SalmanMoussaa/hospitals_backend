<?php 
session_start();
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
include('connect.php');
$name =$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$dob=$_POST['dob'];
$usertype_id['usertype-id'];
$check_email = $mysqli->prepare('select email from users where email=?');
    $check_email->bind_param('s', $email);
    $check_email->execute();
    $check_email->store_result();
    $email_exists = $check_email->num_rows();
    if($email_exists > 0) {
        $response['status'] = 'email already exists';
        echo json_encode($response);
    } else {
        if(strlen($password) >= 8 && preg_match('/[A-Z]/', $password) && preg_match('/\d/', $password) && preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)
        && preg_match('/[a-z]/', $password)) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $query = $mysqli->prepare('insert into users(name, email, password,dob,usertype_id) values(?,?,?,?)');
            $query->bind_param('ssss', $first_name, $email, $hashed_password,$dob,$usertype_id);
            $query->execute();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = name;
            $_SESSION['user_id'] = $id;
            $response['status'] = 'user added';
            $response['name'] = $name;
            echo json_encode($response);

        } else {
            $response['status'] = 'password not validated';
            echo json_encode($response);
        }
    }

?>