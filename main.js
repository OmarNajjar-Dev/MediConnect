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
      <div class="hero-card bg-card border border-solid border-card rounded-xl shadow-sm p-6">
          <div class="card-container text-center">
              <div class="flex justify-center items-center text-medical-600 bg-medical-100 rounded-full mx-auto mb-4 w-12 h-12">
                  ${card.icon}
              </div>
              <h3 class="text-xl font-medium tracking-tight capitalize mb-2">${card.title}</h3>
              <p class="text-gray-600">${card.description}</p>
          </div>
      </div>
    `
);

// Append each hero card HTML to the hero container
heroCards.forEach((card) => heroContainer.innerHTML += card);