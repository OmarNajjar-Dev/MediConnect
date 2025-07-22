export function renderLeadership(items, container) {
  const fragment = document.createDocumentFragment();

  items.forEach((item) => {
    const div = document.createElement("div");
    div.className =
      "leadership__leader flex flex-col lg:flex-row rounded-2xl shadow-xl hover:shadow-2xl transition-shadow overflow-hidden min-h-75 lg:max-h-137.5";
    div.innerHTML = `
      <div class="lg:w-2/5 w-full h-full overflow-hidden">
        <img src="${item.image}" alt="${item.name}"
          class="leadership__leader-image transition-transform transition-800 w-full h-full object-cover object-center" />
      </div>
      <div class="lg:w-3/5 w-full p-8 flex flex-col justify-between">
        <div>
          <h3 class="leadership__leader-name text-3xl tracking-tight font-bold text-heading mb-2 transition-colors">${item.name}</h3>
          <p class="text-primary font-medium mb-6 tracking-wide text-lg">${item.role}</p>
          <p class="text-gray-600 mb-6 leading-relaxed">${item.bio}</p>
          <p class="text-medical-700 font-medium text-sm">${item.degrees}</p>
        </div>
        <div class="flex gap-4 mt-6">
          <button type="button" class="flex items-center gap-2 border border-solid border-input bg-background font-medium cursor-pointer px-3 h-9 rounded-full text-sm text-heading hover:bg-medical-50 hover:text-medical-500 transition-colors">
            <i data-lucide="linkedin" class="w-4 h-4 mr-2"></i>Connect
          </button>
          <button type="button" class="flex items-center gap-2 border border-solid border-input bg-background font-medium cursor-pointer px-3 h-9 rounded-full text-sm text-heading hover:bg-medical-50 hover:text-medical-500 transition-colors">
            <i data-lucide="mail" class="w-4 h-4 mr-2"></i>Contact
          </button>
        </div>
      </div>
    `;
    fragment.appendChild(div);
  });

  container.appendChild(fragment);
}
