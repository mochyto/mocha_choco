<?php
session_start();
include 'includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $role     = trim($_POST['role']);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = ?");
        $stmt->bind_param("ss", $username, $role);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            if ($role === "admin") {
                if ($password === "123") {
                    $_SESSION['id']       = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role']     = $row['role'];
                    header("Location: admin/admin_dashboard.php");
                    exit;
                } else {
                    echo "<script>alert('❌ Incorrect admin password');</script>";
                }
            } else {
                if ($password === $row['password']) {
                    $_SESSION['id']       = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role']     = $row['role'];
                    header("Location: user/user_dashboard.php");
                    exit;
                } else {
                    echo "<script>alert('❌ Invalid password');</script>";
                }
            }
        } else {
            echo "<script>alert('❌ Login failed. Username or role incorrect');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login - Mocha Choco</title>
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
  </style></head>
<body>
<form method="post">
  <h2>🍫 Mocha Choco Login</h2>
  <input type="text" name="username" placeholder="Username" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <select name="role" required>
    <option value="">-- Select Role --</option>
    <option value="admin">Admin</option>
    <option value="user">User</option>
  </select><br>
  <button type="submit" name="login">Login</button>
  <p>Don't have an account? <a href="signup.php">Register</a></p>
</form>

</body>
</html>
