<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mocha Choco</title>
  <link rel="stylesheet" href="style.css" />
  <style>
  body {
  font-family: Arial;
  background-image: url('https://s3.envato.com/files/190396147/preview%20image%20sweet%20candy%20world.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-color: #f0f0f0;
  padding-top: 60px;
  text-align: center;
  margin: 0;}
.auth-buttons {
  display: flex;
  justify-content: center;
  gap: 30px;
  flex-wrap: wrap;
  margin-top: 40px;
}

.btn {
  display: inline-block;
  background-color: #ff69b4; /* pink */
  border-radius: 15px;
  padding: 20px;
  text-align: center;
  width: 250px;
  box-shadow: 0 8px 15px rgba(0,0,0,0.2);
  text-decoration: none;
  transition: transform 0.3s, background-color 0.3s;
}

.btn:hover {
  transform: translateY(-8px);
  background-color: #d957a1;
}

.btn img {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border-radius: 50%;
  margin-bottom: 10px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.btn h3 {
  margin: 10px 0 5px;
  font-size: 1.3rem;
  color: white;
}

.btn p {
  color: #fff;
  font-size: 1rem;
}

h1 {
  color: #6b3e26;
  font-family: 'Comic Sans MS', cursive, sans-serif;
}

.footer-gif {
  margin-top: 90px;
}

@media (max-width: 600px) {
  .footer-gif {
    margin-top: 60px;
  }
}
  </style>
</head>
<body>
  <div class="container">
    <h1>Mocha Choco System</h1>
    <div class="auth-buttons">
        <a href="signin.php" class="btn">
          <img src="image/candy.png" alt="login" width="53%" height="53%"/>
          <h3>Login</h3>
          <p>Access your choco dashboard.</p>
        </a>

        <a href="signup.php" class="btn">
          <img src="image/user.png" alt="register"width="53%" height="53%" />
          <h3>Register</h3>
          <p>Create a new account.</p>
        </a>
    </div>
    <div class="footer-gif">
	  <p style="color: brown; font-weight: bold; font-size: 18px;">🍫 Ready to explore the sweetness?</p>
	  <img src="https://media4.giphy.com/media/31ltvCocTCYyk/giphy.gif" alt="choco GIF" width="300" />
	</div>
  </div>
</body>
</html>