export const servicesCardsData = [
  {
    icon: "<i data-lucide='calendar' class='w-7 h-7'></i>",
    title: "Appointment Booking",
    description:
      "Schedule appointments with doctors and receive notifications for any changes.",
    linkText: "Book Now",
    linkHref: "/appointments.html",
    animationDelay: "0ms",
  },
  {
    icon: "<i data-lucide='clipboard-list' class='w-7 h-7'></i>",
    title: "Medical Reports",
    description:
      "Receive digital medical reports and prescriptions directly from your doctor.",
    linkText: "Learn More",
    linkHref: "/reports.html",
    animationDelay: "100ms",
  },
  {
    icon: "<i data-lucide='hospital' class='w-7 h-7'></i>",
    title: "Hospital Information",
    description:
      "Find hospitals with available beds and emergency services in your area.",
    linkText: "View Hospitals",
    linkHref: "/hospitals.html",
    animationDelay: "200ms",
  },
  {
    icon: "<i data-lucide='plus-circle' class='w-7 h-7'></i>",
    title: "Pharmacy Orders",
    description:
      "Order prescription and over-the-counter medications from registered pharmacies.",
    linkText: "Order Medicines",
    linkHref: "/pharmacy.html",
    animationDelay: "300ms",
  },
];

export function renderServicesCards(container) {
  const fragment = document.createDocumentFragment();
  servicesCardsData.forEach((card) => {
    const div = document.createElement("div");
    div.className = "animate-on-scroll";
    div.style.animationDelay = card.animationDelay;
    div.innerHTML = `
      <div class="service-card rounded-xl p-6 bg-card shadow-sm transition-all backdrop-blur-md border border-solid border-card h-full">
        <div class="flex flex-col h-full">
          <div class="mb-6 w-14 h-14 bg-medical-100 text-medical-600 rounded-md flex items-center justify-center">
            ${card.icon}
          </div>
          <h3 class="text-heading text-xl tracking-tight font-medium mb-3">${card.title}</h3>
          <p class="text-gray-600 mb-4 flex-grow leading-relaxed">${card.description}</p>
          <a href="${card.linkHref}" class="service-link text-sm font-medium text-heading inline-flex items-center gap-2 rounded-lg justify-start hover:bg-medical-50 hover:text-medical-500 h-10 whitespace-nowrap">
            <span>${card.linkText}</span>
            <i data-lucide="arrow-right" class="right-arrow w-4 h-4 ml-2 transition-transform"></i>
          </a>
        </div>
      </div>
    `;
    fragment.appendChild(div);
  });
  container.appendChild(fragment);
}
