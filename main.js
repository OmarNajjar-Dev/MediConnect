// JavaScript for header functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const header = document.querySelector('header');
    const mobileMenuButton = document.querySelector('button.md\\:hidden');
    const mobileNav = document.querySelector('div.md\\:hidden.absolute');
    
    // Scroll event for header styling
    window.addEventListener('scroll', function() {
      if (window.scrollY > 20) {
        header.classList.add('bg-white/80', 'backdrop-blur-md', 'shadow-sm', 'py-3');
        header.classList.remove('bg-transparent', 'py-5');
      } else {
        header.classList.add('bg-transparent', 'py-5');
        header.classList.remove('bg-white/80', 'backdrop-blur-md', 'shadow-sm', 'py-3');
      }
    });
    
    // Initial check for header styling (if page is loaded scrolled down)
    if (window.scrollY > 20) {
      header.classList.add('bg-white/80', 'backdrop-blur-md', 'shadow-sm', 'py-3');
      header.classList.remove('bg-transparent', 'py-5');
    }
    
    // Mobile menu toggle functionality
    let mobileMenuOpen = false;
    
    mobileMenuButton.addEventListener('click', function() {
      mobileMenuOpen = !mobileMenuOpen;
      
      if (mobileMenuOpen) {
        // Show mobile menu
        mobileNav.classList.remove('hidden');
        // Change hamburger icon to X
        const menuIcon = mobileMenuButton.querySelector('i');
        menuIcon.classList.remove('lucide-menu');
        menuIcon.classList.add('lucide-x');
      } else {
        // Hide mobile menu
        mobileNav.classList.add('hidden');
        // Change X icon back to hamburger
        const menuIcon = mobileMenuButton.querySelector('i');
        menuIcon.classList.remove('lucide-x');
        menuIcon.classList.add('lucide-menu');
      }
    });
    
    // Close mobile menu when clicking on a link
    const mobileNavLinks = mobileNav.querySelectorAll('a');
    mobileNavLinks.forEach(link => {
      link.addEventListener('click', function() {
        mobileNav.classList.add('hidden');
        mobileMenuOpen = false;
        
        // Reset menu icon
        const menuIcon = mobileMenuButton.querySelector('i');
        menuIcon.classList.remove('lucide-x');
        menuIcon.classList.add('lucide-menu');
      });
    });
    
    // Close mobile menu when resizing window to desktop
    window.addEventListener('resize', function() {
      if (window.innerWidth >= 768 && mobileMenuOpen) {
        mobileNav.classList.add('hidden');
        mobileMenuOpen = false;
        
        // Reset menu icon
        const menuIcon = mobileMenuButton.querySelector('i');
        menuIcon.classList.remove('lucide-x');
        menuIcon.classList.add('lucide-menu');
      }
    });
  });
  