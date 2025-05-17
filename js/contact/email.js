// email.js
import emailjs from 'https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js';

export function sendEmail(formData) {
  emailjs.init('your_public_key');

  return emailjs.send('your_service_id', 'your_template_id', formData)
    .then(response => {
      console.log('Email sent successfully!', response);
    })
    .catch(error => {
      console.error('Failed to send email.', error);
    });
}
