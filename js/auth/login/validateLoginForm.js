export function validateLoginForm() {
  const form = document.getElementById("login-form");
  const loginBtn = document.getElementById("login-btn");
  const emailInput = document.getElementById("email");
  const passwordInput = document.querySelector(".password");
  const errorToast = document.getElementById("login-error-toast");

  if (!form || !loginBtn) return; // Prevents the TypeError

  loginBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    const res = await fetch("backend/login-handler.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `email=${encodeURIComponent(emailInput.value)}&password=${encodeURIComponent(passwordInput.value)}`
    });

    const data = await res.json();

    if (data.success) {
      window.location.href = "dashboard.php";
    } else {
      errorToast.classList.remove("hidden");
      setTimeout(() => errorToast.classList.add("hidden"), 5000);
    }
  });
}
