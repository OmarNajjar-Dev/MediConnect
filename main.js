// ============================
// Header Scroll Effect
// ============================
// When the page is scrolled, adjust the header classes to shrink it and add a shadow.
// If scrollY is greater than 20, remove extra padding and add shadow and blur.
// Otherwise, revert to the original padding and remove shadow/blur.
const headerElement = document.querySelector("header");
window.addEventListener("scroll", () => {
  if (window.scrollY > 20) {
    headerElement.classList.remove("py-5");
    headerElement.classList.add("shadow-sm", "backdrop-blur-md", "py-3");
  } else {
    headerElement.classList.add("py-5");
    headerElement.classList.remove("shadow-sm", "backdrop-blur-md", "py-3");
  }
});

// ============================
// Mobile Navigation Toggle
// ============================
// This toggles the mobile navigation menu when the menu button is clicked.
// It also toggles the body overflow to prevent background scrolling.
const mobileNavElement = document.getElementById("mobile-nav");
const menuButtonElement = document.getElementById("menu-button");
menuButtonElement.addEventListener("click", () => {
  mobileNavElement.classList.toggle("hidden");
  document.body.classList.toggle("overflow-hidden");
});

// ============================
// Hero Cards Section
// ============================
// Data for the hero cards displayed on the homepage.
const heroCardsContainer = document.getElementById("hero-cards-container");
const heroCardsData = [
  {
    icon: "<i data-lucide='calendar'></i>", // Calendar icon
    title: "Easy Scheduling",
    description: "Book appointments with doctors in just a few clicks",
  },
  {
    icon: "<i data-lucide='users'></i>", // Specialists icon
    title: "Top Specialists",
    description: "Connect with experienced healthcare professionals",
  },
  {
    icon: "<i data-lucide='hospital'></i>", // Hospital icon
    title: "Hospital Info",
    description: "Find hospitals with available beds and services",
  },
];

// Create the HTML for each hero card and append it to the container.
const heroCardsHtml = heroCardsData.map(
  (card) =>
    `
    <div class="bg-card border border-solid border-card rounded-lg backdrop-blur-md shadow-sm p-6">
      <div class="card-container text-center">
        <div class="flex justify-center items-center text-medical-600 bg-medical-100 rounded-full mx-auto mb-4 w-12 h-12">
          ${card.icon}
        </div>
        <h3 class="text-heading text-xl font-medium tracking-tight capitalize mb-2">${card.title}</h3>
        <p class="text-gray-600 leading-relaxed">${card.description}</p>
      </div>
    </div>
    `
);
heroCardsHtml.forEach((cardHtml) => (heroCardsContainer.innerHTML += cardHtml));

// ============================
// Services Cards Section
// ============================
// Data for the services cards section.
const servicesCardsContainer = document.getElementById("services-cards-container");
const servicesCardsData = [
  {
    icon: "<i data-lucide='calendar' class='w-7 h-7'></i>",
    title: "Appointment Booking",
    description: "Schedule appointments with doctors and receive notifications for any changes.",
    linkText: "Book Now",
    linkHref: "/appointments.html",
  },
  {
    icon: "<i data-lucide='clipboard-list' class='w-7 h-7'></i>",
    title: "Medical Reports",
    description: "Receive digital medical reports and prescriptions directly from your doctor.",
    linkText: "Learn More",
    linkHref: "/reports.html",
  },
  {
    icon: "<i data-lucide='hospital' class='w-7 h-7'></i>",
    title: "Hospital Information",
    description: "Find hospitals with available beds and emergency services in your area.",
    linkText: "View Hospitals",
    linkHref: "/hospitals.html",
  },
  {
    icon: "<i data-lucide='plus-circle' class='w-7 h-7'></i>",
    title: "Pharmacy Orders",
    description: "Order prescription and over-the-counter medications from registered pharmacies.",
    linkText: "Order Medicines",
    linkHref: "/pharmacy.html",
  },
];

// Create the HTML for each services card and append it to the container.
const servicesCardsHtml = servicesCardsData.map(
  (card) =>
    `
    <div class="animate-on-scroll">
      <div class="service-card rounded-xl p-6 bg-card shadow-sm transition-all backdrop-blur-md border border-solid border-card h-full">
        <div class="flex flex-col h-full">
          <div class="mb-6 w-14 h-14 bg-medical-100 text-medical-600 rounded-md flex items-center justify-center">
            ${card.icon}
          </div>
          <h3 class="text-heading text-xl tracking-tight font-medium mb-3">${card.title}</h3>
          <p class="text-gray-600 mb-4 flex-grow leading-relaxed">${card.description}</p>
          <a href="${card.linkHref}" class="service-link text-sm font-medium text-heading inline-flex items-center gap-2 rounded-lg justify-start hover:bg-medical-50 hover:text-medical-500 h-10 whitespace-nowrap">
            <span>${card.linkText}</span>
            <i data-lucide="arrow-right" class="right-arrow w-4 h-4 ml-2 transition-transform"></i>
          </a>
        </div>
      </div>
    </div>
    `
);
servicesCardsHtml.forEach((cardHtml) => (servicesCardsContainer.innerHTML += cardHtml));

