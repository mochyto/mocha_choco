<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../signin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = "../uploads/";
    $imageName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $imageName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Check if file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Move uploaded file to uploads folder
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Save chocolate details into database
            $stmt = $conn->prepare("INSERT INTO chocolates (name, type, price, description, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdss", $_POST['name'], $_POST['type'], $_POST['price'], $_POST['description'], $imageName);
            $stmt->execute();
            header('Location: admin_dashboard.php');
            exit;
        } else {
            echo "❌ Failed to upload image.";
        }
    } else {
        echo "❌ File is not a valid image.";
    }
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
      margin: 0;
    }
    form {
      background: white;
      padding: 30px;
      width: 400px;
      margin: auto;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    input, textarea, button {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      background-color: #28a745;
      color: white;
      border: none;
    }
    button:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <form method="post" enctype="multipart/form-data">
    <h2>➕ Add New Chocolate</h2>
    <input type="text" name="name" placeholder="Chocolate Name" required><br>
    <input type="text" name="type" placeholder="Type (e.g. Dark, Milk)"><br>
    <input type="number" step="0.01" name="price" placeholder="Price (RM)"><br>
    <textarea name="description" placeholder="Description" rows="3"></textarea><br>
    <input type="file" name="image" accept="image/*" required><br>
    <button type="submit">Add Chocolate</button><br>
    <a href="admin_dashboard.php">⬅️ Back to Dashboard</a>
  </form>
</body>
</html>
