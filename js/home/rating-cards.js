import { generateRatingStars } from "../utils/generateRatingStars.js";

export const ratingCardsData = [
  {
    title: "Hospital Ratings",
    stars: 4,
    description:
      "View and contribute to hospital ratings based on quality of care, facilities, and services.",
    buttonText: "View Hospital Ratings",
    linkHref: "<?= $paths['services']['hospitals'] ?>",
    animationDelay: "100ms",
  },
  {
    title: "Doctor Reviews",
    stars: 5,
    description:
      "Browse doctor reviews and ratings to find the best healthcare provider for your needs.",
    buttonText: "Find Rated Doctors",
    linkHref: "<?= $paths['services']['doctors'] ?>",
    animationDelay: "200ms",
  },
];

export function renderRatingCards(container) {
  const fragment = document.createDocumentFragment();
  ratingCardsData.forEach((card) => {
    const div = document.createElement("div");
    div.className = "animate-on-scroll";
    div.style.animationDelay = card.animationDelay;
    div.innerHTML = `
      <div class="border-card-light bg-card rounded-xl p-6 backdrop-blur-md bg-card border border-solid border-card-light shadow-sm h-full">
        <div class="flex flex-col h-full">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-medium text-heading">${card.title}</h3>
            <div class="flex">${generateRatingStars(card.stars, [
              "w-5",
              "h-5",
            ])}</div>
          </div>
          <p class="text-gray-600 mb-6">${card.description}</p>
          <a href="${
            card.linkHref
          }" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors bg-medical-500 text-white hover:bg-medical-400 h-10 px-4 py-2 w-full">
            ${card.buttonText}
          </a>
        </div>
      </div>
    `;
    fragment.appendChild(div);
  });
  container.appendChild(fragment);
}
