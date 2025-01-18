<?php
session_start();
header("Content-Type: application/json");

require_once '../Model/ruleModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// Parse the JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['action'])) {
    echo json_encode(['success' => false, 'message' => 'Action not specified.']);
    exit;
}

$action = $data['action'];

switch ($action) {
    case 'add':
        if (isset($data['rule']) && !empty($data['rule'])) {
            $rule = $data['rule'];
            $result = addRule($rule);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Rule added successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add rule.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Rule text is required.']);
        }
        break;

    case 'edit':
        if (isset($data['serial'], $data['rule']) && !empty($data['rule']) && !empty($data['serial'])) {
            $serial = (int) $data['serial'];
            $rule = $data['rule'];
            $result = updateRule($serial, $rule);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Rule updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update rule.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Both serial and rule text are required.']);
        }
        break;

    case 'delete':
        if (isset($data['serial']) && !empty($data['serial'])) {
            $serial = (int) $data['serial'];
            $result = deleteRule($serial);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Rule deleted successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete rule.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Serial is required to delete a rule.']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action specified.']);
        break;
}
?>