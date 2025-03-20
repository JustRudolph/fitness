<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Aanbiedingen - Gym Powerhouse</title>
  <!-- Link to the compiled CSS -->
  <link rel="stylesheet" href="/css/styles.css"/>
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
      <h1>Special Offers</h1>
      <p>Check out our latest offers and discounts.</p>
      <a href="#offers" class="btn">Here</a>
    </div>
    <div class="header-image" style="margin-bottom: 20px;">
      <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?q=80&w=800" alt="Special Offers">
    </div>
  </header>

  <!-- Offers Section -->
  <section id="offers">
    <div class="container">
      <h2>Our Special Offers</h2>
      <div class="offer-list" style="display: flex; justify-content: space-between;">
        <div class="offer" style="flex: 1; margin: 10px;">
          <img src="https://images.unsplash.com/photo-1598970434795-0c54fe7c0642?q=80&w=150" alt="Offer 1">
          <h3>50% Off Membership</h3>
          <p>Get 50% off on all new memberships for the first 3 months.</p>
          <button class="btn">Price: €29.99</button>
        </div>
        <div class="offer" style="flex: 1; margin: 10px;">
          <img src="https://images.unsplash.com/photo-1594737625785-8b5b7cad6d9b?q=80&w=150" alt="Offer 2">
          <h3>Free Personal Training</h3>
          <p>Sign up now and get 2 free personal training sessions.</p>
          <button class="btn">Price: €37.99</button>
        </div>
        <div class="offer" style="flex: 1; margin: 10px;">
          <img src="https://images.unsplash.com/photo-1573497019410-9b2d7d2a9d9b?q=80&w=150" alt="Offer 3">
          <h3>Discount on Supplements</h3>
          <p>Enjoy a 20% discount on all supplements in our store.</p>
          <button class="btn">Price: €40.00</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer Section -->
  <footer>
    <div class="container">
      <p>&copy; 2025 Gym Powerhouse. All rights reserved.</p>
    </div>
  </footer>
  <!-- Scroll to Top Button -->
  <button id="scrollToTopBtn">&#8679;</button>

  <!-- Link to the JavaScript file -->
  <script src="../script.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>