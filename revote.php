<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Revote Here</title>
  <style>
    /* CSS for Revote Page */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url('images/wel2.png'); /* Update the background image path */
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

    .grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
    }

    .grid-item {
      padding: 10px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .vote-option {
      margin-top: 20px;
    }

    .voter-form {
      max-width: 400px;
      margin: 0 auto;
    }

    .input-container {
      margin-bottom: 15px;
    }

    input[type="text"],
    input[type="email"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }

    .dashboard-button {
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

    .dashboard-button:hover {
      background-color: #0056b3;
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
      <h1>Revote Here</h1>
      <!-- Link to logout page -->
      <form action="logout.php" method="post">
        <input type="submit" class="logout-button" value="Logout">
      </form>
    </header>
    <main>
      <?php
      // Database connection
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "login_db";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Check if email is posted
      if(isset($_POST['email'])) {
          $email = $_POST['email'];

          // Check if email already voted
          $sql_check_email = "SELECT * FROM votedata WHERE email = '$email'";
          $result_check_email = $conn->query($sql_check_email);

          if ($result_check_email->num_rows > 0) {
              // Email already voted, handle revote
              $name = $_POST['name'];
              $branch = $_POST['branch'];
              $candidate = $_POST['candidate'];

              // Store revote data in revotedata table
              $sql_insert_revote_data = "INSERT INTO revotedata (name, branch, candidate, email) VALUES ('$name', '$branch', '$candidate', '$email')";
              if ($conn->query($sql_insert_revote_data) === TRUE) {
                  echo "<script>alert('Revote submitted successfully!')</script>";
                  echo "<script>window.location = 'dashboard.php'</script>"; // Redirect to dashboard after revoting
              } else {
                  echo "Error: " . $sql_insert_revote_data . "<br>" . $conn->error;
              }
          } else {
              // Email not found in votedata, display error
              echo "<p>Email not found in votedata. Please vote first.</p>";
          }
      }
      ?>
      <!-- Revote form -->
      <form id="revoteForm" class="voter-form" method="post" action="">
        <h2>Revoter Registration Form</h2>
        <div class="input-container">
          <input type="text" id="name" name="name" placeholder="Your Name" required>
        </div>
        <div class="input-container">
          <input type="text" id="branch" name="branch" placeholder="Your Branch" required>
        </div>
        <div class="input-container">
          <select id="candidate" name="candidate" required>
            <option value="">Choose Candidate</option>
            <option value="1">Candidate 1</option>
            <option value="2">Candidate 2</option>
            <option value="3">Candidate 3</option>
            <option value="4">Candidate 4</option>
          </select>
        </div>
        <div class="input-container">
          <input type="email" id="email" name="email" placeholder="Your Email Address" required>
        </div>
        <button type="submit">Submit Revote</button>
      </form>
    </main>
    <!-- Link to dashboard and welcome page -->
    <a href="dashboard.php" class="dashboard-button">Go to Dashboard</a>
    <a href="index.php" class="welcome-button">Go to Welcome Page</a>
  </div>
</body>
</html>
