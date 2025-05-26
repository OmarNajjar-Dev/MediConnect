-- Core user management
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    address_line VARCHAR(255) NOT NULL,
) ENGINE = InnoDB;

CREATE TABLE roles (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(50) NOT NULL UNIQUE
) ENGINE = InnoDB;

CREATE TABLE user_roles (
    user_role_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

-- Doctors, Nurses, Pharmacists
CREATE TABLE specialties (
    specialty_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE
) ENGINE = InnoDB;

CREATE TABLE doctors (
    doctor_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    specialty_id INT,
    hospital_id INT,
    is_verified BOOLEAN DEFAULT FALSE,
    rating DECIMAL(2,1),
    reviews_count INT,
    image_url VARCHAR(255),
    bio TEXT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (specialty_id) REFERENCES specialties(specialty_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(hospital_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE nurses (
    nurse_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    is_verified BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE = InnoDB;

CREATE TABLE pharmacists (
    pharmacist_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    pharmacy_id INT NOT NULL,
    is_verified BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE = InnoDB;

-- Hospitals, Pharmacies
CREATE TABLE hospitals (
    hospital_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    contact VARCHAR(50),
    available_beds INT,
    rating DECIMAL(2,1),
    reviews_count INT,
    emergency_services BOOLEAN DEFAULT FALSE,
    image_url VARCHAR(255)
) ENGINE = InnoDB;


CREATE TABLE pharmacies (
    pharmacy_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
) ENGINE = InnoDB;

-- Patients
CREATE TABLE patients (
    patient_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE = InnoDB;

-- Appointments
CREATE TABLE appointment_statuses (
    status_id INT PRIMARY KEY AUTO_INCREMENT,
    status_name VARCHAR(50) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE appointments (
    appointment_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    hospital_id INT,
    status_id INT NOT NULL,
    appointment_date DATE,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id),
    FOREIGN KEY (hospital_id) REFERENCES hospitals(hospital_id),
    FOREIGN KEY (status_id) REFERENCES appointment_statuses(status_id)
) ENGINE = InnoDB;

-- Emergency
CREATE TABLE emergency_requests (
    request_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    status VARCHAR(50),
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
) ENGINE = InnoDB;

CREATE TABLE ambulance_teams (
    team_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE = InnoDB;

CREATE TABLE emergency_responses (
    response_id INT PRIMARY KEY AUTO_INCREMENT,
    request_id INT NOT NULL,
    team_id INT NOT NULL,
    FOREIGN KEY (request_id) REFERENCES emergency_requests(request_id),
    FOREIGN KEY (team_id) REFERENCES ambulance_teams(team_id)
) ENGINE = InnoDB;

-- Medications
CREATE TABLE medications (
    medication_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE prescriptions (
    prescription_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id)
) ENGINE = InnoDB;

CREATE TABLE prescription_items (
    item_id INT PRIMARY KEY AUTO_INCREMENT,
    prescription_id INT NOT NULL,
    medication_id INT NOT NULL,
    FOREIGN KEY (prescription_id) REFERENCES prescriptions(prescription_id),
    FOREIGN KEY (medication_id) REFERENCES medications(medication_id)
) ENGINE = InnoDB;

-- Pharmacy Orders
CREATE TABLE pharmacy_orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    pharmacy_id INT NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
    FOREIGN KEY (pharmacy_id) REFERENCES pharmacies(pharmacy_id)
) ENGINE = InnoDB;

CREATE TABLE pharmacy_order_items (
    order_item_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    medication_id INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES pharmacy_orders(order_id),
    FOREIGN KEY (medication_id) REFERENCES medications(medication_id)
) ENGINE = InnoDB;

-- Ratings
CREATE TABLE ratings (
    rating_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    rating_value INT,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
) ENGINE = InnoDB;

-- Notifications
CREATE TABLE notifications (
    notification_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    message TEXT,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE = InnoDB;

-- Hospital Management
CREATE TABLE hospital_departments (
    department_id INT PRIMARY KEY AUTO_INCREMENT,
    hospital_id INT NOT NULL,
    name VARCHAR(100),
    FOREIGN KEY (hospital_id) REFERENCES hospitals(hospital_id)
) ENGINE = InnoDB;

CREATE TABLE hospital_doctors (
    hospital_doctor_id INT PRIMARY KEY AUTO_INCREMENT,
    hospital_id INT NOT NULL,
    doctor_id INT NOT NULL,
    department_id INT,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(hospital_id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id),
    FOREIGN KEY (department_id) REFERENCES hospital_departments(department_id)
) ENGINE = InnoDB;

-- Doctor Qualifications
CREATE TABLE doctor_qualifications (
    qualification_id INT PRIMARY KEY AUTO_INCREMENT,
    doctor_id INT NOT NULL,
    degree_name VARCHAR(100),
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id)
) ENGINE = InnoDB;

-- Patient Records
CREATE TABLE patient_medical_records (
    record_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    diagnosis TEXT,
    treatment TEXT,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id)
) ENGINE = InnoDB;

CREATE TABLE dietary_plans (
    plan_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    nurse_id INT NOT NULL,
    plan_details TEXT,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
    FOREIGN KEY (nurse_id) REFERENCES nurses(nurse_id)
) ENGINE = InnoDB;

-- Appointment History
CREATE TABLE appointment_history (
    history_id INT PRIMARY KEY AUTO_INCREMENT,
    appointment_id INT NOT NULL,
    status_id INT NOT NULL,
    changed_by INT NOT NULL,
    FOREIGN KEY (appointment_id) REFERENCES appointments(appointment_id),
    FOREIGN KEY (status_id) REFERENCES appointment_statuses(status_id),
    FOREIGN KEY (changed_by) REFERENCES users(user_id)
) ENGINE = InnoDB;

-- Permissions
CREATE TABLE permissions (
    permission_id INT PRIMARY KEY AUTO_INCREMENT,
    resource_name VARCHAR(100),
    action_name VARCHAR(100)
) ENGINE = InnoDB;

CREATE TABLE role_permissions (
    role_permission_id INT PRIMARY KEY AUTO_INCREMENT,
    role_id INT NOT NULL,
    permission_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(role_id),
    FOREIGN KEY (permission_id) REFERENCES permissions(permission_id)
) ENGINE = InnoDB;

-- Audit Logs
CREATE TABLE audit_logs (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    action VARCHAR(100),
    table_name VARCHAR(100),
    record_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE = InnoDB;

-- System Settings
CREATE TABLE system_settings (
    setting_id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) NOT NULL,
    setting_value TEXT
) ENGINE = InnoDB;
