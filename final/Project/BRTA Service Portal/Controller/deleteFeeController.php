<?php
// Include fee model
require_once '../Model/feeModel.php';

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Extract data
$serial = $data['serial'];

// Delete fee
if (deleteFee($serial)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}
?>