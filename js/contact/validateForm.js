import { showErrorToast } from "../common/toast.js";

export function validateForm() {
  const nameInput = document.getElementById("name").value.trim();
  const emailInput = document.getElementById("email").value.trim();
  const subjectInput = document
    .getElementById("dropdown-button")
    .textContent.trim();
  const messageInput = document.getElementById("message").value.trim();

  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  // Validate Name
  if (!nameInput) {
    showErrorToast("Name Required", "Please enter your name.");
    return false;
  }

  // Validate Email
  if (!emailInput) {
    showErrorToast("Email Required", "Please enter your email address.");
    return false;
  }

  if (!emailRegex.test(emailInput)) {
    showErrorToast(
      "Invalid Email",
      "Please enter a valid email address (e.g., example@mail.com)."
    );
    return false;
  }

  // Validate Subject
  if (subjectInput === "Select a subject") {
    showErrorToast(
      "Subject Required",
      "Please select a subject for your message."
    );
    return false;
  }

  // Validate Message
  if (!messageInput) {
    showErrorToast("Message Required", "Please enter your message.");
    return false;
  }

  if (messageInput.length < 10) {
    showErrorToast(
      "Message Too Short",
      "Please enter a message with at least 10 characters."
    );
    return false;
  }

  return true;
}
