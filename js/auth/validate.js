export function setupPasswordMatchCheck() {
  document.addEventListener('DOMContentLoaded', () => {
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm-password");
    const errorText = document.getElementById("password-error");

    if (password.value !== confirmPassword.value) {
      e.preventDefault();
      errorText.classList.remove('hidden');
      return false;
    } else {
      errorText.classList.add('hidden');
      return true;
    }

  });
}
