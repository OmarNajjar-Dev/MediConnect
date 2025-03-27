# MediConnect - Healthcare Platform

## Overview
MediConnect is a healthcare platform designed to connect patients with medical professionals, hospitals, pharmacies, and emergency services. The platform focuses on external interactions to serve patients efficiently without interfering with internal hospital management.

## Actors & Roles
### 1. **Patients**
   - Book appointments with doctors.
   - Request dietary plans from nurses.
   - Rate hospitals and doctors.
   - Receive medical reports and prescriptions.
   - Request emergency services (specific to COVID-19 cases).

### 2. **Doctors**
   - Provide medical consultations.
   - Issue medical reports and prescriptions.
   - Approve or deny appointment requests.
   - Refer patients to nurses for dietary plans.

### 3. **Nurses**
   - Assist doctors in medical care.
   - Provide dietary plans based on doctor's reports.
   - Communicate with patients regarding their nutritional needs.

### 4. **Hospitals**
   - Display available beds.
   - Provide details about available emergency services.
   - Report doctor availability.
   - Allow patients to rate their services.

### 5. **Secretaries**
   - Manage doctors' appointments.
   - Handle scheduling and cancellations (with notifications to patients).
   - Work with multiple doctors when necessary.

### 6. **Pharmacies**
   - Display available medications.
   - Process prescription-based medicine requests.
   - Allow direct purchase of basic over-the-counter drugs (e.g., Panadol).

### 7. **Pharmacists**
   - Dispense prescription medications.
   - Provide medication guidance to patients.
   - Verify prescriptions before processing orders.

### 8. **Emergency Medical Team (Ambulance Services)**
   - Respond to COVID-19 emergency cases.
   - Update emergency request statuses.
   - Share live location for tracking emergency response times.

## Features
### **Appointments & Scheduling**
- Patients can book doctor appointments.
- Secretaries handle scheduling based on doctor availability.
- Patients receive notifications for any appointment changes.

### **Medical Reports & Dietary Plans**
- Doctors issue reports for medications and dietary plans.
- Nurses provide dietary plans based on doctor-issued reports.

### **Hospital & Doctor Ratings**
- Patients can rate hospitals.
- Supervisors or authorized personnel can rate doctors.
- Ratings are public for transparency.

### **Pharmacy & Medication Management**
- Patients can order medications.
- Prescription-based drugs require a doctor's report.
- Basic medications are available without a prescription.
- Pharmacists verify and dispense prescription medications.

### **Emergency Services**
- Patients can request emergency services (limited to COVID-19 cases).
- Ambulance teams update case status and location tracking.

## Notes
- The platform does not handle financial transactions.
- The system is focused on external interactions only (no internal hospital management features).

# MediConnect Database Schema

## 📌 1️⃣ Users & Roles  

### **1. users**  
📌 Stores general user information  
**Primary Key:** `user_id`  

| Attribute       | Type                          | Constraints                     |
|-----------------|-------------------------------|---------------------------------|
| user_id         | SERIAL                        | PRIMARY KEY                     |
| full_name       | VARCHAR(255)                  | NOT NULL                        |
| email           | VARCHAR(255)                  | UNIQUE, NOT NULL                |
| phone           | VARCHAR(20)                   | UNIQUE, NOT NULL                |
| password_hash   | TEXT                          | NOT NULL                        |
| role            | ENUM('patient','doctor','nurse','secretary','pharmacist','ambulance') | NOT NULL |
| created_at      | TIMESTAMP                     | DEFAULT CURRENT_TIMESTAMP       |

---

### **2. patients**  
📌 Stores patient-specific details  
**Primary Key:** `patient_id`  

| Attribute      | Type        | Constraints                     |
|---------------|-------------|---------------------------------|
| patient_id    | INT         | PRIMARY KEY, REFERENCES users(user_id) |
| date_of_birth | DATE        | NOT NULL                        |
| gender        | ENUM('male','female','other') | NOT NULL         |
| address       | TEXT        | NOT NULL                        |

---

### **3. doctors**  
📌 Stores doctor details  
**Primary Key:** `doctor_id`  

| Attribute       | Type         | Constraints                     |
|----------------|--------------|---------------------------------|
| doctor_id      | INT          | PRIMARY KEY, REFERENCES users(user_id) |
| specialization | VARCHAR(255) | NOT NULL                        |
| hospital_id    | INT          | REFERENCES hospitals(hospital_id) |

---

### **4. nurses**  
📌 Stores nurse details  
**Primary Key:** `nurse_id`  

