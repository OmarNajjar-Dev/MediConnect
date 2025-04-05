const doctors = [
    {
      id: 1,
      name: "Dr. Sarah Johnson",
      specialty: "Cardiologist",
      imageUrl: "https://randomuser.me/api/portraits/women/45.jpg",
      hospital: "Central Medical Center",
      rating: 4.9,
      reviews: 124,
      bio: "Dr. Sarah Johnson is a board-certified cardiologist with over 12 years of experience in treating cardiovascular diseases...",
      profileLink: "/appointments?doctor=1"
    },
    {
      id: 2,
      name: "Dr. Michael Chen",
      specialty: "Dermatologist",
      imageUrl: "https://randomuser.me/api/portraits/men/32.jpg",
      hospital: "Westside Hospital",
      rating: 4.7,
      reviews: 98,
      bio: "Dr. Michael Chen specializes in medical, surgical, and cosmetic dermatology. He has expertise in treating skin conditions...",
      profileLink: "/appointments?doctor=2"
    },
    {
      id: 3,
      name: "Dr. Emily Rodriguez",
      specialty: "Neurology",
      imageUrl: "https://randomuser.me/api/portraits/women/63.jpg",
      hospital: "Metropolitan Medical Center",
      rating: 4.8,
      reviews: 156,
      bio: "Dr. Emily Rodriguez is a neurologist with expertise in headache disorders, multiple sclerosis, and neurodegenerative diseases...",
      profileLink: "/appointments?doctor=3"
    },
    {
      id: 4,
      name: "Dr. James Wilson",
      specialty: "Orthopedics",
      imageUrl: "https://randomuser.me/api/portraits/men/46.jpg",
      hospital: "Central Medical Center",
      rating: 4.6,
      reviews: 87,
      bio: "Dr. James Wilson is an orthopedic surgeon specializing in sports medicine, joint replacement, and trauma. With 20 years...",
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
      bio: "Dr. Lisa Kim is a dedicated pediatrician who provides comprehensive healthcare for children from birth through adolescence...",
      profileLink: "/appointments?doctor=5"
    },
    {
      id: 6,
      name: "Dr. Robert Taylor",
      specialty: "Psychiatry",
      imageUrl: "https://randomuser.me/api/portraits/men/79.jpg",
      hospital: "Behavioral Health Institute",
      rating: 4.8,
      reviews: 73,
      bio: "Dr. Robert Taylor is a psychiatrist specializing in mood disorders, anxiety, and PTSD. He takes a holistic approach to mental health...",
      profileLink: "/appointments?doctor=6"
    }
  ];
  
  // Use .map() to render the doctor cards dynamically
const container = document.getElementById('doctor-cards-container'); // Make sure to add a container div in your HTML

doctors.map(doctor => {
  const doctorCard = `
    <div class="doctor-card backdrop-blur-md bg-card border border-solid border-card shadow-sm animate-fade-in rounded-lg p-6">
      <div class="flex flex-col h-full">
        <div class="flex items-start mb-4">
          <div class="w-20 h-20 rounded-full overflow-hidden mr-4 flex-shrink-0">
            <img src="${doctor.imageUrl}" alt="${doctor.name}" class="w-full h-full object-cover" loading="lazy"/>
          </div>
        
          <div>
            <h2 class="text-lg text-heading font-bold tracking-tight">${doctor.name}</h2>
            <p class="text-medical-600 font-medium">${doctor.specialty}</p>
            <div class="flex items-center mt-1 mb-1">
            <i data-lucide="map-pin" class="h-3.5 w-3.5 text-gray-500 mr-1"></i>
            <span class="text-gray-600 text-sm">${doctor.hospital}</span>
          </div>
          <div class="flex items-center">
           <i data-lucide="star" class="w-3.5 h-3.5 text-star-500 fill-star-500 mr-1"></i>
            <span class="font-medium text-sm">${doctor.rating}</span>
            <span class="text-gray-500 text-xs ml-1">(${doctor.reviews} reviews)</span>
          </div>
        </div>
      </div>

      <div class="text-sm text-gray-600 mb-4 flex-grow">
        ${doctor.bio}
      </div>

      <div class="flex gap-2 mt-2">
        <button class="flex-grow text-sm inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all 
          border border-solid border-input
          bg-background hover:bg-medical-50 hover:text-medical-600 h-10 px-8 py-2">
          View Profile
        </button>
        <a href="${doctor.profileLink}" class="flex-grow text-sm inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium 
        transition-all bg-medical-500 text-white hover:bg-medical-400 h-10 px-2 py-2">
          Book Appointment
        </a>
      </div>
    </div>
  </div>
`;

container.innerHTML += doctorCard; // Add the rendered card to the container
});
