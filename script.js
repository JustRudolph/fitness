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
