export function setupPasswordToggle(passwordId, buttonId) {
  const passwordInput = document.getElementById("password");
  const toggleBtn = document.getElementById("togglePassword");


  toggleBtn.addEventListener('click', () => {
    const isPassword = passwordInput.type === 'password';

    passwordInput.type = isPassword ? 'text' : 'password';

    const iconName = isPassword ? 'eye-off' : 'eye';
    toggleBtn.innerHTML = `<i data-lucide="${iconName}" class="eye-toggle-icon h-5 w-5 text-gray-400"></i>`;

    lucide.createIcons(); 
  });
}
