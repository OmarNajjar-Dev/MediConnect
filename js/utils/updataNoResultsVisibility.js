export function updateNoResultsVisibility(cards, noResultsElement) {
  const anyVisible = Array.from(cards).some((card) => {
    const style = window.getComputedStyle(card);
    return style.display !== "none" && style.visibility !== "hidden" && card.offsetHeight > 0;
  });

  noResultsElement?.classList.toggle("hidden", anyVisible);
}