| Attribute    | Type         | Constraints                     |
|-------------|--------------|---------------------------------|
| nurse_id    | INT          | PRIMARY KEY, REFERENCES users(user_id) |
| hospital_id | INT          | REFERENCES hospitals(hospital_id) |

---

### **5. secretaries**  
📌 Stores secretary details  
**Primary Key:** `secretary_id`  

| Attribute      | Type         | Constraints                     |
|---------------|--------------|---------------------------------|
| secretary_id  | INT          | PRIMARY KEY, REFERENCES users(user_id) |

---

### **6. pharmacists**  
📌 Stores pharmacist details  
**Primary Key:** `pharmacist_id`  

| Attribute       | Type         | Constraints                     |
|----------------|--------------|---------------------------------|
| pharmacist_id  | INT          | PRIMARY KEY, REFERENCES users(user_id) |
| pharmacy_id    | INT          | REFERENCES pharmacies(pharmacy_id) |

---

## 📌 2️⃣ Medical Services  

### **7. hospitals**  
📌 Stores hospital details  
**Primary Key:** `hospital_id`  

| Attribute                     | Type        | Constraints                     |
|-------------------------------|-------------|---------------------------------|
| hospital_id                   | SERIAL      | PRIMARY KEY                     |
| name                          | VARCHAR(255)| NOT NULL                        |
| location                      | TEXT        | NOT NULL                        |
| available_beds                | INT         | DEFAULT 0                       |
| emergency_services_available  | BOOLEAN     | DEFAULT FALSE                   |

---

### **8. hospital_ratings**  
📌 Stores hospital ratings  
**Primary Key:** `rating_id`  

| Attribute     | Type         | Constraints                     |
|--------------|--------------|---------------------------------|
| rating_id    | SERIAL       | PRIMARY KEY                     |
| patient_id   | INT          | REFERENCES patients(patient_id) |
| hospital_id  | INT          | REFERENCES hospitals(hospital_id) |
| rating       | INT          | CHECK (1-5)                     |
| review       | TEXT         |                                 |
| created_at   | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP       |

---

### **9. doctor_ratings**  
📌 Stores doctor ratings  
**Primary Key:** `rating_id`  

| Attribute     | Type         | Constraints                     |
|--------------|--------------|---------------------------------|
| rating_id    | SERIAL       | PRIMARY KEY                     |
| patient_id   | INT          | REFERENCES patients(patient_id) |
| doctor_id    | INT          | REFERENCES doctors(doctor_id)   |
| rating       | INT          | CHECK (1-5)                     |
| review       | TEXT         |                                 |
| created_at   | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP       |

---

### **10. appointments**  
📌 Stores medical appointments  
**Primary Key:** `appointment_id`  

| Attribute       | Type         | Constraints                     |
|----------------|--------------|---------------------------------|
| appointment_id | SERIAL       | PRIMARY KEY                     |
| patient_id     | INT          | REFERENCES patients(patient_id) |
| doctor_id      | INT          | REFERENCES doctors(doctor_id)   |
| secretary_id   | INT          | REFERENCES secretaries(secretary_id) |
| status         | ENUM('pending','approved','canceled','completed') | DEFAULT 'pending' |
| scheduled_time | TIMESTAMP    | NOT NULL                        |
| created_at     | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP       |

---

### **11. medical_reports**  
📌 Stores medical reports  
**Primary Key:** `report_id`  

| Attribute     | Type         | Constraints                     |
|--------------|--------------|---------------------------------|
| report_id    | SERIAL       | PRIMARY KEY                     |
| patient_id   | INT          | REFERENCES patients(patient_id) |
| doctor_id    | INT          | REFERENCES doctors(doctor_id)   |
| content      | TEXT         | NOT NULL                        |
| created_at   | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP       |

---

### **12. dietary_plans**  
📌 Stores dietary plans  
**Primary Key:** `plan_id`  

| Attribute     | Type         | Constraints                     |
|--------------|--------------|---------------------------------|
| plan_id      | SERIAL       | PRIMARY KEY                     |
| patient_id   | INT          | REFERENCES patients(patient_id) |
| doctor_id    | INT          | REFERENCES doctors(doctor_id)   |
| nurse_id     | INT          | REFERENCES nurses(nurse_id)     |
| details      | TEXT         | NOT NULL                        |
| created_at   | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP       |

---

## 📌 3️⃣ Pharmacy Management  

### **13. pharmacies**  
📌 Stores pharmacy details  
**Primary Key:** `pharmacy_id`  

