// 1. Fetch hospitals from the backend
async function fetchHospitals() {
  try {
    const response = await fetch("/mediconnect/backend/api/get-hospitals.php");
    const hospitals = await response.json();
    return hospitals;
  } catch (error) {
    console.error("Failed to fetch hospitals:", error);
    return [];
  }
}

// 2. Render hospital options using innerHTML and DocumentFragment
function renderHospitalOptions(hospitals) {
  const menu = document.getElementById("hospital-menu");
  if (!menu) return;

  menu.innerHTML = ""; // Clear existing content

  const fragment = document.createDocumentFragment();

  // Generate HTML string for all hospitals
  const listHtml = hospitals
    .map(
      (hospital) => `
    <li>
      <button type="button"
              data-dropdown-option
              data-value="${hospital.hospital_id}"
              class="w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-neutral-100 pointer">
        <span>${hospital.name}</span>
        <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i>
      </button>
    </li>
  `
    )
    .join("");

  // Create a temporary container to convert HTML string to nodes
  const tempContainer = document.createElement("div");
  tempContainer.innerHTML = listHtml;

  // Append nodes from temp container to fragment
  Array.from(tempContainer.children).forEach((child) => {
    fragment.appendChild(child);
  });

  // Append to actual dropdown menu
  menu.appendChild(fragment);

  // Re-render Lucide icons
  if (window.lucide) lucide.createIcons();

  // Attach check-icon logic
  const buttons = menu.querySelectorAll("button[data-dropdown-option]");
  buttons.forEach((btn) => {
    btn.addEventListener("click", () => {
      // Hide all check icons
      buttons.forEach((b) => {
        b.querySelector("svg")?.classList.add("hidden");
      });

      // Show the one for selected
      btn.querySelector("svg")?.classList.remove("hidden");
    });
  });
}

// 3. Public initializer
export async function renderHospitals() {
  const hospitals = await fetchHospitals();
  renderHospitalOptions(hospitals);
}
