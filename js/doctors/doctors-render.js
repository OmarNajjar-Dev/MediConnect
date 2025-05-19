import { doctorsCardsData } from "./doctors-data.js";

// Render doctor cards into the given container
export function renderDoctors(container) {
  const fragment = document.createDocumentFragment();

  doctorsCardsData.forEach((card) => {
    const div = document.createElement("div");
    div.className =
      "doctor-card transition-all shadow-sm backdrop-blur-md bg-card border border border-solid border-card rounded-lg p-6 flex flex-col";
    div.innerHTML = `
      <div class="flex items-start mb-4">
        <div class="w-20 h-20 rounded-full overflow-hidden mr-4 flex-shrink-0">
          <img src="${card.imageUrl}" alt="${card.name}" loading="lazy" class="w-full h-full object-cover" loading="lazy" />
        </div>
        <div>
          <h2 class="text-lg text-heading font-bold tracking-tight">${card.name}</h2>
          <p class="text-medical-600 font-medium">${card.specialty}</p>
          <div class="flex items-center mt-1 mb-1">
            <i data-lucide="map-pin" class="h-3.5 w-3.5 text-gray-500 mr-1"></i>
            <span class="text-gray-600 text-sm">${card.hospital}</span>
          </div>
          <div class="flex items-center">
            <i data-lucide="star" class="w-3.5 h-3.5 text-star-500 fill-star-500 mr-1"></i>
            <span class="font-medium text-sm">${card.rating}</span>
            <span class="text-gray-500 text-xs ml-1">(${card.reviews} reviews)</span>
          </div>
        </div>
      </div>
      <div class="text-sm text-gray-600 mb-4 flex-grow">${card.bio}</div>
      <div class="flex gap-2 mt-2">
        <button class="flex-grow-2 text-sm inline-flex items-center justify-center gap-2 rounded-md font-medium transition-all border border-solid border-input bg-background hover:bg-medical-50 text-heading hover:text-medical-600 h-10 py-2 px-4">
          View Profile
        </button>
        <a href="${card.profileLink}" class="flex-grow text-sm inline-flex items-center justify-center gap-2 rounded-md font-medium transition-all bg-medical-500 text-white hover:bg-medical-400 h-10 py-2 px-4">
          Book Appointment
        </a>
      </div>
    `;
    fragment.appendChild(div);
  });

  container.appendChild(fragment);
}
