const services = [
    {
        title: "Appointment Booking",
        description:
            "Schedule appointments with doctors and receive notifications for any changes.",
        linkText: "Book Now",
        linkHref: "#appointments.html",
    },
    {
        title: "Medical Reports",
        description:
            "Receive digital medical reports and prescriptions directly from your doctor.",
        linkText: "Learn More",
        linkHref: "#reports.html",
    },
    {
        title: "Hospital Information",
        description:
            "Find hospitals with available beds and emergency services in your area.",
        linkText: "View Hospitals",
        linkHref: "#hospitals.html",
    },
    {
        title: "Pharmacy Orders",
        description:
            "Order prescription and over-the-counter medications from registered pharmacies.",
        linkText: "Order Medicines",
        linkHref: "#pharmacy.html",
    },
];

const container = document.getElementById("services-container");

services.forEach((service) => { // Ask ChatGPT for storing the result using map before display it with forEach
    const card = document.createElement("div");
    card.classList.add("service-card");

    card.innerHTML = `
            <div class="icon">${service.icon}</div>
            <div class="service-title">${service.title}</div>
            <p class="service-description">${service.description}</p>
            <a href="${service.linkHref}" class="service-link">${service.linkText} →</a>
        `;

    container.appendChild(card);
});
