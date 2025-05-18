export function renderVision(items, container) {
  const fragment = document.createDocumentFragment();

  items.forEach(item => {
    const div = document.createElement("div");
    div.className = "border border-solid border-medical-100 rounded-xl p-6 bg-medical-50/50";
    div.innerHTML = `
      <div class="flex items-start p-4">
        <div class="flex items-center justify-center rounded-full bg-medical-100 p-2 mr-4 shrink-0">
          <i data-lucide="${item.icon}" class="h-5 w-5 text-medical-700"></i>
        </div>
        <div>
          <h3 class="text-heading sm:text-3xl tracking-tight font-medium mb-2">${item.title}</h3>
          <p class="text-sm text-gray-600">${item.description}</p>
        </div>
      </div>
    `;
    fragment.appendChild(div);
  });

  container.appendChild(fragment);
}