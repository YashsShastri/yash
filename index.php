<?php 
session_start();

include("connection.php");
include("functions.php");

// Check if the user is already logged in
$user_data = check_login($con);

// Redirect to login page if user is not logged in
if (!$user_data) {
    header("Location: login.php");
    exit; // Make sure to exit after redirecting
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <style>
    body {
      margin: 0px;
      padding: 0px;
      font-family: 'Times New Roman', Times, serif;
      background-image: url('images/4113.png'); /* Updated background image path */
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      flex-direction: column; /* Set flex direction to column to stack header, content, and footer */
    }
    .welcome-container {
      text-align: left;
      max-width: 600px;
      width: 50%; /* Set width to 50% of the viewport */
      padding: 20px; /* Add padding for spacing */
      margin-right: auto; /* Move container to the left */
      margin-left: 20px; /* Add margin to create space between content and image */
    }
    .logout-link, .vote-link, .go-to-dashboard {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      margin: 10px;
    }
    .greeting {
      margin-top: 5px;
      color: #333;
      font-weight: bold; /* Make the greeting bold */
    }
    header, footer {
      background-color: #888;
      color: #fff;
      padding: 20px;
      width: 100%; /* Set header and footer to span the full width of the page */
      border-radius: 10px;
    }
    header {
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between; /* Align items to the left and right */
      align-items: center;
    }
    footer {
      margin-top: auto;
      margin-bottom: 50px; /* Set margin-bottom to move the footer further down */
      width: 100%; /* Make the footer span the full width */
      display: flex;
      justify-content: center; /* Center footer horizontally */
      margin-top: 50px; /* Add margin-top to shift footer down */
    }
    main {
      flex: 1;
    }
    h1 {
      font-size: 36px;
      margin-bottom: 20px; /* Add margin to separate from other sections */
    }
    h2 {
      font-size: 28px; /* Increased font size for h2 */
      margin-top: 20px; /* Add margin to separate from other sections */
      font-weight: bold; /* Make h2 bold */
    }
    h3 {
      font-size: 20px;
      font-weight: bold;
    }
    p {
      font-size: 20px; /* Increased font size for p */
      margin-top: 10px; /* Add margin to separate paragraphs */
    }
    .logout-link {
      background-color: #dc3545; /* Change background color to red */
    }
  </style>
</head>
<body>
  <header>
    <div>
      <p class="greeting"><?php echo isset($user_data['user_name']) ? "Hello, " . $user_data['user_name'] : "Hello, Guest"; ?></p>
    </div>
    <div>
      <a href="vote.php" class="vote-link">Vote Here</a> <!-- Added the Vote Here link -->
      <a href="dashboard.php" class="go-to-dashboard">Go to Dashboard</a>
      <a href="logout.php" class="logout-link">Logout</a> <!-- Changed the last button to Logout -->
    </div>
  </header>
  <div class="welcome-container">
    <main>
      <section class="intro">
        <h1>Welcome to Our Voting Platform!</h1>
        <p>Make Your Voice Heard</p>
      </section>
      <section class="cta">
        <h2>About the Election</h2>
        <p>Our class needs a representative who will voice our concerns, represent us in meetings, and make decisions on our behalf. Your vote matters!</p>
        <p>Participating in the election is not only a right but also a responsibility. Your involvement contributes to a vibrant and inclusive learning environment.</p>
        <p>Let's work together to make informed decisions and elect a representative who will make a positive impact on our class!</p>
      </section>
      <section class="cta">
        <h3>Importance of Fair Voting</h3>
        <p>Fair voting ensures that every voice is heard and every vote counts. It promotes democracy and equality within a community. Learn more about fair voting principles and their significance:</p>
       
      </section>
    </main>
  </div>
  <footer>
    <p>&copy; 2024 Class Representative Election</p>
  </footer>
</body>
</html>
