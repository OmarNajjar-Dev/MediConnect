export function handleCheckboxToggle() {
  const checkbox = document.getElementById("agree-checkbox");
  const button = document.getElementById("signup-btn");

  checkbox?.addEventListener("change", function () {
    const isChecked = this.checked;

    button?.classList.toggle("bg-medical-200", !isChecked);
    button?.classList.toggle("cursor-pointer-events-none", !isChecked);
    button?.classList.toggle("bg-primary", isChecked);
    button?.classList.toggle("hover:bg-medical-700", isChecked);

    button?.classList.toggle("cursor-pointer", isChecked);
    button?.parentElement?.classList.toggle("not-allowed", !isChecked);
  });
}
