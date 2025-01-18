<?php
require_once 'db.php';

function addRule($rule)
{
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO rules (rules) VALUES (?)");
    $stmt->bind_param("s", $rule);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

function updateRule($serial, $rule)
{
    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE rules SET rules = ? WHERE serial = ?");
    $stmt->bind_param("si", $rule, $serial);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

function deleteRule($serial)
{
    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM rules WHERE serial = ?");
    $stmt->bind_param("i", $serial);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

function getAllRules()
{
    $conn = getConnection();
    $result = $conn->query("SELECT serial, rules FROM rules");
    $rules = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $rules;
}
?>