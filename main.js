// Sample testimonials array
const testimonials = [
  {
    name: "Sarah Johnson",
    role: "Patient",
    content: `"MediConnect made it so easy to find a specialist and book an appointment. I love being able to see doctor ratings before making a choice."`,
    avatar: "S",
    stars: 5, // Number of stars to display
    animationDelay: "0ms",
  },
  {
    name: "Dr. Michael Chen",
    role: "Cardiologist",
    content: `"The platform streamlines patient bookings and allows me to efficiently manage appointments and share medical reports securely."`,
    avatar: "M",
    stars: 5, // Number of stars to display
    animationDelay: "100ms",
  },
  {
    name: "Emma Rodriguez",
    role: "Nurse",
    content: `"Creating and sharing dietary plans with patients has never been easier. The interface is intuitive and saves us so much time."`,
    avatar: "E",
    stars: 5, // Number of stars to display
    animationDelay: "200ms",
  },
];

const testimonialHTMLs = testimonials
  .map((testimonial) => {
    // Generate filled stars based on rating
    const filledStars = Array(testimonial.stars)
      .fill()
      .map(
        () =>
          `<i data-lucide="star" class="text-yellow-400 fill-yellow-400 w-4 h-4"></i>`
      )
      .join("");

    // Generate empty stars for the remaining (5 - rating)
    const emptyStars = Array(5 - testimonial.stars)
      .fill()
      .map(() => `<i data-lucide="star" class="text-gray-400 w-4 h-4"></i>`)
      .join("");

    return `
    <div class="animate-on-scroll" style="Animation-delay: ${testimonial.animationDelay};">
      <div class="rounded-xl p-6 bg-card border border-solid border-card shadow-sm h-full">
        <div class="flex flex-col h-full">
          <div class="mb-6">
            <div class="flex mb-1">
              ${filledStars}
              ${emptyStars}
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
})
.join("");

// Update the container with all testimonials at once
document.getElementById("testimonials-container").innerHTML = testimonialHTMLs;
        
