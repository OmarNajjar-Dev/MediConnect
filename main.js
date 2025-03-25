const services = [
  {
    icon: "<i data-lucide='calendar'></i>",
    title: "Appointment Booking",
    description:
      "Schedule appointments with doctors and receive notifications for any changes.",
    linkText: "Book Now",
    linkHref: "/appointments.html",
  },
  {
    icon: "<i data-lucide='clipboard-list'></i>",

    title: "Medical Reports",
    description:
      "Receive digital medical reports and prescriptions directly from your doctor.",
    linkText: "Learn More",
    linkHref: "/reports.html",
  },
  {
    icon: "<i data-lucide='hospital'></i>",
    title: "Hospital Information",
    description:
      "Find hospitals with available beds and emergency services in your area.",
    linkText: "View Hospitals",
    linkHref: "/hospitals.html",
  },
  {
    icon: "<i data-lucide='plus-circle'></i>",
    title: "Pharmacy Orders",
    description:
      "Order prescription and over-the-counter medications from registered pharmacies.",
    linkText: "Order Medicines",
    linkHref: "pharmacy.html",
  },
];

const container = document.getElementById("services-container");
const cards = services.map(
  (service) =>
  `
    <div class="service-card rounded-xl p-6 bg-card shadow flex flex-col h-full">
      <div class="mb-6 w-14 h-14 bg-medical-100 text-medical-600 rounded-lg flex items-center justify-center">${service.icon}</div>
      <h3 class="service-title text-xl tracking-tight font-medium mb-3">${service.title}</h3>
      <p class="text-gray-600 mb-4">${service.description}</p>
      <a href="${service.linkHref}" class="service-link text-main inline-flex items-center gap-2 rounded-lg justify-start p-0 hover:bg-medical-50 hover:text-medical-500 h-10"><span>${service.linkText}</span><i data-lucide="arrow-right" class="right-arrow w-4 h-4 ml-2"></i></a>
    </div>
    
  `
);
      
// Now use forEach to append all cards to the container
cards.forEach((card) => (container.innerHTML += card));
   

