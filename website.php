<?php
$con = mysqli_connect('localhost:4306', 'root', '', 'app');

if (isset($_POST['sb'])) {
    $name = $_POST['name'];
    $email = $_POST['mail'];
    $password = $_POST['pass'];
    $confirm = $_POST['confirm'];

    // Server-side email and password format validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        $error = "Password must be at least 8 characters long, contain uppercase, lowercase, number and special character.";
    } elseif ($password !== $confirm) {
        $error = "Password and Confirm Password do not match.";
    } else {
        $query = "INSERT INTO mydata (name, email, password) VALUES ('$name', '$email', '$password')";
        $execute = mysqli_query($con, $query);

        if ($execute) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Error inserting data: " . mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <style>
    body {
        font-family: Arial;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    h1 { text-align: center; color: #333; }
    form {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        max-width: 400px;
        width: 100%;
    }
    input[type="text"], input[type="password"] {
        width: 95%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    input[type="submit"] {
        width: 100%;
        padding: 12px;
        background: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    .show-password {
        font-size: 14px;
        margin-top: 5px;
        color: #555;
    }
    .error {
        color: red;
        margin-top: 10px;
    }
  </style>
</head>
<body>
<div class="signup-container">
  <h1>SIGN UP</h1>
  <form method="POST" onsubmit="return validateForm()">
    <label>Name:</label>
    <input type="text" name="name" required><br>

    <label>Email:</label>
    <input type="text" name="mail" id="emailField" required><br>

    <label>Password:</label>
    <input type="password" name="pass" id="passField" required><br>

    <label>Confirm Password:</label>
    <input type="password" name="confirm" id="confirmField" required><br>

    <label class="show-password">
      <input type="checkbox" onclick="togglePassword()"> Show Password
    </label>

    <input type="submit" name="sb" value="Submit">
  </form>

  <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
</div>

<script>
function togglePassword() {
  const pass = document.getElementById("passField");
  const confirm = document.getElementById("confirmField");
  const type = pass.type === "password" ? "text" : "password";
  pass.type = type;
  confirm.type = type;
}

function validateForm() {
  const email = document.getElementById("emailField").value;
  const password = document.getElementById("passField").value;
  const confirm = document.getElementById("confirmField").value;

  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

  if (!emailPattern.test(email)) {
    alert("Invalid email format.");
    return false;
  }

  if (!passwordPattern.test(password)) {
    alert("Password must be at least 8 characters, with uppercase, lowercase, number and special character.");
    return false;
  }

  if (password !== confirm) {
    alert("Password and Confirm Password do not match.");
    return false;
  }

  return true;
}
</script>
</body>
</html>

