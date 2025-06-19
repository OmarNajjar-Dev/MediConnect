# MediConnect - Healthcare Connection Platform

## Project Overview

MediConnect is a lightweight healthcare web platform that connects patients with hospitals, doctors, and emergency services. Built using plain HTML, CSS, JavaScript, and PHP, it delivers a fast, accessible, and framework-free experience for managing healthcare services.

---

## 🚀 Key Features

### Patient Services

- **Doctor Discovery**: Browse verified healthcare professionals by specialty
- **Hospital Directory**: Locate hospitals and healthcare facilities
- **Appointment Booking**: Schedule and manage medical appointments
- **Emergency Services**: Access COVID-19-focused emergency care

### Healthcare Provider Tools

- **Role-Based Dashboard**: Tailored interfaces based on user type
- **Permission Management**: Secure role-based access control
- **Appointment Management**: Tools for managing patient scheduling

### Platform Features

- **Responsive Design**: Optimized for desktop and mobile
- **Live Updates**: Real-time status tracking for appointments and emergencies
- **Rating System**: Patients can rate doctors, hospitals, and services
- **Multi-language Support**: Accessible to a global audience

---

## 👥 User Roles & Permissions

| Role           | Access Level        | Capabilities                                                  |
| -------------- | ------------------- | ------------------------------------------------------------- |
| Super Admin    | Full Access         | Full platform management                                      |
| Admin          | Hospital Management | Manage users, doctors, appointments                           |
| Doctor         | Medical Services    | Access to patient records, prescriptions, and scheduling      |
| Patient        | Personal Health     | Book appointments, view prescriptions, manage profile         |
| Staff          | Reception Services  | Schedule appointments, handle patient registration            |
| Ambulance Team | Emergency Response  | Handle real-time emergency tracking and response coordination |

---

## 🛠 Technologies Used

- HTML5
- CSS3
- JavaScript (ES6+)
- PHP (for backend logic and basic routing)
- DOM APIs and localStorage
- No external frameworks

---

## 📱 Pages & Navigation

### Core Pages

- `/` — Home
- `/dashboard` — Role-based dashboard
- `/doctors` — Doctor listings
- `/hospitals` — Hospital directory
- `/appointments` — Appointment booking
- `/emergency` — Emergency services

### Informational Pages

- `/about` — Platform mission
- `/privacy` — Privacy policy
- `/terms` — Terms of service
- `/contact` — Contact form
- `/faq` — Frequently asked questions
- `/accessibility` — Accessibility commitment

---

## 🎨 Design System

### Color Palette

- **Primary**: Medical green with clean neutral tones
- **Contrast**: WCAG-compliant color ratios

### Components

- **Modular Layout**: Reusable header, footer, forms, cards, and tables
- **Responsive Grid**: Built with pure CSS (flexbox and grid)
- **SVG Icons**: Clean and scalable interface
- **Smooth UX**: Minimal JS-based animations and transitions

---

## 🔒 Security & Permissions

- Role-based visibility for UI and actions
- Input validation using plain JavaScript
- Simple session and access control via PHP
- Basic error handling and user feedback

---

## 🚦 Getting Started

### Requirements

- A modern web browser
- A local or remote PHP server (e.g., XAMPP, WAMP, or Apache)

### Installation

```sh
# Clone the repository
git clone https://github.com/OmarNajjar-Dev/MediConnect.git

# Navigate into the project folder
cd mediconnect

# Launch using a local PHP server
# Example:
php -S localhost:8000
```
