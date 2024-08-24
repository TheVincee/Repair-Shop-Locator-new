<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form | Repair Shop</title>
    <link rel="stylesheet" href="Sign-in.css">
  </head>
<body>
  <div class="wrapper">
    <h2 class="login-heading">Login</h2>
    <form action="Authorize.php" method="POST" class="login-form">
      <div class="input-box email-box">
        <input type="text" name="email" class="email-input" placeholder="Enter your email" required>
      </div>
      <div class="input-box password-box">
        <input type="password" name="password" class="password-input" placeholder="Enter your password" required>
      </div>
      <div class="input-box button submit-box">
        <input type="submit" class="submit-button" value="Login Now">
      </div>
      <div class="text register-link">
        <h3>Don't have an account? <a href="Register.php">Register now</a></h3>
      </div>
    </form>
  </div>
</body>
</html>
