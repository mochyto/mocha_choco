<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../signin.php');
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM chocolates WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE chocolates SET name=?, type=?, price=?, description=?, image=? WHERE id=?");
    $stmt->bind_param("ssdssi", $_POST['name'], $_POST['type'], $_POST['price'], $_POST['description'], $_POST['image'], $id);
    $stmt->execute();
    header("Location: admin_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Chocolate</title>
  <style>
	body {
  font-family: Arial;
  background-image: url('https://media.giphy.com/media/PqASLvTK3DRjq/giphy.gif');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  padding-top: 60px;
  text-align: center;
  margin: 0;}
    form { background: white; padding: 30px; width: 400px; margin: auto; border-radius: 10px; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
    input, textarea, button { width: 90%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
    button { background-color: #ffc107; color: black; border: none; }
    button:hover { background-color: #e0a800; }
  </style>
</head>
<body>
  <form method="post">
    <h2>✏️ Edit Chocolate</h2>
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>
    <input type="text" name="type" value="<?php echo $product['type']; ?>"><br>
    <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>"><br>
    <textarea name="description" rows="3"><?php echo $product['description']; ?></textarea><br>
    <input type="text" name="image" value="<?php echo $product['image']; ?>"><br>
    <button type="submit">Update Chocolate</button><br>
    <a href="admin_dashboard.php">⬅️ Back to Dashboard</a>
  </form>
</body>
</html>
