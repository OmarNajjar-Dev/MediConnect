export async function renderDoctors(container) {
  try {
    const res = await fetch("/MediConnect/backend/api/get-doctors.php");
    const doctorsCardsData = await res.json();

    const fragment = document.createDocumentFragment();

    doctorsCardsData.forEach((card) => {
      const div = document.createElement("div");
      div.className =
        "doctor-card-wrapper transition-all glass-card backdrop-blur-md rounded-lg p-6 flex flex-col";
      div.innerHTML = `
        <div class="flex items-start mb-4">
          <div class="w-20 h-20 rounded-full overflow-hidden mr-4 flex-shrink-0">
            <img src="${card.image_url || "default.jpg"}" alt="${
        card.first_name
      } ${card.last_name}" loading="lazy" class="w-full h-full object-cover" />
          </div>
          <div>
            <h2 class="text-lg text-heading font-bold tracking-tight">${
              card.first_name
            } ${card.last_name}</h2>
            <p class="text-medical-600 font-medium">${card.specialty || ""}</p>
            <div class="flex items-center mt-1 mb-1">
              <i data-lucide="map-pin" class="h-3.5 w-3.5 text-gray-500 mr-1"></i>
              <span class="text-gray-600 text-sm">${
                card.hospital_name || ""
              }</span>
            </div>
            <div class="flex items-center">
              <i data-lucide="star" class="w-3.5 h-3.5 text-star-500 fill-star-500 mr-1"></i>
              <span class="font-medium text-sm">${card.rating || "0.0"}</span>
              <span class="text-gray-500 text-xs ml-1">(${
                card.reviews_count || 0
              } reviews)</span>
            </div>
          </div>
        </div>
        <div class="text-sm text-gray-600 mb-6 flex-grow line-clamp-2">${
          card.bio || ""
        }</div>

        <div class="flex gap-2 mt-2">
        
          <!-- Tooltip Wrapper -->
          <div class="group relative flex-grow-2 not-allowed">
            <button type="button"
              class="w-full whitespace-nowrap text-sm inline-flex items-center justify-center gap-2 rounded-md font-medium transition-all border border-solid border-input bg-background text-heading h-10 py-2 px-4 not-allowed opacity-60"
              disabled>
              View Profile
            </button>
            <!-- Tooltip -->
            <div
              class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded shadow whitespace-nowrap">
              Coming Soon!
            </div>
          </div>

          <!-- Book Appointment -->
          <a href="${appointmentPath}?doctor=${card.doctor_id}"
            class="flex-grow whitespace-nowrap text-sm inline-flex items-center justify-center gap-2 rounded-md font-medium transition-all bg-medical-500 text-white hover:bg-medical-400 h-10 py-2 px-4">
            Book Appointment
          </a>
        </div>
      `;
      fragment.appendChild(div);
    });

    container.innerHTML = "";
    container.appendChild(fragment);
    lucide.createIcons();
  } catch (error) {
    container.innerHTML =
      "<p class='text-red-500'>Failed to load doctors data.</p>";
    console.error("Error loading doctors:", error);
  }
}
