<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: /index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Log-in - Gym Powerhouse</title>
  <link rel="stylesheet" href="../css/styles.css" />
</head>
<body>
<nav>
    <a href="/pages/index.php" style="text-decoration: none;">
    <div class="logo">Gym Powerhouse</div>
    </a>
    <ul>
        <li><a href="/pages/index.php">Home</a></li>
        <li><a href="/pages/aanbiedingen.php">Offers</a></li>
        <li><a href="/pages/login.php">Login</a></li>
        <li><a href="/pages/programs.php">Programs</a></li>
        <li><a href="/pages/prijs_filter.php">Lesson filter</a></li>
        <li><a href="#contact">Contact</a></li>
        <div id="search-bar">
            <form>
                <input type="search" id="search-input" placeholder="Search...">
                <button type="submit" id="search-button">Search</button>
            </form>
        </div>
    </ul>
</nav>

  <!-- Header Section -->
  <header id="home">
    <div class="header-content">
      <h1>Login / Sign up</h1>
      <p>Access or create your Gym Powerhouse account.</p>
      <a href="#login" class="btn">Login</a>
      <p></p>
      <p>New member? Sign up here!</p>
      <a href="/login/signup.html" class="btn">Sign up</a>
    </div>
    <div class="header-image" style="margin-bottom: 20px;">
      <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?q=80&w=800" alt="Login">
    </div>
  </header>

  <!-- Login Section -->
  <section id="login">
    <div class="container">
      <h2>Log Into Your Account</h2>
      <?php if ($is_invalid): ?>
                <em>Invalid login</em>
      <?php endif; ?>
      <div class="login-box">
        <!-- Display error message if login fails -->
        <?php if (!empty($error_message)): ?>
          <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>

        <form action="" method="post">
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
          </div>
          <button type="submit" class="btn">Login</button>
          <a href="/login/signup.html" class="signup-link">New member? Sign up</a>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer Section -->
  <footer>
    <div class="container">
      <p>&copy; <?= date("Y") ?> Gym Powerhouse. All rights reserved.</p>
    </div>
  </footer>

  <!-- Link to the JavaScript file -->
  <script src="../script.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>