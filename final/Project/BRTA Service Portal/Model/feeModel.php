<?php
require_once 'db.php';

// Add a new fee
function addFee($application_name, $application_cost)
{
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO application_fees (application_name, application_cost) VALUES (?, ?)");
    $stmt->bind_param("sd", $application_name, $application_cost);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

// Update an existing fee
function updateFee($serial, $application_name, $application_cost)
{
    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE application_fees SET application_name = ?, application_cost = ? WHERE serial = ?");
    $stmt->bind_param("sdi", $application_name, $application_cost, $serial);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

// Delete a fee
function deleteFee($serial)
{
    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM application_fees WHERE serial = ?");
    $stmt->bind_param("i", $serial);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

// Get all fees
function getAllFees()
{
    $conn = getConnection();
    $result = $conn->query("SELECT * FROM application_fees");
    $fees = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $fees;
}
?>