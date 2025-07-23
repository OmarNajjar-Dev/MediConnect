-- Migration script to fix emergency_requests table for guest user support
-- Run this script to update your existing database
-- Step 1: Drop the existing foreign key constraint
ALTER TABLE
    emergency_requests DROP FOREIGN KEY emergency_requests_ibfk_1;

-- Step 2: Modify the patient_id column to allow NULL values
ALTER TABLE
    emergency_requests
MODIFY
    COLUMN patient_id INT NULL;

-- Step 3: Re-add the foreign key constraint with ON DELETE SET NULL
ALTER TABLE
    emergency_requests
ADD
    CONSTRAINT emergency_requests_ibfk_1 FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE
SET
    NULL;

-- Step 4: Verify the changes
DESCRIBE emergency_requests;