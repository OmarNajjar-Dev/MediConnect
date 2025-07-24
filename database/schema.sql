CREATE TABLE users (
  user_id INT PRIMARY KEY,
  email VARCHAR(255) UNIQUE,
  password VARCHAR(255),
  first_name VARCHAR(255),
  last_name VARCHAR(255),
  city VARCHAR(255),
  address_line VARCHAR(255),
  profile_image TEXT,
  remember_token VARCHAR(255)
);

CREATE TABLE roles (
  role_id INT PRIMARY KEY,
  role_name VARCHAR(100) UNIQUE
);

CREATE TABLE user_roles (
  user_role_id INT PRIMARY KEY,
  user_id INT,
  role_id INT,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (role_id) REFERENCES roles(role_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE hospitals (
  hospital_id INT PRIMARY KEY,
  name VARCHAR(255),
  address VARCHAR(255),
  contact VARCHAR(100),
  available_beds INT,
  rating DECIMAL(3,2),
  reviews_count INT,
  emergency_services BOOLEAN,
  image_url TEXT
);

CREATE TABLE specialties (
  specialty_id INT PRIMARY KEY,
  name VARCHAR(100) UNIQUE,
  label_for_doctor VARCHAR(100),
  label_for_hospital VARCHAR(100)
);

CREATE TABLE hospital_specialties (
  id INT PRIMARY KEY,
  hospital_id INT,
  specialty_id INT,
  UNIQUE(hospital_id, specialty_id),
  FOREIGN KEY (hospital_id) REFERENCES hospitals(hospital_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (specialty_id) REFERENCES specialties(specialty_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE doctors (
  doctor_id INT PRIMARY KEY,
  user_id INT,
  specialty_id INT,
  hospital_id INT,
  is_verified BOOLEAN,
  bio TEXT,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (specialty_id) REFERENCES specialties(specialty_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (hospital_id) REFERENCES hospitals(hospital_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE patients (
  patient_id INT PRIMARY KEY,
  user_id INT,
  birthdate DATE,
  gender VARCHAR(10),
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE appointments (
  appointment_id INT PRIMARY KEY,
  patient_id INT,
  doctor_id INT,
  hospital_id INT,
  appointment_date DATETIME,
  status VARCHAR(50),
  notes TEXT,
  FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (hospital_id) REFERENCES hospitals(hospital_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ambulance_teams (
  team_id INT PRIMARY KEY,
  user_id INT,
  team_name VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ambulance_locations (
  team_id INT PRIMARY KEY,
  latitude DECIMAL(9,6),
  longitude DECIMAL(9,6),
  updated_at DATETIME,
  FOREIGN KEY (team_id) REFERENCES ambulance_teams(team_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE emergency_requests (
  request_id INT PRIMARY KEY,
  patient_id INT,
  location JSON,
  status VARCHAR(50),
  requested_at DATETIME,
  canceled_at DATETIME,
  completed_at DATETIME,
  FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE emergency_responses (
  response_id INT PRIMARY KEY,
  request_id INT,
  team_id INT,
  dispatched_at DATETIME,
  FOREIGN KEY (request_id) REFERENCES emergency_requests(request_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (team_id) REFERENCES ambulance_teams(team_id) ON DELETE CASCADE ON UPDATE CASCADE
);
