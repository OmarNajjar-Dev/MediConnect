# MediConnect - Modern Healthcare Connection Platform

<div align="center">
  <h3>🏥 Connecting Patients with Healthcare Professionals</h3>
  <p>A lightweight, framework-free healthcare web platform built with vanilla technologies</p>
  
  <p>
    <img src="https://img.shields.io/badge/HTML5-E34F26?style=flat&logo=html5&logoColor=white" alt="HTML5" />
    <img src="https://img.shields.io/badge/CSS3-1572B6?style=flat&logo=css3&logoColor=white" alt="CSS3" />
    <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=flat&logo=javascript&logoColor=black" alt="JavaScript" />
    <img src="https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white" alt="PHP" />
  </p>
</div>

## 📋 Table of Contents

- [Overview](#overview)
- [Key Features](#key-features)
- [User Roles & Permissions](#user-roles--permissions)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
- [Design System](#design-system)
- [Security](#security)
- [Contributing](#contributing)
- [License](#license)

## 🌟 Overview

MediConnect is a comprehensive healthcare web platform designed to bridge the gap between patients and healthcare providers. Built using vanilla web technologies, it delivers exceptional performance and accessibility without the overhead of heavy frameworks.

### Why MediConnect?

- **🚀 Lightning Fast**: No framework bloat means faster load times
- **♿ Accessible**: WCAG-compliant design ensures universal access
- **📱 Responsive**: Seamless experience across all devices
- **🔒 Secure**: Role-based access control and input validation
- **🌍 Scalable**: Clean architecture ready for growth

## ✨ Key Features

### For Patients

- **🔍 Doctor Discovery**

  - Browse verified healthcare professionals
  - Filter by specialty, location, and ratings
  - View detailed profiles and qualifications

- **🏥 Hospital Directory**

  - Comprehensive listing of healthcare facilities
  - Real-time availability status
  - Distance-based search results

- **📅 Smart Appointment Booking**

  - Schedule appointments with ease
  - Receive confirmation notifications
  - Manage upcoming and past appointments

- **🚨 Emergency Services**
  - Quick access to emergency care
  - COVID-19 focused response system
  - Real-time ambulance tracking

### For Healthcare Providers

- **📊 Role-Based Dashboards**

  - Customized interfaces for each user type
  - Real-time analytics and insights
  - Streamlined workflow management

- **👥 Patient Management**

  - Digital patient records
  - Appointment scheduling tools
  - Prescription management system

- **🔐 Access Control**
  - Granular permission settings
  - Secure data handling
  - Audit trail functionality

### Platform Features

- **⭐ Rating & Review System**: Build trust through patient feedback
- **🔄 Live Updates**: Real-time status tracking for appointments
- **🌐 Multi-language Support**: Reaching a global audience
- **📱 Progressive Enhancement**: Works on any device, any connection

## 👥 User Roles & Permissions

| Role               | Access Level          | Key Capabilities                                                                   |
| ------------------ | --------------------- | ---------------------------------------------------------------------------------- |
| **Super Admin**    | Full Platform Control | • Complete system management<br>• User role assignment<br>• Platform configuration |
| **Admin**          | Hospital Management   | • Staff and doctor management<br>• Appointment oversight<br>• Facility settings    |
| **Doctor**         | Medical Services      | • Patient record access<br>• Prescription management<br>• Schedule control         |
| **Patient**        | Personal Health       | • Appointment booking<br>• Medical history access<br>• Profile management          |
| **Staff**          | Reception Services    | • Patient registration<br>• Appointment scheduling<br>• Basic record access        |
| **Ambulance Team** | Emergency Response    | • Real-time dispatch<br>• Route optimization<br>• Patient status updates           |

## 🛠 Tech Stack

### Frontend

- **HTML5** - Semantic markup for better SEO and accessibility
- **CSS3** - Modern styling with Flexbox and Grid
- **JavaScript (ES6+)** - Clean, modular vanilla JS

### Backend

- **PHP** - Server-side logic and routing
- **Sessions** - User authentication and state management

### Architecture

- **MVC Pattern** - Separation of concerns
- **RESTful Routes** - Clean URL structure
- **Modular Components** - Reusable UI elements

### Storage

- **LocalStorage** - Client-side data persistence
- **Database** - Structured data storage (MySQL/PostgreSQL compatible)

## 📁 Project Structure

```
MediConnect/
├── 📂 assets/
│   ├── 📂 css/          # Stylesheets (15 files)
│   └── 📂 js/           # JavaScript modules (12 directories)
├── 📂 backend/
│   ├── 📂 api/          # API endpoints (23 files)
│   ├── 📂 auth/         # Authentication system (5 files)
│   ├── 📂 config/       # Configuration files (3 files)
│   ├── 📂 helpers/      # Helper functions (4 files)
│   └── 📂 middleware/   # Session & access control (5 files)
├── 📂 database/         # SQL files (3 files)
├── 📂 docs/             # Documentation (5 files)
├── 📂 includes/         # Header & footer templates
├── 📂 pages/
│   ├── 📂 auth/         # Login & registration
│   ├── 📂 dashboard/    # Role-based dashboards (7 files)
│   ├── 📂 errors/       # Error pages (4 files)
│   ├── 📂 services/     # Core services (4 files)
│   └── 📂 static/       # Static pages (7 files)
├── 📂 uploads/          # File uploads
├── 📂 sandbox/          # Development/testing
├── 📄 .gitignore
├── 📄 .htaccess
├── 📄 index.php
└── 📄 README.md
```

## 🚀 Getting Started

### Prerequisites

- PHP 7.4 or higher
- Web server (Apache, Nginx, or built-in PHP server)
- Modern web browser
- MySQL/PostgreSQL (optional, for database features)

### Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/OmarNajjar-Dev/MediConnect.git
   cd MediConnect
   ```

2. **Configure your environment**

   ```bash
   # Copy the example configuration
   cp config.example.php config.php

   # Update database credentials and settings
   nano config.php
   ```

3. **Start the development server**

   ```bash
   # Using PHP's built-in server
   php -S localhost:8000

   # Or configure your Apache/Nginx server
   ```

4. **Access the application**
   ```
   Open http://localhost:8000 in your browser
   ```

### Quick Start Guide

1. Navigate to the registration page
2. Create an account with your desired role
3. Explore the dashboard tailored to your user type
4. Start booking appointments or managing services

## 🎨 Design System

### Color Palette

```css
:root {
  /* Brand Colors */
  --primary: 0, 150, 136; /* Medical Teal */
  --primary-light: 178, 223, 219; /* Light Teal */
  --primary-dark: 0, 105, 92; /* Dark Teal */

  /* Semantic Colors */
  --success: 34, 197, 94; /* Green */
  --danger: 239, 68, 68; /* Red */
  --warning: 249, 115, 22; /* Orange */
  --info: 59, 130, 246; /* Blue */

  /* Neutral Palette */
  --neutral-50: 249, 250, 251; /* Lightest */
  --neutral-900: 17, 24, 39; /* Darkest */
}
```

### Typography

- **Headings**: System UI stack for optimal readability
- **Body**: Inter, system-ui, sans-serif
- **Code**: 'Fira Code', monospace

### Components

- **Cards**: Elevated design with subtle shadows
- **Buttons**: Three variants (primary, secondary, ghost)
- **Forms**: Accessible with proper labels and validation
- **Tables**: Responsive with horizontal scroll on mobile
- **Modals**: Accessible overlays with focus management

### Responsive Breakpoints

```css
/* Mobile First Approach */
@media (min-width: 640px) {
  /* Tablet */
}
@media (min-width: 1024px) {
  /* Desktop */
}
@media (min-width: 1280px) {
  /* Wide */
}
```

## 🔒 Security

### Implementation

- **Input Validation**: Client and server-side validation
- **SQL Injection Prevention**: Prepared statements
- **XSS Protection**: Output encoding and CSP headers
- **CSRF Protection**: Token-based form submissions
- **Session Security**: Secure session handling

### Best Practices

- Regular security audits
- Dependency updates
- Secure password hashing (bcrypt)
- HTTPS enforcement in production

## 🤝 Contributing

We welcome contributions from the community! Please read our [Contributing Guidelines](CONTRIBUTING.md) before submitting a PR.

### Development Workflow

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Code Style

- Follow PSR-12 for PHP code
- Use ESLint configuration for JavaScript
- Maintain consistent indentation (2 spaces)
- Write meaningful commit messages

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

<div align="center">
  <p>Built with ❤️ by the MediConnect Team</p>
  <p>
    <a href="https://github.com/OmarNajjar-Dev/MediConnect">GitHub</a> •
    <a href="#contributing">Contribute</a> •
    <a href="#license">License</a>
  </p>
</div>
