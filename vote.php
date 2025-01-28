<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VOTE HERE</title>
  <style>
    /* CSS for Dashboard */
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
      <h1>Vote Here</h1>
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
              // Email already voted
              $row = $result_check_email->fetch_assoc();
              $name = $row['name'];
              $branch = $row['branch'];
              $candidate = $row['candidate'];

              echo "<p>You have already voted:</p>";
              echo "<p>Name: $name</p>";
              echo "<p>Branch: $branch</p>";
              echo "<p>Selected Candidate: Candidate $candidate</p>";
              echo "<p>Email: $email</p>";
          } else {
              // Proceed with voting
              $name = $_POST['name'];
              $branch = $_POST['branch'];
              $candidate = $_POST['candidate'];

              $sql_insert_data = "INSERT INTO votedata (name, branch, candidate, email) VALUES ('$name', '$branch', '$candidate', '$email')";
              if ($conn->query($sql_insert_data) === TRUE) {
                  echo "<script>alert('Vote submitted successfully!')</script>";
                  echo "<script>window.location = 'dashboard.php'</script>";
              } else {
                  echo "Error: " . $sql_insert_data . "<br>" . $conn->error;
              }
          }
      }
      ?>
      <div class="grid">
        <!-- Grid items -->
        <div class="grid-item">Name: <?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?></div>
        <div class="grid-item">Branch: <?php echo isset($_POST['branch']) ? $_POST['branch'] : ''; ?></div>
        <div class="grid-item">Selected Candidate: <?php echo isset($_POST['candidate']) ? 'Candidate ' . $_POST['candidate'] : ''; ?></div>
        <div class="grid-item">Email: <?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?></div>
        <!-- Add more grid items as needed -->
      </div>
    </main>
    <footer>
      <div class="vote-option">
        <form id="voterForm" class="voter-form" method="post" action="">
          <h2>Voter Registration Form</h2>
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
            <input type="email" id="email" name="email" placeholder="Your Email Address ( @pccoer.in only) " required>
          </div>
          <button type="submit">Submit</button>
        </form>
      </div>
    </footer>
    <a href="dashboard.php" class="dashboard-button">Go to Dashboard</a>
    <a href="index.php" class="welcome-button">Go to Welcome Page</a> <!-- Add welcome button -->
  </div>
</body>
</html>
