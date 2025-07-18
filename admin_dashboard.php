<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../signin.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: url('https://t4.ftcdn.net/jpg/05/86/18/45/360_F_586184532_thNfTl3KCozijQBOlDNVhiS3JFieYD27.jpg');
      color: #333;
	   background-size: cover;
		  background-position: center;
		  background-repeat: no-repeat;
		  background-attachment: fixed;
		  padding-top: 60px;
		  text-align: center;
		  margin: 0;
    }
    header {
      background-color: #964b00 ;
      color: white;
      padding: 20px;
      text-align: center;
    }
    main {
      max-width: 800px;
      margin: 30px auto;
      padding: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h2 {
      margin-top: 0;
    }
    .top-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .btn {
      background-color: #8b4513;
      color: white;
      padding: 8px 15px;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
    }
    .btn:hover {
      background-color: #357abd;
    }
    .card {
      background: #f9f9f9;
      border: 1px solid #ddd;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 15px;
    }
    .card h3 {
      margin: 0 0 5px;
    }
    .card p {
      margin: 0 0 10px;
    }
    .actions a {
      margin-right: 10px;
      text-decoration: none;
      color: #4a90e2;
    }
    .actions a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <header>
    <h1>🍫 Mocha Choco Admin Dashboard</h1>
  </header>
  <main>
    <div class="top-nav">
      <h2>Welcome, <?php echo $_SESSION['username']; ?> 🐝💖</h2>
      <div>
        <a href="add_product.php" class="btn">+ Add Product</a>
        <a href="../logout.php" class="btn">Logout</a>
      </div>
    </div>

    <h3>Chocolate Product List</h3>
    <?php
    $sql = "SELECT * FROM chocolates";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card'>
            <h3>{$row['name']}</h3>
		    <img src='../image/{$row['image']}' alt='{$row['name']}' style='width:100%; max-width:250px; border-radius:10px; margin-bottom:10px;' />
            <p><strong>Type:</strong> {$row['type']} | <strong>Price:</strong> RM{$row['price']}</p>
            <p>{$row['description']}</p>
            <div class='actions'>
              <a href='edit_product.php?id={$row['id']}'>✏️ Edit</a>
              <a href='delete_product.php?id={$row['id']}' onclick=\"return confirm('Are you sure to delete this product?')\">🗑️ Delete</a>
            </div>
        </div>";
    }
    ?>
  </main>
</body>
</html>
