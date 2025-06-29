<?php
include 'includes/db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $repassword = $_POST['repassword'];
    $role       = strtolower($_POST['role']);

    if ($password !== $repassword) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='signin.php';</script>";
        } else {
            $error = "Username may already exist.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Register</title>
<style>
   body {
  font-family: Arial;
background-image: url('image/index.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-color: #f0f0f0;
  padding-top: 60px;
  text-align: center;
  margin: 0;}
    form { background: white; padding: 30px; margin: auto; width: 300px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    input, button { padding: 10px; width: 90%; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
    button { background-color: #4a90e2; color: white; border: none; }
    button:hover { background-color: #357abd; }
    .error { color: red; font-weight: bold; }
  </style>
</head>
<body>
<form method="post">
  <h2>🍬Register🍫</h2>
  <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <input type="text" name="username" placeholder="Username" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <input type="password" name="repassword" placeholder="Confirm Password" required><br>
  <select name="role" required>
    <option value="">Select Role</option>
    <option value="user">User</option>
    <option value="admin">Admin</option>
  </select><br>
  <button type="submit">Register</button>
  <p>Have an account? <a href="signin.php">Login in</a></p>

</form>
</body>
</html>