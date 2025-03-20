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
  window.addEventListener('scroll', () => {
    scrollToTopBtn.style.display = window.pageYOffset > 300 ? 'block' : 'none';
  });
  scrollToTopBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  
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
            // Display the filtered kesseins with photos and prices
            filteredKesseins.forEach(kessein => {
                const kesseinElement = document.createElement('div');
                kesseinElement.classList.add('result-item'); // Add a class for styling

                // Create and append the image
                const kesseinImage = document.createElement('img');
                kesseinImage.src = `/images/${kessein.name.toLowerCase().replace(' ', '_')}.jpg`; // Example image path
                kesseinImage.alt = kessein.name;
                kesseinImage.style.width = '200px'; // Set a fixed width for consistency
                kesseinImage.style.height = '150px'; // Set a fixed height for consistency
                kesseinImage.style.objectFit = 'cover'; // Ensure the image scales properly

                // Create and append the price
                const kesseinPrice = document.createElement('p');
                kesseinPrice.textContent = `${kessein.name} - €${kessein.price}`;
                kesseinPrice.style.fontWeight = 'bold'; // Make the price stand out
                kesseinPrice.style.textAlign = 'center'; // Center-align the text

                // Append the image and price to the result item
                kesseinElement.appendChild(kesseinImage);
                kesseinElement.appendChild(kesseinPrice);

                // Append the result item to the results section
                resultsSection.appendChild(kesseinElement);
            });
        } else {
            // Display an error message if no kesseins match the criteria
            const errorMessage = document.createElement('p');
            errorMessage.textContent = 'Geen lessen gevonden binnen het opgegeven prijsbereik.';
            errorMessage.style.color = 'red';
            errorMessage.style.textAlign = 'center';
            resultsSection.appendChild(errorMessage);
        }
    });
}
