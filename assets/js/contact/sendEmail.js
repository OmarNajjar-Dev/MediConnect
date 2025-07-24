import { showSuccessToast, showErrorToast } from "../common/toast.js";

// Cache for EmailJS configuration
let emailJSConfig = null;

// Function to get EmailJS configuration
async function getEmailJSConfig() {
  if (emailJSConfig) {
    return emailJSConfig;
  }

  try {
    const response = await fetch("/backend/api/utils/get-emailjs-config.php");
    const result = await response.json();

    if (result.success) {
      emailJSConfig = result.data;
      return emailJSConfig;
    } else {
      throw new Error("Failed to load EmailJS configuration");
    }
  } catch (error) {
    console.error("Error loading EmailJS configuration:", error);
    console.error("Response status:", response?.status);
    console.error("Response text:", await response?.text());
    throw error;
  }
}

export async function sendEmail() {
  const submitBtn = document.getElementById("contact-submit-btn");
  const originalText = submitBtn.textContent;

  // Set loading state
  submitBtn.disabled = true;
  submitBtn.textContent = "Sending...";
  submitBtn.classList.add("opacity-70", "cursor-not-allowed");
  submitBtn.classList.remove("hover:bg-primary");

  try {
    // Get EmailJS configuration
    const config = await getEmailJSConfig();

    const emailEndpoint = "https://api.emailjs.com/api/v1.0/email/send";
    const subject = document.querySelector(
      "#dropdown-button span"
    )?.textContent;

    const emailData = {
      service_id: config.service_id,
      template_id: config.template_id,
      user_id: config.public_key,
      template_params: {
        to_name: "MediConnect",
        from_name: document.getElementById("name").value.trim(),
        from_email: document.getElementById("email").value.trim(),
        subject: subject,
        message: document.getElementById("message").value.trim(),
      },
    };

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
    console.error("Error in sendEmail:", error);
    showErrorToast(
      "Configuration Error",
      "Unable to load email configuration. Please try again later."
    );
  } finally {
    // Reset button state
    submitBtn.disabled = false;
    submitBtn.textContent = originalText;
    submitBtn.classList.remove("opacity-70", "cursor-not-allowed");
    submitBtn.classList.add("hover:bg-primary");
  }
}
