<?php 
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Check if email address is from allowed domain
        if (strpos($user_name, '@pccoer.in') !== false) {
            $query = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                
                if ($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php"); // Redirect only upon successful login
                    die; // Terminate the script to prevent further execution
                }
            }
            $error_msg = "Wrong username or password!";
        } else {
            $error_msg = "Access Denied @pccoer.in domain only Allowed";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            background-image: url('images/login2.jpg'); /* Add background image */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #box {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            width: 320px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        #box form {
            text-align: center;
        }

        #box h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333333;
        }

        .input-field {
            height: 40px;
            border-radius: 5px;
            padding: 8px;
            border: solid 1px #ccc;
            width: 100%;
            margin-bottom: 20px;
        }

        #button {
            padding: 10px;
            width: 100%;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #button:hover {
            background-color: #0056b3;
        }

        #signup-link {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        #signup-link:hover {
            color: #0056b3;
        }

        #error-msg {
            margin-top: 10px;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div id="box">
    <form method="post">
        <h2>Login</h2>

        <input class="input-field" type="text" name="user_name" placeholder="Username"><br>
        <input class="input-field" type="password" name="password" placeholder="Password"><br>

        <input id="button" type="submit" value="Login"><br>
        <a id="signup-link" href="signup.php">Click to Signup</a>

        <?php if(isset($error_msg)): ?>
            <div id="error-msg"><?php echo $error_msg; ?></div>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
