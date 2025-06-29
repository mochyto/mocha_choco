<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['username'])) {
    header('Location: signin.php');
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $username = $_SESSION['username'];

    $stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");
    $stmt->bind_param("ss", $new_password, $username);

    if ($stmt->execute()) {
        $message = "✅ Password updated successfully.";
    } else {
        $message = "❌ Failed to update password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Password</title>
  <style>
    body {
      font-family: Arial;
      background: #f2f2f2;
      text-align: center;
      padding-top: 60px;
      background-image: url('https://media1.giphy.com/media/Jsi0pCShyVEo2xOjtJ/giphy.gif');
      background-size: cover;
      background-repeat: no-repeat;
    }
    form {
      background: white;
      padding: 30px;
      margin: auto;
      width: 320px;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    input, button {
      padding: 10px;
      width: 90%;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      background-color: #ffc107;
      color: #333;
      border: none;
    }
    button:hover {
      background-color: #e0a800;
    }
    .msg {
      margin-top: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <form method="POST">
    <h2>🔒 Update Password</h2>
    <input type="password" name="new_password" placeholder="New Password" required><br>
    <button type="submit">Update</button>
    <p class="msg"><?php echo $message; ?></p>
    <a href="<?php echo ($_SESSION['role'] === 'admin') ? 'admin/admin_dashboard.php' : 'user/user_dashboard.php'; ?>">⬅️ Back to Dashboard</a>
  </form>
</body>
</html>

