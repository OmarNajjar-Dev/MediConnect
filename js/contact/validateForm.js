export function validateForm() {
  const emailInput = document.getElementById("email").value.trim();
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  // Validate Email
  if (!emailInput) {
    alert("The email is required. Please enter your email.");
    return false;
  }

  if (!emailRegex.test(emailInput)) {
    alert("Please enter a valid email address (e.g., example@mail.com).");
    return false;
  }

  return true;
}