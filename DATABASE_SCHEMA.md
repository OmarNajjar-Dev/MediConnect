## 🗃️ MediConnect Database Schema (Normalized, Complete)

This schema incorporates all required tables, including confirmed ones and additional tables recommended by analysis (fully normalized to 3NF / BCNF).

---

### 🔐 `users`
- user_id (PK)
- email (UNIQUE)
- password_hash
- first_name
- last_name
- phone_number
- date_of_birth
- gender
- address_line1
- address_line2 (NULLABLE)
- city
- state
- postal_code
- country
- is_active (BOOLEAN)
- email_verified_at (DATETIME, NULLABLE)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)

---

### 🧾 `roles`
- role_id (PK)
- role_name (UNIQUE)
- description (NULLABLE)
- created_at (TIMESTAMP)

### 🔁 `user_roles`
- user_role_id (PK)
- user_id (FK → users.user_id)
- role_id (FK → roles.role_id)
- assigned_at (TIMESTAMP)
- assigned_by (FK → users.user_id)

### 🔐 `permissions`
- permission_id (PK)
- resource_name
- action_name
- description

### 🔁 `role_permissions`
- role_permission_id (PK)
- role_id (FK → roles.role_id)
- permission_id (FK → permissions.permission_id)

---

### 🩺 `specialties`
- specialty_id (PK)
- name (UNIQUE)
- description

### 👨‍⚕️ `doctors`
- doctor_id (PK)
- user_id (FK → users.user_id)
- license_number
- specialty_id (FK → specialties.specialty_id)
- years_experience
- consultation_fee
- bio
- is_verified (BOOLEAN)
- verification_date (DATETIME)

### 🎓 `doctor_qualifications`
- qualification_id (PK)
- doctor_id (FK → doctors.doctor_id)
- degree_name
- institution
- year_completed

### 👩‍⚕️ `nurses`
- nurse_id (PK)
- user_id (FK → users.user_id)
- license_number
- department
- is_verified (BOOLEAN)

### 🧑‍🔬 `pharmacists`
- pharmacist_id (PK)
- user_id (FK → users.user_id)
- license_number
- pharmacy_id (FK → pharmacies.pharmacy_id)
- is_verified (BOOLEAN)

### 🧑‍💼 `staff`
- staff_id (PK)
- user_id (FK → users.user_id)
- department
- position

### 🚑 `ambulance_teams`
- team_id (PK)
- user_id (FK → users.user_id)
- vehicle_id
- is_available (BOOLEAN)
- current_latitude
- current_longitude
- last_location_update

---

### 🏥 `hospitals`
- hospital_id (PK)
- name
- address_line1
- address_line2
- city
- state
- postal_code
- country
- phone_number
- email
- website
- emergency_contact
- total_beds
- available_beds
- is_verified (BOOLEAN)
- created_at (TIMESTAMP)

### 🧪 `hospital_departments`
- department_id (PK)
- hospital_id (FK → hospitals.hospital_id)
- name
- head_doctor_id (FK → doctors.doctor_id)

### 🧑‍⚕️ `hospital_doctors`
- hospital_doctor_id (PK)
- hospital_id (FK → hospitals.hospital_id)
- doctor_id (FK → doctors.doctor_id)
- department_id (FK → hospital_departments.department_id)
- start_date
- end_date
- is_active (BOOLEAN)

### 🏪 `pharmacies`
- pharmacy_id (PK)
- name
- address_line1
- address_line2
- city
- state
- postal_code
- country
- phone_number
- email
- license_number
- operating_hours
- is_24_hours (BOOLEAN)
- is_verified (BOOLEAN)

---

### 🧑‍🤝‍🧑 `patients`
- patient_id (PK)
- user_id (FK → users.user_id)
- emergency_contact_name
- emergency_contact_phone
- blood_type
- allergies
- medical_history

### 📁 `patient_medical_records`
- record_id (PK)
- patient_id (FK → patients.patient_id)
- doctor_id (FK → doctors.doctor_id)
- visit_date
- diagnosis
- treatment
- notes
- created_at (TIMESTAMP)

