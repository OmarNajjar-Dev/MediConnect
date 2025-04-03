const header = document.querySelector("header");

// Handle scroll to change header appearance
let isScrolled = false;
window.addEventListener("scroll", () => {
  if (window.scrollY > 20) {
    header.classList.remove("py-5");
    header.classList.add("shadow-sm", "backdrop-blur-md", "py-3");
  } else {
    header.classList.add("py-5");
    header.classList.remove("shadow-sm", "backdrop-blur-md", "py-3");
  }
});

// Get the mobile navigation element
const mobileNav = document.getElementById("mobile-nav");

// Get the menu button element
const menuButton = document.getElementById("menu-button");

// Toggle the 'hidden' class on the mobile nav when the button is clicked
menuButton.addEventListener("click", () => {
  mobileNav.classList.toggle("hidden");
  document.body.classList.toggle("overflow-hidden");
});

// Select the container element where hero cards will be added
const heroContainer = document.getElementById("hero-cards-container");

// Array of hero card data
const heroContent = [
  {
    icon: "<i data-lucide='calendar'></i>", // Icon for scheduling feature
    title: "Easy Scheduling", // Feature title
    description: "Book appointments with doctors in just a few clicks", // Feature description
  },
  {
    icon: "<i data-lucide='users'></i>", // Icon for specialists feature
    title: "Top Specialists", // Feature title
    description: "Connect with experienced healthcare professionals", // Feature description
  },
  {
    icon: "<i data-lucide='hospital'></i>", // Icon for hospital info feature
    title: "Hospital Info", // Feature title
    description: "Find hospitals with available beds and services", // Feature description
  },
];

// Generate HTML for each hero card
const heroCards = heroContent.map(
  (card) =>
    `
      <div class="bg-card border border-solid border-card rounded-lg backdrop-blur-md shadow-sm p-6">
          <div class="card-container text-center">
              <div class="flex justify-center items-center text-medical-600 bg-medical-100 rounded-full mx-auto mb-4 w-12 h-12">
                  ${card.icon}
              </div>
              <h3 class="text-heading text-xl font-medium tracking-tight capitalize mb-2">${card.title}</h3>
              <p class="text-gray-600">${card.description}</p>
          </div>
      </div>
    `
);

// Append each hero card HTML to the hero container
heroCards.forEach((card) => (heroContainer.innerHTML += card));

const services = [
  {
    icon: "<i data-lucide='calendar' class='w-7 h-7'></i>",
    title: "Appointment Booking",
    description:
      "Schedule appointments with doctors and receive notifications for any changes.",
    linkText: "Book Now",
    linkHref: "/appointments.html",
  },
  {
    icon: "<i data-lucide='clipboard-list' class='w-7 h-7'></i>",

    title: "Medical Reports",
    description:
      "Receive digital medical reports and prescriptions directly from your doctor.",
    linkText: "Learn More",
    linkHref: "/reports.html",
  },
  {
    icon: "<i data-lucide='hospital' class='w-7 h-7'></i>",
    title: "Hospital Information",
    description:
      "Find hospitals with available beds and emergency services in your area.",
    linkText: "View Hospitals",
    linkHref: "/hospitals.html",
  },
  {
    icon: "<i data-lucide='plus-circle' class='w-7 h-7'></i>",
    title: "Pharmacy Orders",
    description:
      "Order prescription and over-the-counter medications from registered pharmacies.",
    linkText: "Order Medicines",
    linkHref: "pharmacy.html",
  },
];

const container = document.getElementById("services-container");
const cards = services.map(
  (service) =>
    `
  <div class="animate-on-scroll">
    <div class="service-card rounded-xl p-6 bg-card shadow-sm transition-all backdrop-blur-md border border-solid border-card">
      <div class="flex flex-col h-full">
        <div class="mb-6 w-14 h-14 bg-medical-100 text-medical-600 rounded-lg flex items-center justify-center">${service.icon}</div>
        <h3 class="service-title text-xl tracking-tight font-medium mb-3">${service.title}</h3>
        <p class="text-gray-600 mb-4 flex-grow">${service.description}</p>
        <a href="${service.linkHref}" class="service-link font-medium text-main inline-flex items-center gap-2 rounded-lg justify-start p-0 hover:bg-medical-50 hover:text-medical-500 h-10 whitespace-nowrap"><span>${service.linkText}</span><i data-lucide="arrow-right" class="w-4 h-4 ml-2 transition-transform"></i></a>
      </div>
    </div>
  </div>
  `
);

// Now use forEach to append all cards to the container
cards.forEach((card) => (container.innerHTML += card));
