<?php
// Start session (if needed later)
session_start();

// Connect to database
$con = mysqli_connect("localhost:4306", "root", "", "app");

// Error handling if connection fails
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['mail'];
    $password = $_POST['pass'];

    $query = "SELECT * FROM mydata WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        $error = "Query failed: " . mysqli_error($con);
    } elseif (mysqli_num_rows($result) == 1) {
        // Redirect to work.php if login is successful
        header("Location: work.html");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            color: #555;
            font-size: 14px;
        }
        input[type="text"], input[type="password"] {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h1>Login</h1>
    <form method="POST">
        <label>Email:</label>
        <input type="text" name="mail" required><br>
        <label>Password:</label>
        <input type="password" name="pass" required><br>
        <input type="submit" name="login" value="Login">
    </form>
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
</div>
</body>
</html>
