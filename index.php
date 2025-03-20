<?php
$page_title = "Gym Powerhouse";
$year = date("Y");
if(isset($_POST["login"])) {

    header('Location:../pages/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $page_title; ?></title>
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
            <h1>Welcome to <?php echo $page_title; ?></h1>
            <p>Get fit, stay healthy, and achieve your personal best.</p>
            <a href="/pages/programs.php" class="btn">Explore Programs</a>
            <a href="/pages/login.php" class="btn">Login</a>
        </div>
        <div class="header-image">
            <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=800" alt="Gym Fitness">
        </div>
    </header>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <h2>About Us</h2>
            <p>
                At <?php echo $page_title; ?>, we are dedicated to helping you achieve your fitness goals.
                Our state-of-the-art facility and expert trainers provide you with everything you need
                to train hard and live a healthy lifestyle.
            </p>
            <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?q=80&w=800" alt="Workout">
        </div>
    </section>

    <footer>
  <div class="container">
    <p>&copy; 2025 Gym Powerhouse. All rights reserved.</p>
  </div>
</footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>