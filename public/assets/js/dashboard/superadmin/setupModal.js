export function setupModal() {
  const overlay = document.querySelector('[data-dialog="overlay"]');
  const modal = document.querySelector('[data-dialog="modal"]');
  const openBtn = document.querySelector('[data-modal-trigger]');
  const closeButtons = document.querySelectorAll('[data-modal-close]');

  if (!overlay || !modal || !openBtn) return;

  // Show the modal
  openBtn.addEventListener('click', () => {
    overlay.classList.remove('hidden');
    overlay.classList.add("fixed");

    modal.classList.remove('hidden');
    modal.classList.add("fixed");
  });

  // Hide the modal when clicking any close button
  closeButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      overlay.classList.add('hidden');
      overlay.classList.remove("fixed");

      modal.classList.add('hidden');
      modal.classList.remove("fixed");
    });
  });

  // Hide the modal when clicking the overlay
  overlay.addEventListener('click', () => {
    overlay.classList.add('hidden');
    modal.classList.add('hidden');
  });
}
