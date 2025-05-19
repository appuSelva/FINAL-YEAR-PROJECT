<?php
$con = mysqli_connect('localhost:4306', 'root', '', 'feedback');

if (isset($_POST['submit'])) {
    $client_name = $_POST['name'];
    $client_email = $_POST['email'];
    $worker_name = $_POST['worker'];
    $rating = $_POST['rating'];
    $message = $_POST['message'];

    $query = "INSERT INTO review (client_name, client_email, worker_name, rating, message) 
              VALUES ('$client_name', '$client_email', '$worker_name', '$rating', '$message')";

    if (mysqli_query($con, $query)) {
        $success = "🎉 Feedback submitted successfully!";
    } else {
        $error = "❌ Error: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Stylish Feedback</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card {
      background: #ffffff;
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 500px;
      animation: slideUp 0.6s ease-in-out;
    }

    @keyframes slideUp {
      from { transform: translateY(50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .card h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .form-group {
      margin-bottom: 15px;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      transition: all 0.3s ease;
      font-size: 16px;
    }

    input:focus, select:focus, textarea:focus {
      border-color: #2575fc;
      outline: none;
      box-shadow: 0 0 8px rgba(37,117,252,0.3);
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #2575fc;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #1a5ddb;
    }

    .message {
      text-align: center;
      margin-top: 15px;
      font-weight: bold;
    }

    @media (max-width: 600px) {
      .card {
        padding: 25px;
      }
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>Submit Your Feedback</h2>
    <form method="POST">
      <div class="form-group">
        <input type="text" name="name" placeholder="Your Name" required />
      </div>
      <div class="form-group">
        <input type="email" name="email" placeholder="Your Email" required />
      </div>
      <div class="form-group">
        <input type="text" name="worker" placeholder="Worker Name" required />
      </div>
      <div class="form-group">
        <select name="rating" required>
          <option value="">Select Rating</option>
          <option value="5">⭐️⭐️⭐️⭐️⭐️ - Excellent</option>
          <option value="4">⭐️⭐️⭐️⭐️ - Good</option>
          <option value="3">⭐️⭐️⭐️ - Average</option>
          <option value="2">⭐️⭐️ - Poor</option>
          <option value="1">⭐️ - Bad</option>
        </select>
      </div>
      <div class="form-group">
        <textarea name="message" placeholder="Your Message..." required></textarea>
      </div>
      <button type="submit" name="submit">Submit Feedback</button>

      <div class="message">
        <?php
        if (isset($success)) echo "<p style='color:green;'>$success</p>";
        if (isset($error)) echo "<p style='color:red;'>$error</p>";
        ?>
      </div>
    </form>
  </div>
</body>
</html>

