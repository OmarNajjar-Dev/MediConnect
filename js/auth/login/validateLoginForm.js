export function validateLoginForm() {
  const form = document.getElementById("login-form");
  const loginBtn = document.getElementById("login-btn");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const rememberMeCheckbox = document.getElementById("remember-me");
  const errorToast = document.getElementById("login-error-toast");

  if (!form || !loginBtn) return;

  loginBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    const formData = new URLSearchParams();
    formData.append("email", emailInput.value);
    formData.append("password", passwordInput.value);
    if (rememberMeCheckbox.checked) {
      formData.append("remember_me", "1");
    }

    const res = await fetch("/MediConnect/backend/auth/login-handler.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: formData.toString(),
    });

    const data = await res.json();

    if (data.success) {
      window.location.href = "./dashboard/superadmin.php";
    } else {
      errorToast.classList.remove("hidden");
      setTimeout(() => errorToast.classList.add("hidden"), 5000);
    }
  });
}
