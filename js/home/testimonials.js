import { generateRatingStars } from "../utils/generateRatingStars.js";

export const testimonialsCardsData = [
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

export function renderTestimonials(container) {
  const fragment = document.createDocumentFragment();
  testimonialsCardsData.forEach((card) => {
    const div = document.createElement("div");
    div.className = "animate-on-scroll";
    div.style.animationDelay = card.animationDelay;
    div.innerHTML = `
      <div class="rounded-xl p-6 bg-card border border-solid border-card shadow-sm h-full">
        <div class="flex flex-col h-full">
          <div class="mb-6">
            <div class="flex mb-1">${generateRatingStars(card.stars, [
              "w-4",
              "h-4",
            ])}</div>
          </div>
          <p class="text-gray-600 mb-6 flex-grow italic">${card.quote}</p>
          <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-medical-200 flex items-center justify-center text-medical-700 font-medium">${
              card.avatar
            }</div>
            <div class="ml-3">
              <p class="font-medium text-heading">${card.name}</p>
              <p class="text-sm text-gray-500">${card.role}</p>
            </div>
          </div>
        </div>
      </div>
    `;
    fragment.appendChild(div);
  });
  container.appendChild(fragment);
}
