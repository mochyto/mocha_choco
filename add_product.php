<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../signin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $imageName = null;

    // Handle image upload if exists
    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "../uploads/";
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);

        if ($check !== false) {
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
        } else {
            $imageName = null; // If not valid image
        }
    }

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO chocolates (name, type, price, description, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $name, $type, $price, $description, $imageName);
    $stmt->execute();

    header('Location: admin_dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Chocolate</title>
  <link rel="stylesheet" href="../style.css" /> <!-- Optional external CSS -->
  <style>
    body {
      font-family: Arial;
      background: linear-gradient(to bottom right, #ffe6f0, #ccffff);
      background-attachment: fixed;
      padding: 50px 20px;
      margin: 0;
    }

    .form-container {
      max-width: 500px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
      text-align: left;
    }

    input[type="text"],
    input[type="number"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    button {
      padding: 12px;
      width: 48%;
      border: none;
      border-radius: 6px;
      margin-top: 20px;
      font-size: 16px;
      cursor: pointer;
    }

    .submit-btn {
      background-color: #28a745;
      color: white;
    }

    .cancel-btn {
      background-color: #6c757d;
      color: white;
    }

    .btn-group {
      display: flex;
      justify-content: space-between;
    }

    a {
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <form method="post" enctype="multipart/form-data">
      <h2>🍫 Add New Chocolate</h2>

      <label for="name">Chocolate Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="type">Type:</label>
      <input type="text" id="type" name="type" placeholder="e.g. Milk, Dark">

      <label for="price">Price (RM):</label>
      <input type="number" id="price" name="price" step="0.01">

      <label for="description">Description:</label>
      <textarea id="description" name="description" rows="3"></textarea>

      <label for="image">Upload Image (optional):</label>
      <input type="file" id="image" name="image" accept="image/*">

      <div class="btn-group">
        <button type="submit" class="submit-btn">Add Chocolate</button>
        <a href="admin_dashboard.php"><button type="button" class="cancel-btn">Cancel</button></a>
      </div>
    </form>
  </div>
</body>
</html>
