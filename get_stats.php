<?php
header('Access-Control-Allow-Origin: *');
include('connect.php');


// Count the number of male employees
$male_employee_count = $mysqli->query('SELECT COUNT(*) AS n FROM users WHERE gender = "male" AND usertype_id = (SELECT id FROM user_types WHERE name = "employee")')->fetch_assoc()['n'];

// Count the number of female employees
$female_employee_count = $mysqli->query('SELECT COUNT(*) AS n FROM users WHERE gender = "female" AND usertype_id = (SELECT id FROM user_types WHERE name = "employee")')->fetch_assoc()['n'];

// Count the number of patients per hospital
$hospital_patient_counts = $mysqli->query('SELECT h.name, COUNT(hu.user_id) AS entry_count FROM hospital_users hu JOIN hospitals h ON hu.hospital_id = h.id WHERE is_active = "true" GROUP BY hospital_id')->fetch_all(MYSQLI_ASSOC);

// Build the response object
$response = [
    'count_females' => $female_employee_count,
    'count_males' => $male_employee_count,
    'hospitals' => $hospital_patient_counts,
];

// Send the response as JSON
echo json_encode($response);