| Attribute     | Type         | Constraints                     |
|--------------|--------------|---------------------------------|
| pharmacy_id  | SERIAL       | PRIMARY KEY                     |
| name         | VARCHAR(255) | NOT NULL                        |
| location     | TEXT         | NOT NULL                        |

---

### **14. pharmacy_ratings**  
📌 Stores pharmacy ratings  
**Primary Key:** `rating_id`  

| Attribute     | Type         | Constraints                     |
|--------------|--------------|---------------------------------|
| rating_id    | SERIAL       | PRIMARY KEY                     |
| patient_id   | INT          | REFERENCES patients(patient_id) |
| pharmacy_id  | INT          | REFERENCES pharmacies(pharmacy_id) |
| rating       | INT          | CHECK (1-5)                     |
| review       | TEXT         |                                 |
| created_at   | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP       |

---

### **15. medications**  
📌 Stores medication details  
**Primary Key:** `medication_id`  

| Attribute            | Type         | Constraints                     |
|----------------------|--------------|---------------------------------|
| medication_id        | SERIAL       | PRIMARY KEY                     |
| name                 | VARCHAR(255) | NOT NULL                        |
| requires_prescription| BOOLEAN      | DEFAULT TRUE                    |
| available_quantity   | INT          | DEFAULT 0                       |

---

### **16. pharmacy_medications**  
📌 Stores pharmacy inventory  
**Primary Key:** `(pharmacy_id, medication_id)`  

| Attribute       | Type         | Constraints                     |
|----------------|--------------|---------------------------------|
| pharmacy_id    | INT          | REFERENCES pharmacies(pharmacy_id) |
| medication_id  | INT          | REFERENCES medications(medication_id) |
| stock_quantity | INT          | DEFAULT 0                       |

---

### **17. prescriptions**  
📌 Stores medication prescriptions  
**Primary Key:** `prescription_id`  

| Attribute       | Type         | Constraints                     |
|----------------|--------------|---------------------------------|
| prescription_id| SERIAL       | PRIMARY KEY                     |
| patient_id     | INT          | REFERENCES patients(patient_id) |
| doctor_id      | INT          | REFERENCES doctors(doctor_id)   |
| medication_id  | INT          | REFERENCES medications(medication_id) |
| pharmacy_id    | INT          | REFERENCES pharmacies(pharmacy_id) |
| status         | ENUM('pending','approved','denied','dispensed') | DEFAULT 'pending' |
| created_at     | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP       |

---

## 📌 4️⃣ Emergency Services  

### **18. emergency_requests**  
📌 Stores emergency requests  
**Primary Key:** `request_id`  

| Attribute         | Type         | Constraints                     |
|------------------|--------------|---------------------------------|
| request_id       | SERIAL       | PRIMARY KEY                     |
| patient_id       | INT          | REFERENCES patients(patient_id) |
| ambulance_team_id| INT          | REFERENCES users(user_id)       |
| status           | ENUM('requested','on_the_way','arrived','completed') | DEFAULT 'requested' |
| live_location    | TEXT         |                                 |
| created_at       | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP       |

---

### **19. ambulance_tracking**  
📌 Stores ambulance locations  
**Primary Key:** `tracking_id`  

| Attribute         | Type         | Constraints                     |
|------------------|--------------|---------------------------------|
| tracking_id      | SERIAL       | PRIMARY KEY                     |
| ambulance_team_id| INT          | REFERENCES users(user_id)       |
| current_location | TEXT         | NOT NULL                        |
| status           | ENUM('available','on_mission') | DEFAULT 'available' |
| updated_at       | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP       |

---

## 📌 5️⃣ Communications  

### **20. notifications**  
📌 Stores user notifications  
**Primary Key:** `notification_id`  

| Attribute        | Type         | Constraints                     |
|-----------------|--------------|---------------------------------|
| notification_id | SERIAL       | PRIMARY KEY                     |
| user_id         | INT          | REFERENCES users(user_id)       |
| message         | TEXT         | NOT NULL                        |
| status          | ENUM('unread','read') | DEFAULT 'unread'       |
| created_at      | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP       |

---

### **21. messages**  
📌 Stores user messages  
**Primary Key:** `message_id`  

| Attribute     | Type         | Constraints                     |
|--------------|--------------|---------------------------------|
| message_id   | SERIAL       | PRIMARY KEY                     |
| sender_id    | INT          | REFERENCES users(user_id)       |
| receiver_id  | INT          | REFERENCES users(user_id)       |
| content      | TEXT         | NOT NULL                        |
| created_at   | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP       |
