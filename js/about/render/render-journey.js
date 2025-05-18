export function renderJourney(items, container) {
  const fragment = document.createDocumentFragment();

  items.forEach((item) => {
    const div = document.createElement("div");
    div.className = "rounded-xl p-6 h-full shadow-sm hover:shadow-md transition-shadow bg-white border border-solid border-medical-100";
    div.innerHTML = `
      <div class="text-center p-6">
        <div class="bg-medical-100 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
          <i data-lucide="${item.icon}" class="h-7 w-7 text-medical-700"></i>
        </div>
        <h3 class="text-2xl font-bold mb-2 text-medical-700">${item.year}</h3>
        <h4 class="font-medium mb-3 text-gray-900">${item.title}</h4>
        <p class="text-gray-600">${item.description}</p>
      </div>
    `;
    fragment.appendChild(div);
  });

  container.appendChild(fragment);
}
