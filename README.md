# Healthcare Services System – MediConnect / HealthBridge / MediLink

This project is a comprehensive healthcare services system designed to connect patients with various healthcare providers such as doctors, hospitals, pharmacies, emergency services, blood donation centers, and insurance verification. The system caters to different user roles and provides multiple user-facing services, all underpinned by a robust MySQL database design.

---

## 1. Actors

### Patients

- **Who are they?**  
  Individuals seeking medical assistance, information about nearby hospitals, appointment bookings, emergency services, etc.
- **Responsibilities/Actions:**
  - Register and manage their profiles.
  - Book appointments with doctors.
  - Request emergency help (ambulance).
  - Search for nearby hospitals and clinics.
  - Schedule blood donation appointments.
  - Browse pharmacy services and order prescriptions.
  - Read reviews and ratings for hospitals and doctors.

### Doctors

- **Who are they?**  
  Medical professionals who provide consultations, diagnoses, and treatments.
- **Responsibilities/Actions:**
  - Manage appointments and teleconsultations.
  - Update and access patient medical records.
  - Prescribe medications.
  - Collaborate with other healthcare providers.

### Nurses

- **Who are they?**  
  Support staff assisting in patient care and following up on treatment plans.
- **Responsibilities/Actions:**
  - Monitor patient health.
  - Assist in managing appointments and emergencies.
  - Provide follow-up care.

### Pharmacists

- **Who are they?**  
  Experts responsible for dispensing prescriptions and providing pharmacy services.
- **Responsibilities/Actions:**
  - Verify and dispense prescriptions.
  - Manage pharmacy inventory.
  - Advise patients on medication usage.

### Ambulance Drivers

- **Who are they?**  
  Personnel responsible for the emergency transportation of patients.
- **Responsibilities/Actions:**
  - Respond to emergency requests.
  - Provide real-time location updates.
  - Ensure the ambulance is equipped with necessary supplies.

### Insurance Agents

- **Who are they?**  
  Representatives who manage and verify insurance details for patients.
- **Responsibilities/Actions:**
  - Validate patient insurance coverage.
  - Process claims related to medical services.
  - Provide guidance on insurance policies.

### System Administrators

- **Who are they?**  
  IT professionals who manage and maintain the website/platform.
- **Responsibilities/Actions:**
  - Manage user accounts and roles.
  - Ensure system security and performance.
  - Perform system updates and monitor logs.

### Blood Donors

- **Who are they?**  
  Individuals who register to donate blood. They might also be patients but are considered a distinct actor for blood donation services.
- **Responsibilities/Actions:**
  - Register as a donor.
  - Schedule donation appointments.
  - Check eligibility and receive donation reminders.
  - Track donation history.

---

## 2. User-Facing Services

The website offers a range of external services for users, including:

- **Hospital & Clinic Search:**  
  Search for nearby hospitals/clinics, view details such as location, available beds, emergency services, and ratings.
- **Doctor & Specialist Lookup:**  
  Access profiles of doctors, including their specialties, experience, and ratings.
- **Appointment Booking:**  
  Schedule, cancel, or reschedule appointments with doctors online.
- **Emergency Request:**  
  Request an ambulance or emergency assistance along with current location details.
- **Blood Donation Services:**  
  Find information on blood donation centers, check eligibility, schedule donation appointments, and track donation history.
- **Pharmacy Services:**  
  Locate partnered pharmacies, view prescription details, order medications online, and check pharmacy ratings/hours.
- **Insurance Verification:**  
  Verify insurance coverage, process claims, and view insurance details if applicable.
- **Reviews & Ratings:**  
  Read and post reviews for hospitals, doctors, and other healthcare services.
- **Notifications:**  
  Receive alerts and updates regarding appointments, emergencies, or new offers/services.
- **Telemedicine:**  
  Access online consultations for non-emergency cases.

---

## 3. MySQL Tables (MLDR Format)

The system's database is structured with the following main tables. In each table, the primary key is denoted by an underline, and foreign keys are prefixed with `#`.

### 3.1 Users

