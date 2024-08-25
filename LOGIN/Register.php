<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | Repair Shop</title>
    <link rel="stylesheet" href="Register.css">
</head>
<body>
    <div class="wrapper">
        <h2>Registration</h2>
        <form action="Registration.php" method="POST">
            <div class="input-box">
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="input-box">
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Create password" required>
            </div>
            <div class="input-box">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
            </div>
            <div class="input-box button">
                <input type="submit" value="Register Now">
            </div>
            <div class="text">
                <h3>Already have an account? <a href="Sign-in.php">Login now</a></h3>
            </div>
        </form>
    </div>
</body>
</html>
