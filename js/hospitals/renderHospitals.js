export async function renderHospitals(container) {
  try {
    const response = await fetch("/MediConnect/backend/api/get-hospitals.php");
    const hospitals = await response.json();

    hospitals.forEach((h) => {
      const specialtiesHtml = h.specialties
        .map(
          (s) =>
            `<span class="inline-block bg-neutral-100 rounded-full px-3 py-1 text-xs font-medium text-gray-800">${s}</span>`
        )
        .join("");

      const div = document.createElement("div");
      div.className = "grid grid-cols-1 gap-6";
      div.innerHTML = `
        <div class="hospital-card-wrapper glass-card rounded-xl transition-all overflow-hidden relative">
          <div class="flex flex-col md:flex-row">

            <div class="relative w-full h-48 md:w-1/3 md:h-auto">
              <img src="${h.image_url}" alt="${
        h.name
      }" class="w-full h-full object-cover" loading="lazy"/>
              ${
                h.emergency_services == true
                  ? `
              <div class="emergency-badge absolute bg-danger text-white px-2 py-1 rounded-full text-xs font-medium flex items-center">
                <i data-lucide="activity" class="w-3.5 h-3.5 mr-1"></i>
                Emergency Services
              </div>`
                  : ""
              }
            </div>

            <div class="p-6 flex-grow">
              <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                  <h2 class="hospital-name text-xl font-bold mb-1 text-heading tracking-tight">${
                    h.name
                  }</h2>
                  <div class="flex items-center gap-2 mb-3 text-sm text-gray-600">
                    <i data-lucide="map-pin" class="w-4 h-4 text-gray-500 mr-1.5"></i>
                    <span class="hospital-address">${h.address}</span>
                  </div>
                </div>

                <div class="flex items-center mt-2 md:mt-0">
                  <div class="hospital-stars px-3 rounded-md flex items-center">
                    <i data-lucide="star" class="w-4.5 h-4.5 mr-1 text-star-500 fill-star-500"></i>
                    <span class="text-heading font-medium py-2">${
                      h.rating
                    }</span>
                    <span class="text-gray-500 text-sm ml-1">(${
                      h.reviews_count
                    })</span>
                  </div>
                </div>
              </div>

              <div class="flex flex-wrap gap-2 my-3">${specialtiesHtml}</div>

              ${
                h.available_beds > 0
                  ? `
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4">
                <div class="flex items-center">
                  <div class="bed-icon w-10 h-10 rounded-full flex items-center justify-center">
                    <i data-lucide="bed" class="w-5 h-5"></i>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm text-gray-600">Available Beds</p>
                    <p class="font-medium text-heading">${h.available_beds}</p>
                  </div>
                </div>`
                  : ``
              }

                <div class="flex items-center">
                  <div class="w-10 h-10 rounded-full bg-medical-100 text-primary flex items-center justify-center">
                    <i data-lucide="phone" class="w-5 h-5"></i>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm text-gray-600">Contact</p>
                    <p class="font-medium text-heading">${h.contact}</p>
                  </div>
                </div>
              </div>

              <div class="mt-6 flex justify-end gap-3">
                <!-- View Details -->
                <div class="group relative cursor-not-allowed">
                  <button type="button"
                    class="inline-flex items-center justify-center gap-2 flex-grow md:flex-grow-0 whitespace-nowrap rounded-md border border-solid border-input bg-medical-600 text-sm font-medium transition-colors h-10 px-4 py-2 text-white pointer-events-none"
                    disabled>
                    View Details
                  </button>
                  <div
                    class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded shadow whitespace-nowrap">
                    Coming Soon!
                  </div>
                </div>

                <!-- Get Directions -->
                <div class="group relative cursor-not-allowed">
                  <button type="button"
                    class="inline-flex items-center justify-center gap-2 flex-grow md:flex-grow-0 whitespace-nowrap rounded-md text-sm font-medium transition-colors text-heading border border-solid border-input bg-background hover:bg-medical-50 hover:text-medical-500 h-10 px-4 py-2 pointer-events-none"
                    disabled>
                    Get Directions
                  </button>
                  <div
                    class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded shadow whitespace-nowrap">
                    Coming Soon!
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      `;

      container.appendChild(div);
    });
    lucide.createIcons();
  } catch (error) {
    console.error("Error loading hospitals:", error);
    container.innerHTML = `<p class="text-red-500">Failed to load hospitals.</p>`;
  }
}
