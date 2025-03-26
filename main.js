const testimonials = [
  {
    name: "Sarah Johnson",
    role: "Patient",
    content: `"MediConnect made it so easy to find a specialist and book an appointment. I love being able to see doctor ratings before making a choice."`,
    avatar: "S",
    stars: 5, // Number of stars to display
    transitionDelay: "0ms"
  },
  {
    name: "Dr. Michael Chen",
    role: "Cardiologist",
    content: `"The platform streamlines patient bookings and allows me to efficiently manage appointments and share medical reports securely."`,
    avatar: "M",
    stars: 5, // Number of stars to display
    transitionDelay: "100ms"
  },
  {
    name: "Emma Rodriguez",
    role: "Nurse",
    content: `"Creating and sharing dietary plans with patients has never been easier. The interface is intuitive and saves us so much time."`,
    avatar: "E",
    stars: 5, // Number of stars to display
    transitionDelay: "200ms"
  }
];


// Use map to create an array of testimonial HTML strings
const testimonialHTMLs = testimonials.map(testimonial => {
  return `
    <div class="animate-on-scroll" style="transition-delay: ${testimonial.transitionDelay};">
      <div class="glass-card rounded-xl p-6 bg-card border border-solid border-card shadow-sm h-full">
        <div class="flex flex-col h-full">
          <div class="mb-6">
            <div class="flex mb-1">
              ${generateStars(testimonial.stars)}
            </div>
          </div>
          <p class="text-gray-600 mb-6 flex-grow italic">${testimonial.content}</p>
          <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-medical-200 flex items-center justify-center text-medical-700 font-medium">
              ${testimonial.avatar}
            </div>
            <div class="ml-3">
              <p class="font-medium">${testimonial.name}</p>
              <p class="text-sm text-gray-500">${testimonial.role}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  `;
});

// Use forEach to append the HTML to the container
testimonialHTMLs.forEach(html => {
  container.innerHTML += html;
});
//generate stars 
function generateStars(stars) {
  let starsHTML = '';

  for (let i = 1; i <= 5; i++) {
    const span =document.createElement("span");
    const starIcon = document.createElement('i');
    
    // Set the data-lucide attribute to identify the icon
    starIcon.setAttribute('data-lucide', 'star');
    
    // Set the fill color using the 'fill' attribute
    if (i <= stars) {
      span.className="text-yellow-800";
    } else {
      span.className="text-gray-300";
    }
    span.appendChild(starIcon);
    starsHTML += span.outerHTML; // Convert the element to HTML string and append it
  }

  return starsHTML;
}