```sql
Users (
    _user_id_,
    full_name,
    email,
    password,
    phone_number,
    role,            -- e.g., patient, doctor, pharmacist, etc.
    date_of_birth,
    gender,
    address
)
```

### 3.2 Patients

```sql
Patients (
    _patient_id_,
    #user_id,          -- References Users.user_id
    blood_type,
    medical_history,
    allergies,
    chronic_conditions,
    emergency_contact,
    #insurance_id      -- References Insurance.insurance_id
)
```

### 3.3 Doctors

```sql
Doctors (
    _doctor_id_,
    #user_id,          -- References Users.user_id
    specialization,
    license_number,
    years_of_experience,
    #hospital_id       -- References Hospitals.hospital_id
)
```

### 3.4 Hospitals

```sql
Hospitals (
    _hospital_id_,
    name,
    location,
    phone_number,
    available_beds,
    emergency_services,   -- Description of emergency services available
    rating                -- Average rating from user reviews
)
```

### 3.5 Appointments

```sql
Appointments (
    _appointment_id_,
    #patient_id,       -- References Patients.patient_id
    #doctor_id,        -- References Doctors.doctor_id
    appointment_date,
    status,            -- e.g., scheduled, canceled, completed
    notes
)
```

### 3.6 Reviews

```sql
Reviews (
    _review_id_,
    #user_id,          -- References Users.user_id (the reviewer)
    target_type,       -- 'hospital' or 'doctor'
    target_id,         -- ID of the hospital or doctor being reviewed
    review_text,
    rating,            -- Numeric rating (e.g., 1-5)
    review_date
)
```

### 3.7 Emergency Requests

```sql
Emergency_Requests (
    _request_id_,
    #patient_id,       -- References Patients.patient_id
    request_time,
    location,          -- Patient's current location
    description,
    status             -- e.g., pending, dispatched, resolved
)
```

### 3.8 Notifications

```sql
Notifications (
    _notification_id_,
    #user_id,          -- References Users.user_id
    message,
    sent_date,
    is_read            -- Boolean: 0 (unread) / 1 (read)
)
```

### 3.9 Hospital Services

```sql
Hospital_Services (
    _service_id_,
    #hospital_id,      -- References Hospitals.hospital_id
    service_name,      -- e.g., "Pharmacy", "Blood Donation"
    description,
    availability       -- e.g., operating hours or current status
)
```

### 3.10 Pharmacies

```sql
Pharmacies (
    _pharmacy_id_,
    name,
    location,
    phone_number,
    opening_hours,     -- e.g., "08:00-20:00"
    rating             -- Average rating from user feedback
)
```

### 3.11 Pharmacists

```sql
Pharmacists (
    _pharmacist_id_,
    #user_id,          -- References Users.user_id
    license_number,
    years_of_experience,
    #pharmacy_id       -- References Pharmacies.pharmacy_id
)
```

### 3.12 Blood Donations

```sql
Blood_Donations (
    _donation_id_,
    #patient_id,       -- References Patients.patient_id (the donor)
    donation_date,
    donation_center,   -- Name or identifier for the donation center
    status             -- e.g., "Scheduled", "Completed"
)
```

### 3.13 Insurance

```sql
Insurance (
    _insurance_id_,
    company_name,
    coverage_details,
    policy_number,
    expiration_date
)
```

### 3.14 Questions & Answers

```sql
QST_Answers (
    _qst_id_,        -- Unique identifier for each Q&A entry
    question_text,     -- The question text
    answer_text,       -- The corresponding answer text
    category,          -- (Optional) e.g., Appointments, Emergency, Blood Donation, etc.
    created_at         -- Timestamp when the entry was created
)
```

### 3.15 Ambulances

```sql
Ambulances (
    _ambulance_id_,
    #hospital_id,      -- References Hospitals.hospital_id (affiliated hospital)
    driver_name,       -- Name of the ambulance driver
    vehicle_number,    -- Vehicle registration number
    current_location,  -- Current GPS coordinates or location description
    status,            -- e.g., "Available", "Busy", "Under Maintenance"
    last_updated       -- Timestamp of the last update
)
```