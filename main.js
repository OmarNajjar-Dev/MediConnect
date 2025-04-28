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
    imageUrl:"https:images.unsplash.com/photo-1586773860418-d37222d8fce3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
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
    imageUrl: "/mnt/data/second-hospital-image.png"
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
        
        <div class="glass-card rounded-xl transition-all duration-300 overflow-hidden">

          <img
            src="${h.imageUrl}"
            alt="${h.name}"
            class="w-full h-full object-cover"
            loading="lazy" />
          ${h.emergencyServices ? `
            <div class="absolute top-4 left-4 bg-red-500 text-white px-2 py-1 rounded-md text-xs font-medium flex items-center">
              <i data-lucide="siren" class="w-3.5 h-3.5 mr-1"></i>
              Emergency Services
            </div>` : ``}
        </div>
  
        <div class="p-6 flex-grow">
          <div class="flex flex-col md:flex-row md:items-start md:justify-between">
            <div>
              <h2 class="text-xl font-bold mb-1">${h.name}</h2>
              <div class="flex items-center mb-3">
                <i data-lucide="map-pin" class="w-4 h-4 text-gray-500 mr-1.5"></i>
                <span class="text-gray-600 text-sm">${h.address}</span>
              </div>
            </div>
            <div class="flex items-center mt-2 md:mt-0">
              <div class="px-3 py-1.5 bg-yellow-50 rounded-md flex items-center">
                <i data-lucide="star" class="w-4 h-4 mr-1 text-yellow-500"></i>
                <span class="font-medium">${h.rating}</span>
                <span class="text-gray-500 text-sm ml-1">(${h.reviews})</span>
              </div>
            </div>
          </div>
  
          <div class="flex flex-wrap gap-2 my-3">
            ${specialtiesHtml}
          </div>
  
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4">
            <div class="flex items-center">
              <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                <i data-lucide="bed-single" class="w-5 h-5"></i>
              </div>
              <div class="ml-3">
                <p class="text-sm text-gray-600">Available Beds</p>
                <p class="font-medium">${h.availableBeds}</p>
              </div>
            </div>

            <div class="flex items-center">
              <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center">
                <i data-lucide="phone" class="w-5 h-5"></i>
              </div>
              <div class="ml-3">
                <p class="text-sm text-gray-600">Contact</p>
                <p class="font-medium">${h.contact}</p>
              </div>
            </div>
          </div>
  
          <div class="mt-6 flex justify-end">
            <button class="mr-3 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 rounded-md text-sm font-medium">
              View Details
            </button>
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
