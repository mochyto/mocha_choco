<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../signin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO chocolates (name, type, price, description, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $_POST['name'], $_POST['type'], $_POST['price'], $_POST['description'], $_POST['image']);
    $stmt->execute();
    header('Location: admin_dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Chocolate</title>
  <style>
body {
  font-family: Arial;
  background-image: url('https://mochimochiland.com/wp-content/uploads/sugar_hor.gif');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  padding-top: 60px;
  text-align: center;
  margin: 0;}
    form { 
	background: white; 
	padding: 30px; 
	width: 400px; 
	margin: auto; 
	border-radius: 10px; 
	box-shadow: 0 0 8px rgba(0,0,0,0.1); }
	
    input, textarea, button { 
	width: 90%; 
	padding: 10px; margin: 10px 0; 
	border-radius: 5px; 
	border: 1px solid #ccc; }
	
    button { 
	background-color: #28a745; 
	color: white; 
	border: none; }
	
    button:hover { background-color: #218838; }
  </style>
</head>
<body>
  <form method="post">
    <h2>➕ Add New Chocolate</h2>
    <input type="text" name="name" placeholder="Chocolate Name" required><br>
    <input type="text" name="type" placeholder="Type (e.g. Dark, Milk)"><br>
    <input type="number" step="0.01" name="price" placeholder="Price (RM)"><br>
    <textarea name="description" placeholder="Description" rows="3"></textarea><br>
    <input type="text" name="image" placeholder="Image filename (optional)"><br>
    <button type="submit">Add Chocolate</button><br>
    <a href="admin_dashboard.php">⬅️ Back to Dashboard</a>
  </form>
</body>
</html>