### 🥗 `dietary_plans`
- plan_id (PK)
- patient_id (FK → patients.patient_id)
- nurse_id (FK → nurses.nurse_id)
- plan_details
- start_date
- end_date
- created_at (TIMESTAMP)

---

### 📅 `appointment_statuses`
- status_id (PK)
- status_name
- description

### 📆 `appointments`
- appointment_id (PK)
- patient_id (FK → patients.patient_id)
- doctor_id (FK → doctors.doctor_id)
- hospital_id (FK → hospitals.hospital_id)
- appointment_date
- appointment_time
- status_id (FK → appointment_statuses.status_id)
- appointment_type (e.g., 'in-person', 'virtual')
- reason
- notes
- cancellation_reason (NULLABLE)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)

### 🔁 `appointment_history`
- history_id (PK)
- appointment_id (FK → appointments.appointment_id)
- status_id (FK → appointment_statuses.status_id)
- changed_by (FK → users.user_id)
- changed_at (TIMESTAMP)
- notes

---

### 🚨 `emergency_types`
- type_id (PK)
- type_name
- description
- priority_level

### 🆘 `emergency_requests`
- request_id (PK)
- patient_id (FK → patients.patient_id)
- emergency_type_id (FK → emergency_types.type_id)
- location_latitude
- location_longitude
- address
- description
- status
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)

### 🚑 `emergency_responses`
- response_id (PK)
- request_id (FK → emergency_requests.request_id)
- team_id (FK → ambulance_teams.team_id)
- hospital_id (FK → hospitals.hospital_id)
- response_time
- arrival_time
- completion_time
- notes

---

### 💊 `medications`
- medication_id (PK)
- name
- generic_name
- dosage_form
- strength
- category
- manufacturer
- description

### 📝 `prescriptions`
- prescription_id (PK)
- patient_id (FK → patients.patient_id)
- doctor_id (FK → doctors.doctor_id)
- prescription_date
- status
- notes
- created_at (TIMESTAMP)
- verification_status

### 💊 `prescription_items`
- item_id (PK)
- prescription_id (FK → prescriptions.prescription_id)
- medication_id (FK → medications.medication_id)
- dosage
- frequency
- duration
- quantity
- instructions

### 🛒 `pharmacy_orders`
- order_id (PK)
- patient_id (FK → patients.patient_id)
- pharmacy_id (FK → pharmacies.pharmacy_id)
- prescription_id (FK → prescriptions.prescription_id)
- order_date
- delivery_address
- delivery_method
- status
- total_amount
- created_at (TIMESTAMP)

### 📦 `pharmacy_order_items`
- order_item_id (PK)
- order_id (FK → pharmacy_orders.order_id)
- medication_id (FK → medications.medication_id)
- quantity
- unit_price
- total_price

---

### ⭐ `rating_categories`
- category_id (PK)
- category_name
- description

### 🌟 `ratings`
- rating_id (PK)
- patient_id (FK → patients.patient_id)
- entity_type (ENUM: 'doctor', 'hospital', 'pharmacy')
- entity_id
- category_id (FK → rating_categories.category_id)
- rating_value
- review_text
- created_at (TIMESTAMP)
- is_verified (BOOLEAN)

---

### 🛡️ `audit_logs`
- log_id (PK)
- user_id (FK → users.user_id)
- action
- table_name
- record_id
- old_values (JSON)
- new_values (JSON)
- timestamp

### ⚙️ `system_settings`
- setting_id (PK)
- setting_key
- setting_value
- description
- updated_by (FK → users.user_id)
- updated_at (TIMESTAMP)

### 🔔 `notifications`
- notification_id (PK)
- user_id (FK → users.user_id)
- message
- type (ENUM)
- status (read/unread)
- created_at (TIMESTAMP)

### 🌍 `languages`
- language_code (PK)
- language_name

### 🌐 `user_preferences`
- preference_id (PK)
- user_id (FK → users.user_id)
- language_code (FK → languages.language_code)
- receive_notifications (BOOLEAN)
- dark_mode_enabled (BOOLEAN)
