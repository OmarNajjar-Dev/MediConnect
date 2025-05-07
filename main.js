// ============================
// Header Scroll Effect
// ============================
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
const mobileNavElement = document.getElementById("mobile-nav");
const menuButtonElement = document.getElementById("menu-button");

menuButtonElement.addEventListener("click", () => {
  mobileNavElement.classList.toggle("hidden");
  document.body.classList.toggle("overflow-hidden");
});

// ============================
// Hospitals Cards
// ============================
const hospitals = [
  {
    name: "Central Medical Center",
    address: "123 Medical Blvd, Central City",
    specialties: ["Cardiology", "Neurology", "Orthopedics", "Oncology"],
    availableBeds: 15,
    contact: "+1 (555) 123-4567",
    rating: 4.8,
    reviews: 356,
    emergencyServices: true,
    imageUrl: "https:images.unsplash.com/photo-1586773860418-d37222d8fce3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
  },
  {
    name: "Westside Hospital",
    address: "456 Healthcare Ave, West District",
    specialties: ["Pediatrics", "Obstetrics", "General Surgery", "Dermatology"],
    availableBeds: 8,
    contact: "+1 (555) 987-6543",
    rating: 4.6,
    reviews: 283,
    emergencyServices: true,
    imageUrl: "https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
  }
];

const container = document.getElementById("hospitals");

const cardsHtml = hospitals.map(h => {
  const specialtiesHtml = h.specialties
    .map(s => `
      <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-medium text-gray-800">${s}</span>
    `)
    .join("");

  return `
    <div class="grid grid-cols-1 gap-6">
      <div id="hospital-card" class="flex flex-col">
        
        <div class="glass-card rounded-xl transition-all duration-300 overflow-hidden relative h-80">
          <img
            src="${h.imageUrl}"
            alt="${h.name}"
            class="w-full h-full object-cover"
            loading="lazy" />
          ${h.emergencyServices ? `
            <div class="absolute top-4 left-4 bg-red-500 text-white px-2 py-1 rounded-md text-xs font-medium flex items-center">
              <i data-lucide="activity" class="w-3.5 h-3.5 mr-1"></i>
              Emergency Services
            </div>` : ``}
        </div>
  
        <div class="p-6 flex-grow">
          <div class="custom-flex-container flex flex-col">
            <div>
              <h2 class="text-xl font-bold mb-1 text-heading tracking-tight">${h.name}</h2>
              <div class="flex items-center mb-3">
                <i data-lucide="map-pin" class="w-4 h-4 text-gray-500 mr-1.5"></i>
                <span class="text-gray-600 text-sm">${h.address}</span>
              </div>
            </div>
            <div class="flex items-center mt-2 md:mt-0">
              <div class="star-icon px-3 py-1-5 rounded-md flex items-center">
                <i data-lucide="star" class="w-4 h-4 mr-1 text-star-500 fill-star-500"></i>
                <span class=" text-heading font-medium">${h.rating}</span>
                <span class="text-gray-500 text-sm ml-1">(${h.reviews})</span>
              </div>
            </div>
          </div>
  
          <div class="flex flex-wrap gap-2 my-3">
            ${specialtiesHtml}
          </div>
  
          <div class="hospital-details grid grid-cols-1 gap-3 mt-4">
            <div class="flex items-center">
              <div class="bed-icon w-10 h-10 rounded-full flex items-center justify-center">
                <i data-lucide="bed" class="w-5 h-5"></i>
              </div>
              <div class="ml-3">
                <p class="text-sm text-gray-600">Available Beds</p>
                <p class="font-medium text-heading">${h.availableBeds}</p>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-10 h-10 rounded-full bg-medical-100 text-medical-600 flex items-center justify-center">
                <i data-lucide="phone" class="w-5 h-5"></i>
              </div>
              <div class="ml-3">
                <p class="text-sm text-gray-600">Contact</p>
                <p class="font-medium text-heading">${h.contact}</p>
              </div>
            </div>
          </div>
  
          <div class="mt-6 flex justify-end">
            <div class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium
              transition-colors h-10 px-4 py-2 mr-3 bg-medical-600 text-white hover:bg-primary/90">
  View Details
</div>

            <button class="border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 rounded-md text-sm font-medium">
              Get Directions
            </button>
          </div>
        </div>
      </div>
    </div>
  `;
}).join("");



container.innerHTML = cardsHtml;
lucide.createIcons();
