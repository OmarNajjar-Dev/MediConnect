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

# MediConnect Database Schema (MLDR Format)

MediConnect is a healthcare platform designed to connect patients with medical professionals, hospitals, pharmacies, and emergency services. Below is the **MLDR (Merise Logical Data Model)** representation of the database structure.

---

## 📌 1️⃣ Users & Roles  

### **users**  
📌 Stores general user information  
**Primary Key:** `user_id`  

| Attribute       | Type                          | Constraints                     |
|---------------|-----------------------------|--------------------------------|
| user_id       | SERIAL (PK)                  | Auto-incremented primary key  |
| full_name     | VARCHAR(255)                  | NOT NULL                       |
| email         | VARCHAR(255)                  | UNIQUE, NOT NULL               |
| phone         | VARCHAR(20)                   | UNIQUE, NOT NULL               |
| password_hash | TEXT                          | NOT NULL                       |
| role          | ENUM('patient', 'doctor', 'nurse', 'secretary', 'pharmacist', 'ambulance') | NOT NULL |
| created_at    | TIMESTAMP                     | DEFAULT CURRENT_TIMESTAMP      |

---

### **patients**  
📌 Stores patient-specific details  
**Primary Key:** `patient_id`  
**Foreign Key:** `patient_id → users.user_id`  

| Attribute      | Type        | Constraints    |
|--------------|-----------|--------------|
| patient_id   | INT (PK, FK)  | REFERENCES users(user_id) |
| date_of_birth | DATE       | NOT NULL     |
| gender       | ENUM('male', 'female', 'other') | NOT NULL |
| address      | TEXT       | NOT NULL     |

---

### **doctors**  
📌 Stores doctor details and their hospital association  
**Primary Key:** `doctor_id`  
**Foreign Key:** `doctor_id → users.user_id`, `hospital_id → hospitals.hospital_id`  

| Attribute     | Type         | Constraints    |
|-------------|------------|--------------|
| doctor_id   | INT (PK, FK)  | REFERENCES users(user_id) |
| specialization | VARCHAR(255) | NOT NULL |
| hospital_id | INT (FK)  | REFERENCES hospitals(hospital_id) |

---

### **nurses**  
📌 Stores nurse details and their hospital association  
**Primary Key:** `nurse_id`  
**Foreign Key:** `nurse_id → users.user_id`, `hospital_id → hospitals.hospital_id`  

| Attribute    | Type         | Constraints    |
|------------|------------|--------------|
| nurse_id   | INT (PK, FK)  | REFERENCES users(user_id) |
| hospital_id | INT (FK)  | REFERENCES hospitals.hospital_id |

---

### **secretaries**  
📌 Stores secretaries who manage doctor appointments  
**Primary Key:** `secretary_id`  
**Foreign Key:** `secretary_id → users.user_id`  

| Attribute     | Type         | Constraints    |
|-------------|------------|--------------|
| secretary_id | INT (PK, FK)  | REFERENCES users(user_id) |

---

### **pharmacists**  
📌 Stores pharmacists who verify and dispense medications  
**Primary Key:** `pharmacist_id`  
**Foreign Key:** `pharmacist_id → users.user_id`, `pharmacy_id → pharmacies.pharmacy_id`  

| Attribute     | Type         | Constraints    |
|-------------|------------|--------------|
| pharmacist_id | INT (PK, FK)  | REFERENCES users(user_id) |
| pharmacy_id  | INT (FK)  | REFERENCES pharmacies(pharmacy_id) |

---

## 📌 2️⃣ Medical Services  

### **hospitals**  
📌 Stores hospital details  
**Primary Key:** `hospital_id`  

| Attribute      | Type        | Constraints    |
|--------------|-----------|--------------|
| hospital_id  | SERIAL (PK) | Auto-incremented primary key |
| name         | VARCHAR(255) | NOT NULL |
| location     | TEXT         | NOT NULL |
| available_beds | INT       | DEFAULT 0 |
| emergency_services_available | BOOLEAN | DEFAULT FALSE |

---

### **hospital_ratings**  
📌 Stores hospital ratings by patients  
**Primary Key:** `rating_id`  
**Foreign Key:** `patient_id → patients.patient_id`, `hospital_id → hospitals.hospital_id`  

| Attribute     | Type         | Constraints    |
|-------------|------------|--------------|
| rating_id   | SERIAL (PK) | Auto-incremented primary key |
| patient_id  | INT (FK)  | REFERENCES patients(patient_id) |
| hospital_id | INT (FK)  | REFERENCES hospitals(hospital_id) |
| rating      | INT        | CHECK (rating BETWEEN 1 AND 5) |
| review      | TEXT       | NULLABLE |
| created_at  | TIMESTAMP  | DEFAULT CURRENT_TIMESTAMP |

---

### **doctor_ratings**  
📌 Stores doctor ratings by patients  
**Primary Key:** `rating_id`  
**Foreign Key:** `patient_id → patients.patient_id`, `doctor_id → doctors.doctor_id`  

| Attribute     | Type         | Constraints    |
|-------------|------------|--------------|
| rating_id   | SERIAL (PK) | Auto-incremented primary key |
| patient_id  | INT (FK)  | REFERENCES patients(patient_id) |
| doctor_id   | INT (FK)  | REFERENCES doctors(doctor_id) |
| rating      | INT        | CHECK (rating BETWEEN 1 AND 5) |
| review      | TEXT       | NULLABLE |
| created_at  | TIMESTAMP  | DEFAULT CURRENT_TIMESTAMP |

---

### **appointments**  
📌 Stores doctor appointment details  
**Primary Key:** `appointment_id`  
**Foreign Key:** `patient_id → patients.patient_id`, `doctor_id → doctors.doctor_id`, `secretary_id → secretaries.secretary_id`  

| Attribute      | Type         | Constraints    |
|--------------|------------|--------------|
| appointment_id | SERIAL (PK) | Auto-incremented primary key |
| patient_id    | INT (FK)  | REFERENCES patients(patient_id) |
| doctor_id     | INT (FK)  | REFERENCES doctors(doctor_id) |
| secretary_id  | INT (FK)  | NULLABLE, REFERENCES secretaries(secretary_id) |
| status        | ENUM('pending', 'approved', 'canceled', 'completed') | DEFAULT 'pending' |
| scheduled_time | TIMESTAMP  | NOT NULL |
| created_at    | TIMESTAMP  | DEFAULT CURRENT_TIMESTAMP |

---

## 📌 3️⃣ Pharmacy Management  

### **pharmacies**  
📌 Stores pharmacy details  
**Primary Key:** `pharmacy_id`  

| Attribute     | Type        | Constraints    |
|-------------|-----------|--------------|
| pharmacy_id | SERIAL (PK) | Auto-incremented primary key |
| name        | VARCHAR(255) | NOT NULL |
| location    | TEXT         | NOT NULL |

---

### **pharmacy_ratings**  
📌 Stores pharmacy ratings by patients  
**Primary Key:** `rating_id`  
**Foreign Key:** `patient_id → patients.patient_id`, `pharmacy_id → pharmacies.pharmacy_id`  

| Attribute     | Type         | Constraints    |
|-------------|------------|--------------|
| rating_id   | SERIAL (PK) | Auto-incremented primary key |
| patient_id  | INT (FK)  | REFERENCES patients(patient_id) |
| pharmacy_id | INT (FK)  | REFERENCES pharmacies(pharmacy_id) |
| rating      | INT        | CHECK (rating BETWEEN 1 AND 5) |
| review      | TEXT       | NULLABLE |
| created_at  | TIMESTAMP  | DEFAULT CURRENT_TIMESTAMP |

---
