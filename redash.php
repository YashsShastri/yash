<?php
session_start();

include("connection.php");
include("functions.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit; // Stop further execution
}

// Fetch user data from login_db
$user_id = $_SESSION['user_id'];
$sql_user = "SELECT user_name FROM users WHERE user_id = '$user_id'";
$result_user = mysqli_query($con, $sql_user);

// Check if user data exists
if (mysqli_num_rows($result_user) > 0) {
    // Fetch user name
    $user_data = mysqli_fetch_assoc($result_user);
} else {
    $user_data = array(); // Empty array if user data not found
}

// Fetch data from votedata table
$sql_vote = "SELECT candidate, COUNT(*) AS vote_count FROM votedata GROUP BY candidate";
$result_vote = mysqli_query($con, $sql_vote);

// Fetch data from revotedata table
$sql_revote = "SELECT candidate, COUNT(*) AS revote_count FROM revotedata GROUP BY candidate";
$result_revote = mysqli_query($con, $sql_revote);

// Initialize an empty array to store merged data
$merged_data = array();

// Merge data from votedata and revotedata tables
while ($row = mysqli_fetch_assoc($result_vote)) {
    $candidate = $row['candidate'];
    $merged_data[$candidate]['vote_count'] = $row['vote_count'];
}

while ($row = mysqli_fetch_assoc($result_revote)) {
    $candidate = $row['candidate'];
    $merged_data[$candidate]['revote_count'] = $row['revote_count'];
}

// Close connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <style>
    /* CSS for Dashboard */

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url('images/welvote.png'); /* Background image path */
      background-size: cover;
      background-position: center;
    }

    .dashboard-container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #f0f0f0;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    h1 {
      margin: 0;
      font-size: 24px;
    }

    .logout-button {
      padding: 8px 16px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .logout-button:hover {
      background-color: #0056b3;
    }

    .revote-button {
      padding: 8px 16px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .revote-button:hover {
      background-color: #0056b3;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ccc;
    }

    th {
      background-color: #007bff;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .welcome-message {
      margin-bottom: 20px;
      font-size: 18px;
    }

    .welcome-button {
      display: block;
      margin-top: 20px;
      text-align: center;
      text-decoration: none;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .welcome-button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <header>
      <h1>Revote Dashboard</h1>
      <form action="revote.php" method="post">
        <input type="submit" class="revote-button" value="Revote"> <!-- Revote button -->
      </form>
      <form action="logout.php" method="post">
        <input type="submit" class="logout-button" value="Logout">
      </form>
    </header>
    <main>
      <p class="welcome-message"><?php echo isset($user_data['user_name']) ? "Hello, " . $user_data['user_name'] : "Hello, User"; ?></p>
      <table>
        <thead>
          <tr>
            <th>Candidate</th>
            <th>Votes</th>
            <th>Revotes</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Loop through merged data and display in table rows
          foreach ($merged_data as $candidate => $data) {
              echo "<tr>";
              echo "<td>" . $candidate . "</td>";
              echo "<td>" . (isset($data['vote_count']) ? $data['vote_count'] : 0) . "</td>";
              echo "<td>" . (isset($data['revote_count']) ? $data['revote_count'] : 0) . "</td>";
              echo "</tr>";
          }
          ?>
        </tbody>
      </table>
      <a href="index.php" class="welcome-button">Go to Welcome Page</a> <!-- Go to Welcome Page button -->
    </main>
  </div>
</body>
</html>
