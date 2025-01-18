<?php
// Include fee model
require_once '../Model/feeModel.php';

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Extract data
$serial = $data['serial'];
$application_name = $data['application_name'];
$application_cost = $data['application_cost'];

// Update fee
if (updateFee($serial, $application_name, $application_cost)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}
?>