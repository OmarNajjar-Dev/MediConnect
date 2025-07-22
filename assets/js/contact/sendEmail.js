import { showSuccessToast, showErrorToast } from "../common/toast.js";

export async function sendEmail() {
  const submitBtn = document.getElementById("contact-submit-btn");
  const originalText = submitBtn.textContent;

  // Set loading state
  submitBtn.disabled = true;
  submitBtn.textContent = "Sending...";
  submitBtn.classList.add("opacity-70", "cursor-not-allowed");
  submitBtn.classList.remove("hover:bg-primary");

  const emailEndpoint = "https://api.emailjs.com/api/v1.0/email/send";

  const subject = document.querySelector("#dropdown-button span")?.textContent;

  const emailData = {
    service_id: "service_tjk4vcw",
    template_id: "template_chqvqdb",
    user_id: "HYJ9rNlhhrXT4tlMY",
    template_params: {
      to_name: "MediConnect",
      from_name: document.getElementById("name").value.trim(),
      from_email: document.getElementById("email").value.trim(),
      subject: subject,
      message: document.getElementById("message").value.trim(),
    },
  };

  try {
    const response = await fetch(emailEndpoint, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(emailData),
    });

    const responseText = await response.text();

    if (response.ok) {
      showSuccessToast(
        "Message Sent!",
        "Your message was sent successfully. We'll get back to you soon!"
      );
    } else {
      console.error("Email sending failed. Response body:", responseText);
      showErrorToast(
        "Sending Failed",
        "Something went wrong while sending your message. Please try again later."
      );
    }
  } catch (error) {
    console.error("Network error while sending email:", error);
    showErrorToast(
      "Network Error",
      "Please check your internet connection and try again."
    );
  } finally {
    // Reset button state
    submitBtn.disabled = false;
    submitBtn.textContent = originalText;
    submitBtn.classList.remove("opacity-70", "cursor-not-allowed");
    submitBtn.classList.add("hover:bg-primary");
  }
}