// ============================
// Rating Cards Section
// ============================
// Data for the rating cards section, showing ratings and reviews.
const ratingCardsContainer = document.getElementById("rating-cards-container");
const ratingCardsData = [
  {
    title: "Hospital Ratings",
    stars: 4,
    description: "View and contribute to hospital ratings based on quality of care, facilities, and services.",
    buttonText: "View Hospital Ratings",
    linkHref: "/hospital.html",
  },
  {
    title: "Doctor Reviews",
    stars: 5,
    description: "Browse doctor reviews and ratings to find the best healthcare provider for your needs.",
    buttonText: "Find Rated Doctors",
    linkHref: "/doctors.html",
  },
];

// Create the HTML for each rating card using the generateRatingStars function to display stars.
const ratingCardsHtml = ratingCardsData.map(
  (card) =>
    `
    <div class="animate-on-scroll">
      <div class="glass-card rounded-xl p-6 backdrop-blur-md bg-card border border-solid border-card shadow-sm h-full">
        <div class="flex flex-col h-full">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-medium text-heading">${card.title}</h3>
            <div class="flex"> ${generateRatingStars(card.stars, ["w-5", "h-5"])}</div>
          </div>
          <p class="text-gray-600 mb-6">${card.description}</p>
          <div class="mt-auto">
            <a href="${card.linkHref}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors bg-medical-500 text-white hover:bg-medical-400 h-10 px-4 py-2 w-full">
              ${card.buttonText}
            </a>
          </div>
        </div>
      </div>
    </div>
    `
);
ratingCardsHtml.forEach((cardHtml) => (ratingCardsContainer.innerHTML += cardHtml));

// ============================
// Testimonials Cards Section
// ============================
// Data for the testimonials cards section.
const testimonialsCardsContainer = document.getElementById("testimonials-cards-container");
const testimonialsCardsData = [
  {
    name: "Sarah Johnson",
    role: "Patient",
    quote: `"MediConnect made it so easy to find a specialist and book an appointment. I love being able to see doctor ratings before making a choice."`,
    avatar: "S",
    stars: 5, // Number of stars to display
    animationDelay: "0ms",
  },
  {
    name: "Dr. Michael Chen",
    role: "Cardiologist",
    quote: `"The platform streamlines patient bookings and allows me to efficiently manage appointments and share medical reports securely."`,
    avatar: "M",
    stars: 5,
    animationDelay: "100ms",
  },
  {
    name: "Emma Rodriguez",
    role: "Nurse",
    quote: `"Creating and sharing dietary plans with patients has never been easier. The interface is intuitive and saves us so much time."`,
    avatar: "E",
    stars: 5,
    animationDelay: "200ms",
  },
];

// Create the HTML for each testimonials card and append it to the container.
const testimonialsCardsHtml = testimonialsCardsData.map(
  (card) =>
    `
    <div class="animate-on-scroll" style="animation-delay: ${card.animationDelay};">
      <div class="rounded-xl p-6 bg-card border border-solid border-card shadow-sm h-full">
        <div class="flex flex-col h-full">
          <div class="mb-6">
            <div class="flex mb-1">${generateRatingStars(card.stars, ["w-4", "h-4"])}</div>
          </div>
          <p class="text-gray-600 mb-6 flex-grow italic">${card.quote}</p>
          <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-medical-200 flex items-center justify-center text-medical-700 font-medium">${card.avatar}</div>
            <div class="ml-3">
              <p class="font-medium text-heading">${card.name}</p>
              <p class="text-sm text-gray-500">${card.role}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    `
);
testimonialsCardsHtml.forEach((cardHtml) => (testimonialsCardsContainer.innerHTML += cardHtml));

// ============================
// Helper Function: generateRatingStars
// ============================
// This function generates an HTML string for rating stars.
// It accepts a rating (number from 1 to 5) and an optional array of additional classes.
// It returns yellow stars for the rating and gray stars for the remaining out of 5.
function generateRatingStars(rating, classes = []) {
  // Yellow star icon with specified classes
  const yellowStar = `<i data-lucide="star" class="text-star-400 fill-star-400 ${classes.join(" ")}"></i>`;
  // Gray star icon with specified classes
  const grayStar = `<i data-lucide="star" class="text-gray-300 ${classes.join(" ")}"></i>`;
  return yellowStar.repeat(rating) + grayStar.repeat(5 - rating);
}
