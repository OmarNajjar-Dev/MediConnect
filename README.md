# MediConnect Web Platform

## Project Overview
MediConnect is an external healthcare web platform designed to connect patients with medical professionals, hospitals, pharmacies, and emergency services. The platform enhances healthcare service accessibility without interfering with internal hospital management systems.

⚠️ **Important:**  
MediConnect operates strictly as an external interface and does not include hospital administration, internal workflows, financial transactions, or sensitive medical records management.

## Key Features
- ✅ Browse verified doctors, hospitals, and pharmacies.
- ✅ Book and manage appointments.
- ✅ Access emergency services (COVID-19 focused).
- ✅ View medical reports and dietary plans.
- ✅ Rate hospitals, doctors, and pharmacies.
- ✅ Link to external Blood Bank System via a dedicated page.

## User Roles & Permissions

| Role        | Description                      | Notes                                                       |
|-------------|---------------------------------|-------------------------------------------------------------|
| Patient     | Main platform users.             | Can book appointments, view reports, rate services, and request emergencies. |
| Doctor      | Healthcare providers on the platform. | Can issue reports, prescriptions, and manage appointments.  |
| Nurse (Optional) | Provides dietary plans, under doctor supervision. | ✅ Recommended only if future scope includes clinical dietary planning. |
| Pharmacist  | Handles prescriptions and over-the-counter medication. | Verifies and dispenses medications.                         |
| Ambulance Team | Responds to emergencies (COVID-19 only). | Updates status and shares live location.                    |

⚠️ **Deprecated Role:**  
The Secretary role has been completely removed from the system.

## System Architecture Overview
MediConnect follows a service-oriented modular architecture, ensuring scalability and maintainability.

- **Web Front-End:**  
  Modern web application (desktop and mobile optimized).

- **API Integrations:**  
  External services (e.g., Blood Bank, Ambulance Tracking).

- **Data Layer:**  
  Secure relational database (PostgreSQL recommended).

- **Emergency Module:**  
  Handles emergency requests and live ambulance tracking.

✅ **Scope Limitations:**

❌ No internal hospital systems.  
❌ No financial transactions.  
❌ No medical records storage.

## Pages & Navigation Structure

### Main Pages
- Home  
- Doctors  
- Hospitals  
- Appointments  
- Emergency  
- Pharmacy  
- History  

### Footer Pages
- About Us  
- Privacy Policy  
- Terms of Service  
- FAQs  
- Contact Us  
- Blood Donation (➡️ Links externally to Blood Bank System)  

### System Page
- 404 Not Found

## Design System & UI Guidelines
- **Primary Color:** #009485 (aligned with medical themes).  
- **Icons:** All UI icons use Lucide Icons.  

**User Interface:**  
Clean, accessible, and mobile-first.  
Designed for users of all technical backgrounds.

## Security & Privacy Compliance
- ✅ Follows web security best practices.  
- ✅ Compliant with general privacy standards.  
- ✅ Provides accessible Privacy Policy and Terms of Service.  

❗ No sensitive data handling or storage.  
⚠️ Location tracking for emergencies must comply with local privacy regulations.

## Technologies & Tools Used

| Technology         | Purpose                        |
|--------------------|--------------------------------|
| HTML, CSS, JavaScript | Front-end web development     |
| Lucide Icons       | UI iconography                |
| PostgreSQL         | Relational database            |
| External APIs      | Blood Bank, Emergency services |
| Cloud Hosting      | (Provider TBD)                 |

## Contribution Guidelines (Optional)
Contributions are managed internally.  
For suggestions or inquiries, please use the Contact Us page.

## License (Optional)
To be defined.
