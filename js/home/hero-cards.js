export const heroCardsData = [
  {
    icon: "<i data-lucide='calendar'></i>", // Calendar icon
    title: "Easy Scheduling",
    description: "Book appointments with doctors in just a few clicks",
    animationDelay: "0ms",
  },
  {
    icon: "<i data-lucide='users'></i>", // Specialists icon
    title: "Top Specialists",
    description: "Connect with experienced healthcare professionals",
    animationDelay: "100ms",
  },
  {
    icon: "<i data-lucide='hospital'></i>", // Hospital icon
    title: "Hospital Info",
    description: "Find hospitals with available beds and services",
    animationDelay: "200ms",
  },
];

export function renderHeroCards(container) {
  const fragment = document.createDocumentFragment();
  heroCardsData.forEach((card) => {
    const div = document.createElement("div");
    div.className = `text-white bg-white/20 border border-solid border-card rounded-xl backdrop-blur-lg shadow-sm animate-on-scroll p-6`;
    div.style.animationDelay = card.animationDelay;
    div.innerHTML = `
      <div class="text-center">
        <div class="flex justify-center items-center bg-medical-100/20 rounded-full mx-auto mb-4 w-12 h-12">
          ${card.icon}
        </div>
        <h3 class="text-xl font-medium tracking-tight capitalize mb-2">${card.title}</h3>
        <p class="leading-relaxed">${card.description}</p>
      </div>
    `;
    fragment.appendChild(div);
  });
  container.appendChild(fragment);
}
