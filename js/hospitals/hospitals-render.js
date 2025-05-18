// hospitals-render.js
import { hospitalsCardsData } from "./hospitals-data.js";

// Render hospital cards into the given container
export function renderHospitals(container) {
  const fragment = document.createDocumentFragment();

  hospitalsCardsData.forEach((h) => {
    const div = document.createElement("div");
    div.className = "grid grid-cols-1 gap-6";

    const specialtiesHtml = h.specialties
      .map(
        (s) =>
          `<span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-medium text-gray-800">${s}</span>`
      )
      .join("");

    div.innerHTML = `
      <div class="hospital-card-wrapper bg-card border-card shadow-sm rounded-xl transition-all overflow-hidden relative">
        
        <div class="hospital-image-section flex flex-col">

          <div class="hospital-image-wrapper relative w-full h-48">
            <img src="${h.imageUrl}" alt="${
      h.name
    }" class="w-full h-full object-cover" loading="lazy" style="aspect-ratio:4/3"/>
            ${
              h.emergencyServices
                ? `
            <div class="emergency-badge absolute bg-danger text-white px-2 py-1 rounded-full text-xs font-medium flex items-center">
              <i data-lucide="activity" class="w-3.5 h-3.5 mr-1"></i>
              Emergency Services
            </div>`
                : ""
            }
          </div>

          <div class="p-6 flex-grow">
            <div class="custom-flex-container flex flex-col">
              <div>
                <h2 class="text-xl font-bold mb-1 text-heading tracking-tight">${
                  h.name
                }</h2>
                <div class="flex items-center gap-2 mb-3 text-sm text-gray-600">
                  <i data-lucide="map-pin" class="w-4 h-4 text-gray-500 mr-1.5"></i>
                  <span>${h.address}</span>
                </div>
              </div>

              <div class="hospital-rating flex items-center mt-2">
                <div class="hospital-stars px-3 rounded-md flex items-center">
                  <i data-lucide="star" class="w-4.5 h-4.5 mr-1 text-star-500 fill-star-500"></i>
                  <span class="text-heading font-medium py-2">${h.rating}</span>
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

            <div id="hospital-card-buttons" class="mt-6 flex justify-end">
              <button class="inline-flex items-center justify-center gap-2 flex-grow whitespace-nowrap rounded-md border border-solid border-input bg-medical-600 text-sm font-medium transition-colors h-10 px-4 py-2 mr-3 text-white hover:bg-medical-400">
                View Details
              </button>
              <button class="inline-flex items-center justify-center gap-2 flex-grow whitespace-nowrap rounded-md text-sm font-medium transition-colors text-heading border border-solid border-input bg-background hover:bg-medical-50 hover:text-medical-500 h-10 px-4 py-2">
                Get Directions
              </button>
            </div>

          </div>
        </div>

      </div>
    `;

    fragment.appendChild(div);
  });

  container.appendChild(fragment);
}
