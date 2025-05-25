sql
-- Create ENUM types
CREATE TYPE entity_type_enum AS ENUM ('doctor', 'hospital', 'pharmacy');
CREATE TYPE appointment_type_enum AS ENUM ('in-person', 'virtual');
CREATE TYPE notification_type_enum AS ENUM ('appointment', 'emergency', 'prescription', 'system');
CREATE TYPE notification_status_enum AS ENUM ('read', 'unread');

-- Core user management
CREATE TABLE users (
    user_id VARCHAR(36) PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender VARCHAR(10) NOT NULL,
    address_line1 VARCHAR(255) NOT NULL,
    address_line2 VARCHAR(255),
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    country VARCHAR(100) NOT NULL,
    is_active BOOLEAN NOT NULL DEFAULT true,
    email_verified_at TIMESTAMP,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Role management
CREATE TABLE roles (
    role_id VARCHAR(36) PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_roles (
    user_role_id VARCHAR(36) PRIMARY KEY,
    user_id VARCHAR(36) NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    role_id VARCHAR(36) NOT NULL REFERENCES roles(role_id) ON DELETE CASCADE,
    assigned_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    assigned_by VARCHAR(36) NOT NULL REFERENCES users(user_id),
    UNIQUE(user_id, role_id)
);

-- Medical specialties
CREATE TABLE specialties (
    specialty_id VARCHAR(36) PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
);

-- Healthcare professionals
CREATE TABLE doctors (
    doctor_id VARCHAR(36) PRIMARY KEY,
    user_id VARCHAR(36) NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    license_number VARCHAR(50) NOT NULL UNIQUE,
    specialty_id VARCHAR(36) NOT NULL REFERENCES specialties(specialty_id),
    years_experience INTEGER NOT NULL,
    consultation_fee DECIMAL(10,2) NOT NULL,
    bio TEXT,
    is_verified BOOLEAN NOT NULL DEFAULT false,
    verification_date TIMESTAMP,
    UNIQUE(user_id)
);

-- Healthcare facilities
CREATE TABLE hospitals (
    hospital_id VARCHAR(36) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address_line1 VARCHAR(255) NOT NULL,
    address_line2 VARCHAR(255),
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    country VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    website VARCHAR(255),
    emergency_contact VARCHAR(20) NOT NULL,
    total_beds INTEGER NOT NULL,
    available_beds INTEGER NOT NULL,
    is_verified BOOLEAN NOT NULL DEFAULT false,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pharmacies (
    pharmacy_id VARCHAR(36) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address_line1 VARCHAR(255) NOT NULL,
    address_line2 VARCHAR(255),
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    country VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    license_number VARCHAR(50) NOT NULL UNIQUE,
    operating_hours VARCHAR(255) NOT NULL,
    is_24_hours BOOLEAN NOT NULL DEFAULT false,
    is_verified BOOLEAN NOT NULL DEFAULT false
);

-- Patient management
CREATE TABLE patients (
    patient_id VARCHAR(36) PRIMARY KEY,
    user_id VARCHAR(36) NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    emergency_contact_name VARCHAR(100) NOT NULL,
    emergency_contact_phone VARCHAR(20) NOT NULL,
    blood_type VARCHAR(5),
    allergies TEXT,
    medical_history TEXT,
    UNIQUE(user_id)
);

-- Appointment management
CREATE TABLE appointment_statuses (
    status_id VARCHAR(36) PRIMARY KEY,
    status_name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT
);

CREATE TABLE appointments (
    appointment_id VARCHAR(36) PRIMARY KEY,
    patient_id VARCHAR(36) NOT NULL REFERENCES patients(patient_id) ON DELETE CASCADE,
    doctor_id VARCHAR(36) NOT NULL REFERENCES doctors(doctor_id),
    hospital_id VARCHAR(36) NOT NULL REFERENCES hospitals(hospital_id),
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    status_id VARCHAR(36) NOT NULL REFERENCES appointment_statuses(status_id),
    appointment_type appointment_type_enum NOT NULL,
    reason TEXT NOT NULL,
    notes TEXT,
    cancellation_reason TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Emergency services
CREATE TABLE emergency_types (
    type_id VARCHAR(36) PRIMARY KEY,
    type_name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    priority_level INTEGER NOT NULL CHECK (priority_level BETWEEN 1 AND 5)
);

CREATE TABLE emergency_requests (
    request_id VARCHAR(36) PRIMARY KEY,
    patient_id VARCHAR(36) NOT NULL REFERENCES patients(patient_id) ON DELETE CASCADE,
    emergency_type_id VARCHAR(36) NOT NULL REFERENCES emergency_types(type_id),
    location_latitude DECIMAL(10,8) NOT NULL,
    location_longitude DECIMAL(11,8) NOT NULL,
    address TEXT NOT NULL,
    description TEXT NOT NULL,
    status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Medication management
CREATE TABLE medications (
    medication_id VARCHAR(36) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    generic_name VARCHAR(255) NOT NULL,
    dosage_form VARCHAR(100) NOT NULL,
    strength VARCHAR(100) NOT NULL,
    category VARCHAR(100) NOT NULL,
    manufacturer VARCHAR(255) NOT NULL,
    description TEXT
);

CREATE TABLE prescriptions (
    prescription_id VARCHAR(36) PRIMARY KEY,
    patient_id VARCHAR(36) NOT NULL REFERENCES patients(patient_id) ON DELETE CASCADE,
    doctor_id VARCHAR(36) NOT NULL REFERENCES doctors(doctor_id),
    prescription_date DATE NOT NULL,
    status VARCHAR(50) NOT NULL,
    notes TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    verification_status VARCHAR(50) NOT NULL
);

-- Rating system
CREATE TABLE rating_categories (
    category_id VARCHAR(36) PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
);

CREATE TABLE ratings (
    rating_id VARCHAR(36) PRIMARY KEY,
    patient_id VARCHAR(36) NOT NULL REFERENCES patients(patient_id) ON DELETE CASCADE,
    entity_type entity_type_enum NOT NULL,
    entity_id VARCHAR(36) NOT NULL,
    category_id VARCHAR(36) NOT NULL REFERENCES rating_categories(category_id),
    rating_value INTEGER NOT NULL CHECK (rating_value BETWEEN 1 AND 5),
    review_text TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    is_verified BOOLEAN NOT NULL DEFAULT false
);

-- System management
CREATE TABLE notifications (
    notification_id VARCHAR(36) PRIMARY KEY,
    user_id VARCHAR(36) NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    message TEXT NOT NULL,
    type notification_type_enum NOT NULL,
    status notification_status_enum NOT NULL DEFAULT 'unread',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE languages (
    language_code CHAR(2) PRIMARY KEY,
    language_name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE user_preferences (
    preference_id VARCHAR(36) PRIMARY KEY,
    user_id VARCHAR(36) NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    language_code CHAR(2) NOT NULL REFERENCES languages(language_code),
    receive_notifications BOOLEAN NOT NULL DEFAULT true,
    dark_mode_enabled BOOLEAN NOT NULL DEFAULT false,
    UNIQUE(user_id)
);

sql
-- Healthcare professionals (continued)
CREATE TABLE nurses (
    nurse_id VARCHAR(36) PRIMARY KEY,
    user_id VARCHAR(36) NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    license_number VARCHAR(50) NOT NULL UNIQUE,
    department VARCHAR(100) NOT NULL,
    is_verified BOOLEAN NOT NULL DEFAULT false,
    UNIQUE(user_id)
);

CREATE TABLE pharmacists (
    pharmacist_id VARCHAR(36) PRIMARY KEY,
    user_id VARCHAR(36) NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    license_number VARCHAR(50) NOT NULL UNIQUE,
    pharmacy_id VARCHAR(36) NOT NULL REFERENCES pharmacies(pharmacy_id),
    is_verified BOOLEAN NOT NULL DEFAULT false,
    UNIQUE(user_id)
);

CREATE TABLE staff (
    staff_id VARCHAR(36) PRIMARY KEY,
    user_id VARCHAR(36) NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    department VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    UNIQUE(user_id)
);

CREATE TABLE ambulance_teams (
    team_id VARCHAR(36) PRIMARY KEY,
    user_id VARCHAR(36) NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    vehicle_id VARCHAR(50) NOT NULL UNIQUE,
    is_available BOOLEAN NOT NULL DEFAULT true,
    current_latitude DECIMAL(10,8),
    current_longitude DECIMAL(11,8),
    last_location_update TIMESTAMP,
    UNIQUE(user_id)
);

CREATE TABLE doctor_qualifications (
    qualification_id VARCHAR(36) PRIMARY KEY,
    doctor_id VARCHAR(36) NOT NULL REFERENCES doctors(doctor_id) ON DELETE CASCADE,
    degree_name VARCHAR(100) NOT NULL,
    institution VARCHAR(255) NOT NULL,
    year_completed INTEGER NOT NULL
);

-- Hospital management
CREATE TABLE hospital_departments (
    department_id VARCHAR(36) PRIMARY KEY,
    hospital_id VARCHAR(36) NOT NULL REFERENCES hospitals(hospital_id) ON DELETE CASCADE,
    name VARCHAR(100) NOT NULL,
    head_doctor_id VARCHAR(36) NOT NULL REFERENCES doctors(doctor_id),
    UNIQUE(hospital_id, name)
);

CREATE TABLE hospital_doctors (
    hospital_doctor_id VARCHAR(36) PRIMARY KEY,
    hospital_id VARCHAR(36) NOT NULL REFERENCES hospitals(hospital_id) ON DELETE CASCADE,
    doctor_id VARCHAR(36) NOT NULL REFERENCES doctors(doctor_id) ON DELETE CASCADE,
    department_id VARCHAR(36) NOT NULL REFERENCES hospital_departments(department_id),
    start_date DATE NOT NULL,
    end_date DATE,
    is_active BOOLEAN NOT NULL DEFAULT true,
    UNIQUE(hospital_id, doctor_id, department_id)
);

-- Patient records
CREATE TABLE patient_medical_records (
    record_id VARCHAR(36) PRIMARY KEY,
    patient_id VARCHAR(36) NOT NULL REFERENCES patients(patient_id) ON DELETE CASCADE,
    doctor_id VARCHAR(36) NOT NULL REFERENCES doctors(doctor_id),
    visit_date DATE NOT NULL,
    diagnosis TEXT NOT NULL,
    treatment TEXT,
    notes TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE dietary_plans (
    plan_id VARCHAR(36) PRIMARY KEY,
    patient_id VARCHAR(36) NOT NULL REFERENCES patients(patient_id) ON DELETE CASCADE,
    nurse_id VARCHAR(36) NOT NULL REFERENCES nurses(nurse_id),
    plan_details TEXT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Appointment tracking
CREATE TABLE appointment_history (
    history_id VARCHAR(36) PRIMARY KEY,
    appointment_id VARCHAR(36) NOT NULL REFERENCES appointments(appointment_id) ON DELETE CASCADE,
    status_id VARCHAR(36) NOT NULL REFERENCES appointment_statuses(status_id),
    changed_by VARCHAR(36) NOT NULL REFERENCES users(user_id),
    changed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    notes TEXT
);

-- Emergency response
CREATE TABLE emergency_responses (
    response_id VARCHAR(36) PRIMARY KEY,
    request_id VARCHAR(36) NOT NULL REFERENCES emergency_requests(request_id) ON DELETE CASCADE,
    team_id VARCHAR(36) NOT NULL REFERENCES ambulance_teams(team_id),
    hospital_id VARCHAR(36) NOT NULL REFERENCES hospitals(hospital_id),
    response_time TIMESTAMP NOT NULL,
    arrival_time TIMESTAMP,
    completion_time TIMESTAMP,
    notes TEXT
);

-- Prescription management
CREATE TABLE prescription_items (
    item_id VARCHAR(36) PRIMARY KEY,
    prescription_id VARCHAR(36) NOT NULL REFERENCES prescriptions(prescription_id) ON DELETE CASCADE,
    medication_id VARCHAR(36) NOT NULL REFERENCES medications(medication_id),
    dosage VARCHAR(100) NOT NULL,
    frequency VARCHAR(100) NOT NULL,
    duration VARCHAR(100) NOT NULL,
    quantity INTEGER NOT NULL,
    instructions TEXT
);

CREATE TABLE pharmacy_orders (
    order_id VARCHAR(36) PRIMARY KEY,
    patient_id VARCHAR(36) NOT NULL REFERENCES patients(patient_id) ON DELETE CASCADE,
    pharmacy_id VARCHAR(36) NOT NULL REFERENCES pharmacies(pharmacy_id),
    prescription_id VARCHAR(36) NOT NULL REFERENCES prescriptions(prescription_id),
    order_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    delivery_address TEXT NOT NULL,
    delivery_method VARCHAR(50) NOT NULL,
    status VARCHAR(50) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pharmacy_order_items (
    order_item_id VARCHAR(36) PRIMARY KEY,
    order_id VARCHAR(36) NOT NULL REFERENCES pharmacy_orders(order_id) ON DELETE CASCADE,
    medication_id VARCHAR(36) NOT NULL REFERENCES medications(medication_id),
    quantity INTEGER NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL
);

-- Permission management
CREATE TABLE permissions (
    permission_id VARCHAR(36) PRIMARY KEY,
    resource_name VARCHAR(100) NOT NULL,
    action_name VARCHAR(100) NOT NULL,
    description TEXT,
    UNIQUE(resource_name, action_name)
);

CREATE TABLE role_permissions (
    role_permission_id VARCHAR(36) PRIMARY KEY,
    role_id VARCHAR(36) NOT NULL REFERENCES roles(role_id) ON DELETE CASCADE,
    permission_id VARCHAR(36) NOT NULL REFERENCES permissions(permission_id) ON DELETE CASCADE,
    UNIQUE(role_id, permission_id)
);

-- System management
CREATE TABLE audit_logs (
    log_id VARCHAR(36) PRIMARY KEY,
    user_id VARCHAR(36) NOT NULL REFERENCES users(user_id),
    action VARCHAR(100) NOT NULL,
    table_name VARCHAR(100) NOT NULL,
    record_id VARCHAR(36) NOT NULL,
    old_values TEXT,
    new_values TEXT,
    timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE system_settings (
    setting_id VARCHAR(36) PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT NOT NULL,
    description TEXT,
    updated_by VARCHAR(36) NOT NULL REFERENCES users(user_id),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

