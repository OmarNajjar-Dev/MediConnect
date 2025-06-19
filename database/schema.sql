-- Best Practice Beginner-Friendly MediConnect Database (Balanced Version)
-- Includes core functionality and useful extensibility without overcomplicating

-- USERS & AUTHENTICATION
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(200) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

CREATE TABLE roles (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(50) NOT NULL UNIQUE
) ENGINE = InnoDB;

CREATE TABLE user_roles (
    user_role_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(role_id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- DOCTORS & SPECIALTIES
CREATE TABLE specialties (
    specialty_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE
) ENGINE = InnoDB;

CREATE TABLE doctors (
    doctor_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    specialty_id INT,
    bio TEXT,
    rating DECIMAL(2,1),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (specialty_id) REFERENCES specialties(specialty_id)
) ENGINE = InnoDB;

-- PATIENTS
CREATE TABLE patients (
    patient_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    birthdate DATE,
    gender ENUM('Male', 'Female', 'Other'),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- HOSPITALS
CREATE TABLE hospitals (
    hospital_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    contact VARCHAR(50),
    emergency_services BOOLEAN DEFAULT FALSE
) ENGINE = InnoDB;

CREATE TABLE hospital_specialties (
    id INT PRIMARY KEY AUTO_INCREMENT,
    hospital_id INT NOT NULL,
    specialty_id INT NOT NULL,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(hospital_id) ON DELETE CASCADE,
    FOREIGN KEY (specialty_id) REFERENCES specialties(specialty_id),
    UNIQUE (hospital_id, specialty_id)
) ENGINE = InnoDB;

-- APPOINTMENTS
CREATE TABLE appointments (
    appointment_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    hospital_id INT,
    appointment_date DATETIME,
    status ENUM('Scheduled', 'Completed', 'Cancelled') DEFAULT 'Scheduled',
    notes TEXT,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id),
    FOREIGN KEY (hospital_id) REFERENCES hospitals(hospital_id)
) ENGINE = InnoDB;

-- RATINGS
CREATE TABLE ratings (
    rating_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    doctor_id INT,
    hospital_id INT,
    rating_value INT CHECK (rating_value BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id),
    FOREIGN KEY (hospital_id) REFERENCES hospitals(hospital_id)
) ENGINE = InnoDB;

-- EMERGENCY MODULE
CREATE TABLE emergency_requests (
    request_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    location VARCHAR(255),
    status ENUM('Pending', 'In Transit', 'Resolved') DEFAULT 'Pending',
    requested_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
) ENGINE = InnoDB;

CREATE TABLE ambulance_teams (
    team_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    team_name VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE = InnoDB;

CREATE TABLE emergency_responses (
    response_id INT PRIMARY KEY AUTO_INCREMENT,
    request_id INT NOT NULL,
    team_id INT NOT NULL,
    dispatched_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (request_id) REFERENCES emergency_requests(request_id),
    FOREIGN KEY (team_id) REFERENCES ambulance_teams(team_id)
) ENGINE = InnoDB;

-- NOTIFICATIONS
CREATE TABLE notifications (
    notification_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- SIMPLE AUDIT LOG (OPTIONAL FOR LEARNING PURPOSES)
CREATE TABLE audit_logs (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    action VARCHAR(100),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
) ENGINE = InnoDB;
