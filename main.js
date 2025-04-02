const doctors = [
    {
      id: 1,
      name: "Dr. Sarah Johnson",
      specialty: "Gastroenterologist",
      imageUrl: "https://randomuser.me/api/portraits/women/45.jpg",
      hospital: "Central Medical Center",
      rating: 4.9,
      reviews: 124,
      bio: "Dr. Sarah Johnson is a board-certified cardiologist with over 12 years of experience in treating cardiovascular diseases. She completed her medical training at Harvard Medical School...",
      profileLink: "/appointments?doctor=1"
    },
    {
      id: 2,
      name: "Dr. Michael Chen",
      specialty: "Dentist",
      imageUrl: "https://randomuser.me/api/portraits/men/32.jpg",
      hospital: "Westside Hospital",
      rating: 4.7,
      reviews: 98,
      bio: "Dr. Michael Chen specializes in medical, surgical, and cosmetic dermatology. He has expertise in treating skin conditions like acne, eczema, psoriasis, and skin cancer...",
      profileLink: "/appointments?doctor=2"
    },
    {
      id: 3,
      name: "Dr. Emily Rodriguez",
      specialty: "Virologist",
      imageUrl: "https://randomuser.me/api/portraits/women/63.jpg",
      hospital: "Metropolitan Medical Center",
      rating: 4.8,
      reviews: 156,
      bio: "Dr. Emily Rodriguez is a neurologist with expertise in headache disorders, multiple sclerosis, and neurodegenerative diseases. She is dedicated to providing compassionate care...",
      profileLink: "/appointments?doctor=3"
    },
    {
      id: 4,
      name: "Dr. James Wilson",
      specialty: "Orthopedic Surgeon",
      imageUrl: "https://randomuser.me/api/portraits/men/46.jpg",
      hospital: "Central Medical Center",
      rating: 4.6,
      reviews: 87,
      bio: "Dr. James Wilson is an orthopedic surgeon specializing in sports medicine, joint replacement, and trauma. With 20 years of experience, he has helped thousands of patients...",
      profileLink: "/appointments?doctor=4"
    },
    {
      id: 5,
      name: "Dr. Lisa Kim",
      specialty: "Pediatrics",
      imageUrl: "https://randomuser.me/api/portraits/women/69.jpg",
      hospital: "Children's Health Center",
      rating: 4.9,
      reviews: 142,
      bio: "Dr. Lisa Kim is a dedicated pediatrician who provides comprehensive healthcare for children from birth through adolescence. She is known for her gentle approach...",
      profileLink: "/appointments?doctor=5"
    },
    {
      id: 6,
      name: "Dr. Robert Taylor",
      specialty: "Ophthalmologist",
      imageUrl: "https://randomuser.me/api/portraits/men/79.jpg",
      hospital: "Behavioral Health Institute",
      rating: 4.8,
      reviews: 73,
      bio: "Dr. Robert Taylor is a psychiatrist specializing in mood disorders, anxiety, and PTSD. He takes a holistic approach to mental health, combining medication management...",
      profileLink: "/appointments?doctor=6"
    }
  ];
  
  // Use .map() to render the doctor cards dynamically
const container = document.getElementById('doctor-cards-container'); // Make sure to add a container div in your HTML

doctors.map(doctor => {
  const doctorCard = `
    <div class="backdrop-blur-md bg-white/50 border border-white/20 shadow-sm animate-fade-in rounded-lg p-6">
      <div class="flex flex-col h-full">
        <div class="flex items-start mb-4">
          <div class="w-20 h-20 rounded-full overflow-hidden mr-4 flex-shrink-0">
            <img src="${doctor.imageUrl}" alt="${doctor.name}" class="w-full h-full object-cover" loading="lazy"/>
          </div>
        
          <div>
            <h2 class="text-lg font-bold">${doctor.name}</h2>
            <p class="text-medical-600 font-medium">${doctor.specialty}</p>
            <div class="flex items-center mt-1 mb-1">
              <i class="lucide lucide-user text-gray-500 mr-1" style="font-size: 14px;"></i>
              <span class="text-gray-600 text-sm">${doctor.hospital}</span>
            </div>
            <div class="flex items-center">
              <!-- Replacing SVG with Lucide Star Icon -->
              <i data-lucide="star" class="text-star-400 fill-star-400 w-4 h-4"></i>
              <span class="font-medium text-sm">${doctor.rating}</span>
              <span class="text-gray-500 text-xs ml-1">(${doctor.reviews} reviews)</span>
            </div>
          </div>
        </div>

        <div class="text-sm text-gray-600 mb-4 flex-grow">
          ${doctor.bio}
        </div>

        <div class="flex space-x-2 mt-2">
          <button class="flex-1 text-sm inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-solid border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
            View Profile
          </button>
          <a href="${doctor.profileLink}" class="flex-1 text-sm inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">
            Book Appointment
          </a>
        </div>
      </div>
    </div>
  `;

  container.innerHTML += doctorCard; // Add the rendered card to the container
});