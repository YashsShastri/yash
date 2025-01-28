<?php 
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Save to database
        $user_id = random_num(20);
        $query = "INSERT INTO users (user_id, user_name, password) VALUES ('$user_id', '$user_name', '$password')";

        mysqli_query($con, $query);

        header("Location: login.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      background-image: url('images/signup.jpg'); /* Add background image */
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    #box {
      background-color: rgba(255, 255, 255, 0.9);
      width: 300px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
    }
    #box h2 {
      font-size: 20px;
      margin: 10px;
      color: #333;
    }
    #text {
      height: 25px;
      border-radius: 5px;
      padding: 4px;
      border: solid thin #aaa;
      width: 100%;
      margin-bottom: 10px;
    }
    #button {
      padding: 10px;
      width: 100%;
      color: white;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    #button:hover {
      background-color: #0056b3;
    }
    #box a {
      display: block;
      text-align: center;
      margin-top: 10px;
      color: #007bff;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div id="box">
    <h2>Signup</h2>
    <form method="post">
      <input id="text" type="text" name="user_name" placeholder="Username"><br>
      <input id="text" type="password" name="password" placeholder="Password"><br>
      <input id="button" type="submit" value="Signup"><br>
      <a href="login.php">Click to Login</a>
    </form>
  </div>
</body>
</html>
