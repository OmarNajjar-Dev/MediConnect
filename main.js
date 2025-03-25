document.addEventListener('DOMContentLoaded', function() {
  // Get elements
  const header = document.querySelector('header');
  const mobileMenuButton = document.querySelector('.mobile-menu');
  const mobileNav = document.querySelector('.mobile-nav');
  
  // Initialize Lucide icons
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }

  // Scroll event for header styling
  window.addEventListener('scroll', function() {
    if (window.scrollY > 20) {
      header.classList.add('bg-white/80', 'backdrop-blur-md', 'shadow-sm', 'py-3');
      header.classList.remove('py-5');
    } else {
      header.classList.remove('bg-white/80', 'backdrop-blur-md', 'shadow-sm', 'py-3');
      header.classList.add('py-5');
    }
  });
  
  // Initial check for header styling
  if (window.scrollY > 20) {
    header.classList.add('bg-white/80', 'backdrop-blur-md', 'shadow-sm', 'py-3');
    header.classList.remove('py-5');
  }
  
  // Mobile menu toggle functionality
  let mobileMenuOpen = false;
  
  mobileMenuButton.addEventListener('click', function() {
    mobileMenuOpen = !mobileMenuOpen;
    
    if (mobileMenuOpen) {
      // Show mobile menu
      mobileNav.style.display = 'block';
      // Change hamburger icon to X
      const menuIcon = mobileMenuButton.querySelector('i');
      if (menuIcon) {
        menuIcon.setAttribute('data-lucide', 'x');
        if (typeof lucide !== 'undefined') {
          lucide.createIcons();
        }
      }
    } else {
      // Hide mobile menu
      mobileNav.style.display = 'none';
      // Change X icon back to hamburger
      const menuIcon = mobileMenuButton.querySelector('i');
      if (menuIcon) {
        menuIcon.setAttribute('data-lucide', 'menu');
        if (typeof lucide !== 'undefined') {
          lucide.createIcons();
        }
      }
    }
  });
  
  // Close mobile menu when clicking on a link
  const mobileNavLinks = mobileNav.querySelectorAll('a');
  mobileNavLinks.forEach(link => {
    link.addEventListener('click', function() {
      mobileNav.style.display = 'none';
      mobileMenuOpen = false;
      
      // Reset menu icon
      const menuIcon = mobileMenuButton.querySelector('i');
      if (menuIcon) {
        menuIcon.setAttribute('data-lucide', 'menu');
        if (typeof lucide !== 'undefined') {
          lucide.createIcons();
        }
      }
    });
  });
  
  // Close mobile menu when resizing window to desktop
  window.addEventListener('resize', function() {
    if (window.innerWidth >= 768 && mobileMenuOpen) {
      mobileNav.style.display = 'none';
      mobileMenuOpen = false;
      
      // Reset menu icon
      const menuIcon = mobileMenuButton.querySelector('i');
      if (menuIcon) {
        menuIcon.setAttribute('data-lucide', 'menu');
        if (typeof lucide !== 'undefined') {
          lucide.createIcons();
        }
      }
    }
  });
});