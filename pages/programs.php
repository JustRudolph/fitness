<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Programs</title>
  <!-- Link to the compiled CSS -->
  <link rel="stylesheet" href="/css/styles.css" />

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
<header id="about-header">
  <div class="header-content">
    <h1>Programs</h1>
    <p>Learn more about our mission, values, and the team that makes it all possible.</p>
  </div>
  <div class="header-image">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStfR_IEE9m_XV_hfAq7pdQabAZpUlhETEr_A&s" alt="Gym Fitness">
  </div>
</header>

<!-- Programs Section -->
<section id="Programs">
  <div class="container">
    <h2>Programs</h2>
    <div class="program-list" style="display: flex; gap: 20px;">
      <div class="program-card" onclick="toggleCard(this)">
        <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?q=80&w=400" alt="Strength Training">
        <div class="program-card-content">
          <h3>Strength Training</h3>
          <p>Build muscle and power with our expert-guided strength routines.</p>
        </div>
      </div>
      <div class="program-card" onclick="toggleCard(this)">
        <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?q=80&w=400" alt="Cardio Fitness">
        <div class="program-card-content">
          <h3>Cardio Fitness</h3>
          <p>Boost your endurance and burn calories with our high-energy cardio classes.</p>
        </div>
      </div>
      <div class="program-card" onclick="toggleCard(this)">
        <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?q=80&w=400" alt="Yoga Classes">
        <div class="program-card-content">
          <h3>Yoga Classes</h3>
          <p>Improve flexibility and find your inner balance with our calming yoga sessions.</p>
        </div>
      </div>
    </div>
    <header id="home">
    <div class="header-content">
        <p>
          Our programs are designed to cater to all fitness levels and preferences. Whether you are looking to build strength, improve your cardiovascular health, or find inner peace through yoga, we have something for everyone.
        </p>
        <a href="/pages/aanbiedingen.php" class="btn">Take a look at our offers</a>
    </div>
    </header>
  </div>
</section>

<!-- About Section -->
<section id="about">
  <div class="container">
    <!-- Content for the About section can be added here if needed -->
  </div>
</section>

<!-- Footer Section -->
<footer>
  <div class="container">
    <p>&copy; 2025 Gym Powerhouse. All rights reserved.</p>
  </div>
</footer>

<script>
  function toggleCard(card) {
    const content = card.querySelector('.program-card-content');
    content.classList.toggle('active');
    card.classList.toggle('active');
  }
</script>
</body>
</html>
