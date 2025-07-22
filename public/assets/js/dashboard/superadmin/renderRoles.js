// 1. Fetch roles from the backend
async function fetchRoles() {
  try {
    const response = await fetch("api?route=Api/Roles/get-roles");
    const roles = await response.json();
    return roles;
  } catch (error) {
    console.error("Failed to fetch roles:", error);
    return [];
  }
}

// 2. Render role options using innerHTML and DocumentFragment
function renderRoleOptions(roles) {
  const menu = document.getElementById("role-menu");
  if (!menu) return;

  menu.innerHTML = ""; // Clear existing content

  const fragment = document.createDocumentFragment();

  // Generate HTML string for all roles
  const listHtml = roles
    .map(
      (role) => `
    <li>
      <button type="button"
              data-dropdown-option
              data-value="${role}"
              class="w-full flex items-center justify-between px-4 py-1.5 text-sm border-none bg-white text-gray-700 hover:bg-neutral-100 cursor-pointer">
        <span>${role}</span>
        <i data-lucide="check" class="w-4 h-4 text-gray-700 hidden"></i>
      </button>
    </li>
  `
    )
    .join("");

  // Use a temporary container to convert HTML string to nodes
  const tempContainer = document.createElement("div");
  tempContainer.innerHTML = listHtml;

  Array.from(tempContainer.children).forEach((child) => {
    fragment.appendChild(child);
  });

  menu.appendChild(fragment);

  // Re-render Lucide icons
  if (window.lucide) lucide.createIcons();

  // ✅ Attach check-icon logic (same as renderHospitals.js)
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
export async function renderRoles() {
  const roles = await fetchRoles();
  renderRoleOptions(roles);
}
