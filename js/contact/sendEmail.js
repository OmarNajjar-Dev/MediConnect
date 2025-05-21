export async function sendEmail() {
  const emailEndpoint = "https://api.emailjs.com/api/v1.0/email/send";

  const emailData = {
    service_id: "service_5p2nj9m",
    template_id: "elio123",
    user_id: "kLGuKHDTc--RzYINt",
    template_params: {
      to_name: "Elio",
      from_name: document.getElementById("name").value.trim(),
      from_email: document.getElementById("email").value.trim(),
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
      alert("Message sent successfully!");
    } else {
      console.error("EmailJS Error:", responseText);
      alert("Message failed. See console for details.");
    }
  } catch (error) {
    console.error("Network Error:", error);
    alert("A network error occurred: " + error.message);
  }
}