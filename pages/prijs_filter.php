<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bezoeker op les prijs filteren</title>
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
  <header class="page-header">
    <h1>Bezoeker op les prijs filteren</h1>
    <p>Vind lessen binnen jouw gewenste prijsklasse!</p>
  </header>

  <!-- Main Content -->
  <main>
    <section class="filter-section">
      <h2>Filter op Prijs</h2>
      <form id="priceFilterForm">
        <div class="form-group">
          <label for="minPrice">Minimum Prijs (€):</label>
          <input type="range" id="minPrice" name="minPrice" min="0" max="100" value="0" step="5" oninput="minPriceOutput.value = this.value">
          <output id="minPriceOutput">0</output>
        </div>

        <div class="form-group">
          <label for="maxPrice">Maximum Prijs (€):</label>
          <input type="range" id="maxPrice" name="maxPrice" min="0" max="100" value="100" step="5" oninput="maxPriceOutput.value = this.value">
          <output id="maxPriceOutput">100</output>
        </div>

        <p>
          Of voer handmatig de prijs in:
          <label for="manualMinPrice">Minimum Prijs (€):</label>
          <input type="number" id="manualMinPrice" name="manualMinPrice" placeholder="Bijv. 10" min="0" max="100" step="1">
          
          <label for="manualMaxPrice">Maximum Prijs (€):</label>
          <input type="number" id="manualMaxPrice" name="manualMaxPrice" placeholder="Bijv. 50" min="0" max="100" step="1">
        </p>

        <button type="submit">Filter</button>
      </form>
    </section>

    <!-- Results Section -->
    <section id="results" class="results-section">
      <h2>Resultaten</h2>
      <!-- Filtered results or error messages will appear here -->
    </section>

    <!-- Add Photos Section -->
    <section class="photos-section">
      <h2>Populaire Lessen</h2>
      <div class="photo-gallery">
        <div class="photo-item">
          <img src="https://deworkout.nl/wp-content/uploads/2023/12/powercycle_cropped-1024x682.jpg" alt="Cardio Training">
          <p>€29.99</p>
        </div>
        <div class="photo-item">
          <img src="https://cdn.prod.website-files.com/61718a55e19d0e77ed60e111/6532dc94f78a67caf2315a1b_-Q_I6Xm9SwCZZz9vtbmghnYSofOaubCUHNU7tMM6NK4.png" alt="Yoga Class">
          <p>€50.00</p>
        </div>
        <div class="photo-item">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREUiz2tYixMOjjD4SA3XKCI6-RUdSaAV8kOw&s" alt="Spinning Class">
          <p>€30.00</p>
        </div>
        <div class="photo-item">
          <img src="data:image/jpeg;base64,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 " alt="Strength Training">
          <p>€60.00</p>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p>&copy; 2025 Gym Powerhouse. All rights reserved.</p>
    </div>
  </footer>

  <script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            if (this.classList.contains('login-btn')) return; // Skip smooth scroll for login
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Scroll to top button functionality
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    if (scrollToTopBtn) {
        window.addEventListener('scroll', () => {
            scrollToTopBtn.style.display = window.pageYOffset > 300 ? 'block' : 'none';
        });
        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Price filter functionality
    const priceFilterForm = document.getElementById('priceFilterForm');
    const resultsSection = document.getElementById('results');

    // Example data for kesseins (classes)
    const kesseins = [
        { name: 'Yoga Class', price: 29.99 },
        { name: 'Pilates Class', price: 20 },
        { name: 'Zumba Class', price: 30 },
        { name: 'Strength Training', price: 25 }
    ];

    if (priceFilterForm) {
        priceFilterForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Get the min and max price from the range sliders
            let minPrice = parseFloat(document.getElementById('minPrice').value);
            let maxPrice = parseFloat(document.getElementById('maxPrice').value);

            // Check if manual inputs are provided and override the range slider values
            const manualMinPrice = document.getElementById('manualMinPrice').value;
            const manualMaxPrice = document.getElementById('manualMaxPrice').value;

            if (manualMinPrice) {
                minPrice = parseFloat(manualMinPrice);
            }
            if (manualMaxPrice) {
                maxPrice = parseFloat(manualMaxPrice);
            }

            // Filter kesseins based on the price range
            const filteredKesseins = kesseins.filter(kessein => kessein.price >= minPrice && kessein.price <= maxPrice);

            // Clear previous results
            resultsSection.innerHTML = '';

            if (filteredKesseins.length > 0) {
                // Display the filtered kesseins
                filteredKesseins.forEach(kessein => {
                    const kesseinElement = document.createElement('div');
                    kesseinElement.textContent = `${kessein.name} - €${kessein.price}`;
                    resultsSection.appendChild(kesseinElement);
                });
            } else {
                // Display an error message if no kesseins match the criteria
                const errorMessage = document.createElement('p');
                errorMessage.textContent = 'Geen lessen gevonden binnen het opgegeven prijsbereik.';
                errorMessage.style.color = 'red';
                resultsSection.appendChild(errorMessage);
            }
        });
    }
  </script>
 <script src="../Js/script.js"></script>
</body>
</html>