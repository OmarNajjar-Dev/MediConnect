export function hideAllSections(sections) {
  sections.forEach((section) => {
    section.classList.add("hidden");
  });
}