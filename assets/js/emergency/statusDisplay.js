export function updateStatusDisplay(status) {
  // Update the status section to show completion
  const statusSection = document.getElementById("status-section");
  if (!statusSection) return;

  // Find the status badge and update it
  const statusBadge = statusSection.querySelector(".inline-flex");
  if (statusBadge && status === "completed") {
    statusBadge.className =
      "inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border border-solid border-transparent text-white hover:bg-green-400 bg-green-500 mb-2";
    statusBadge.textContent = "COMPLETED";
  }

  // Update the main status text
  const statusTitle = statusSection.querySelector("h3");
  if (statusTitle && status === "completed") {
    statusTitle.textContent = "Emergency Response Completed";
  }

  // Update the description
  const statusDesc = statusSection.querySelector(
    "p.text-sm.text-muted-foreground"
  );
  if (statusDesc && status === "completed") {
    statusDesc.textContent =
      "Emergency response team has successfully reached your location";
  }
}
