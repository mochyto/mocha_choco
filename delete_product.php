<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../signin.php');
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM chocolates WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin_dashboard.php");
exit;
?>