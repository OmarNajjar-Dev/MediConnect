# MediConnect - Healthcare Connection Platform

## Project Overview

MediConnect is a comprehensive healthcare web platform that connects patients with medical professionals, hospitals, pharmacies, and emergency services. Built using pure HTML, CSS, and JavaScript, it offers a streamlined and accessible interface for healthcare service delivery.

---

## 🚀 Key Features

### Patient Services
- **Doctor Discovery**: Browse verified healthcare professionals by specialty
- **Hospital Directory**: Locate hospitals and healthcare facilities
- **Appointment Booking**: Schedule and manage medical appointments
- **Emergency Services**: Access COVID-19-focused emergency care
- **Pharmacy Orders**: Order prescriptions and medications online
- **Blood Donation**: Redirect to official donation centers (e.g., Red Cross)

### Healthcare Provider Tools
- **Role-Based Dashboard**: Tailored interfaces based on user type
- **Permission Management**: Secure role-based access control
- **Appointment Management**: Tools for managing patient scheduling

### Platform Features
- **Responsive Design**: Optimized for both desktop and mobile devices
- **Live Updates**: Real-time status tracking for appointments and emergencies
- **Rating System**: Patients can rate doctors, hospitals, and services
- **Multi-language Support**: Accessible to a diverse global audience

---

## 👥 User Roles & Permissions

| Role            | Access Level          | Capabilities                                                  |
|-----------------|-----------------------|---------------------------------------------------------------|
| Super Admin     | Full Access            | Full platform management                                      |
| Admin           | Hospital Management    | Manage users, doctors, appointments                           |
| Doctor          | Medical Services       | Access to patient records, prescriptions, and scheduling      |
| Nurse           | Patient Care           | Update patient status and view medical records                |
| Patient         | Personal Health        | Book appointments, view prescriptions, manage profile         |
| Staff           | Reception Services     | Schedule appointments, handle patient registration            |
| Pharmacist      | Medication Services    | Verify prescriptions and manage medication records            |
| Ambulance Team  | Emergency Response     | Handle real-time emergency tracking and response coordination |
| Viewer          | Read-Only              | View reports and statistics                                   |

> 🔔 Note: The **Blood Donation** page does **not** support direct donations. It redirects users to an external site (such as the official Red Cross platform) to complete the process.

---

## 🛠 Technologies Used

- HTML5  
- CSS3 (with custom utility classes)  
- JavaScript (ES6+)  
- DOM APIs and localStorage for dynamic behavior  
- Fetch API for backend integration  

---

## 📱 Pages & Navigation

### Core Pages
- `/` — Home (Landing page with overview and services)
- `/dashboard` — User-specific dashboard based on role
- `/doctors` — List of available doctors and specialists
- `/hospitals` — Hospital directory and details
- `/appointments` — Appointment booking and management
- `/emergency` — COVID-19 emergency services
- `/pharmacy` — Order prescriptions and medication
- `/blood-donation` — Redirect to official blood donation website

### Informational Pages
- `/about` — About the platform and mission
- `/privacy` — Privacy policy
- `/terms` — Terms of service
- `/contact` — Contact form and support info
- `/faq` — Frequently asked questions
- `/accessibility` — Accessibility statement

---

## 🎨 Design System

### Color Palette
- **Primary Theme**: Medical green and clean neutrals  
- **Contrast**: Compliant with WCAG accessibility guidelines  

### Components
- **Modular Structure**: Header, Footer, Cards, Forms, Tables, etc.  
- **Responsive Layout**: Grid and flexbox-based responsive design  
- **Icon Integration**: SVG icons for clarity and performance  
- **Smooth Interactions**: Basic animations and transitions using CSS & JS  

---

## 🔒 Security & Permissions

### Access Control
- Role-based visibility for UI elements and actions  
- Custom permission checks per feature  
- Data protection via backend authentication logic  

### Validation & Protection
- Input validation using JavaScript  
- Basic error handling and feedback messages  
- Session handling through tokens or localStorage  

---

## 🚦 Getting Started

### Requirements
- A modern web browser  
- Node.js (optional, for development utilities)  
- A simple backend or API (if dynamic data is used)  

### Installation

```sh
# Clone the repository
git clone <https://github.com/OmarNajjar-Dev/MediConnect.git>

# Navigate into the project folder
cd mediconnect

# Open index.html in your browser
