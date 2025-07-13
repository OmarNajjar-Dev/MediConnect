export async function sendEmail() {
  const emailEndpoint = "https://api.emailjs.com/api/v1.0/email/send";

  let subject = document.getElementById("dropdown-button span")?.textContent;
  subject = subject === "Select a subject" ? null : subject;

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
      alert("✅ Your message was sent successfully. Thank you!");
    } else {
      console.error("❌ Email sending failed. Response body:", responseText);
      alert("❌ Something went wrong while sending your message. Please try again later.");
    }
  } catch (error) {
    console.error("❌ Network error while sending email:", error);
    alert("❌ Network error. Please check your internet connection and try again.");
  }
}
