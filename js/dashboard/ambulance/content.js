const tabs = [
  {
    button: document.getElementById("tab-trigger-emergencies"),
    content: document.getElementById("tab-content-emergencies"),
  },
  {
    button: document.getElementById("tab-trigger-notifications"),
    content: document.getElementById("tab-content-notifications"),
  },
  {
    button: document.getElementById("tab-trigger-status"),
    content: document.getElementById("tab-content-status"),
  },
];

function switchTab(activeIndex) {
  tabs.forEach((tab, i) => {
    if (i === activeIndex) {
      tab.button.classList.add("bg-white");
      tab.button.classList.remove("bg-gray-150");
      tab.content.classList.remove("hidden");
    } else {
      tab.button.classList.remove("bg-white");
      tab.button.classList.add("bg-gray-150");
      tab.content.classList.add("hidden");
    }
  });
}

tabs.forEach((tab, index) => {
  tab.button.addEventListener("click", () => switchTab(index));
});

switchTab(0);
