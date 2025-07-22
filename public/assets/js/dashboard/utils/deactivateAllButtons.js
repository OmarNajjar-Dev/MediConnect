export function deactivateAllButtons(buttons) {
  buttons.forEach((btn) => {
    btn.classList.remove("bg-blue-50", "text-blue-700");
  });
}