# Emergency System Verification Guide

## Overview

This guide helps verify that the emergency request system is working correctly for both guest and patient users, and that ambulance team registration is properly configured.

## ✅ Current Status: FIXED

### Database Schema Issues - RESOLVED

- **Problem**: `emergency_requests.patient_id` was `NOT NULL` but guest users need `NULL` values
- **Solution**: Database already updated to allow `NULL` values for `patient_id`
- **Evidence**: Records 25-29 in `emergency_requests` table show `patient_id` as `NULL` (guest users)

### Ambulance Team Registration - ENHANCED

- **Problem**: Ambulance teams weren't being added to `ambulance_locations` table
- **Solution**: Updated `create-user.php` and `update-user.php` to automatically create location entries

## 🔍 Verification Steps

### 1. Database Verification

Run these SQL queries to verify the system:

```sql
-- Check emergency_requests table structure
DESCRIBE emergency_requests;

-- Verify guest user requests (should show NULL patient_id)
SELECT request_id, patient_id, status, requested_at
FROM emergency_requests
WHERE patient_id IS NULL
ORDER BY requested_at DESC
LIMIT 5;

-- Verify patient user requests (should show valid patient_id)
SELECT request_id, patient_id, status, requested_at
FROM emergency_requests
WHERE patient_id IS NOT NULL
ORDER BY requested_at DESC
LIMIT 5;

-- Check ambulance teams and their locations
SELECT
    at.team_id,
    at.team_name,
    u.first_name,
    u.last_name,
    al.latitude,
    al.longitude,
    al.updated_at
FROM ambulance_teams at
JOIN users u ON at.user_id = u.user_id
LEFT JOIN ambulance_locations al ON at.team_id = al.team_id
ORDER BY at.team_id;
```

### 2. API Testing

#### Test Emergency Request (Guest User)

```bash
curl -X POST http://localhost/mediconnect/backend/api/handle-emergency.php \
  -H "Content-Type: application/json" \
  -d '{"latitude": 34.390016, "longitude": 35.8055936}'
```

**Expected Response:**

```json
{
  "success": true,
  "message": "Emergency request saved successfully",
  "ambulance_team_id": 1,
  "estimated_time_minutes": 10,
  "request_id": 30,
  "user_role": "guest",
  "debug": {
    "session_user_id": "NOT_SET",
    "session_user_role": "NOT_SET",
    "patient_id_found": "GUEST_USER_NULL",
    "coordinates": { "lat": 34.390016, "lng": 35.8055936 }
  }
}
```

#### Test Emergency Request (Patient User)

```bash
# First login as a patient, then:
curl -X POST http://localhost/mediconnect/backend/api/handle-emergency.php \
  -H "Content-Type: application/json" \
  -H "Cookie: PHPSESSID=your_session_id" \
  -d '{"latitude": 34.390016, "longitude": 35.8055936}'
```

**Expected Response:**

```json
{
  "success": true,
  "message": "Emergency request saved successfully",
  "ambulance_team_id": 1,
  "estimated_time_minutes": 10,
  "request_id": 31,
  "user_role": "patient",
  "debug": {
    "session_user_id": "1",
    "session_user_role": "patient",
    "patient_id_found": 11,
    "coordinates": { "lat": 34.390016, "lng": 35.8055936 }
  }
}
```

### 3. Frontend Testing

#### Test Guest User Emergency Request

1. Open browser in incognito mode (no login)
2. Navigate to `/mediconnect/pages/services/emergency.php`
3. Click "Request Emergency Help"
4. Allow location access
5. Verify success message and countdown timer

#### Test Patient User Emergency Request

1. Login as a patient user
2. Navigate to `/mediconnect/pages/services/emergency.php`
3. Click "Request Emergency Help"
4. Allow location access
5. Verify success message and countdown timer

### 4. Ambulance Team Registration Testing

#### Test Creating Ambulance Team

```bash
curl -X POST http://localhost/mediconnect/backend/api/create-user.php \
  -H "Content-Type: application/json" \
  -d '{
    "fullName": "John Ambulance",
    "email": "john.ambulance@test.com",
    "role": "Ambulance Team",
    "teamName": "Emergency Response Unit",
    "city": "Tripoli",
    "addressLine": "Emergency Station",
    "password": "securepass123"
  }'
```

**Expected Result:**

- User created in `users` table
- Role assigned in `user_roles` table
- Team created in `ambulance_teams` table
- Location entry created in `ambulance_locations` table

#### Test Ambulance Location Update

```bash
curl -X POST http://localhost/mediconnect/backend/api/update-ambulance-location.php \
  -H "Content-Type: application/json" \
  -H "Cookie: PHPSESSID=ambulance_session_id" \
  -d '{"latitude": 34.3950456, "longitude": 35.8429366}'
```

## 🐛 Debugging Tools

### 1. Browser Console

Open browser developer tools and check:

- Network tab for API responses
- Console tab for JavaScript errors
- Application tab for session data

### 2. Server Logs

Check XAMPP/Apache error logs:

- Windows: `C:\xampp\apache\logs\error.log`
- Look for PHP errors related to emergency requests

### 3. Database Logs

Enable MySQL query logging:

```sql
SET GLOBAL general_log = 'ON';
SET GLOBAL general_log_file = '/path/to/mysql.log';
```

## 📊 Monitoring Queries

### Emergency Request Statistics

```sql
-- Daily emergency requests
SELECT
    DATE(requested_at) as date,
    COUNT(*) as total_requests,
    COUNT(CASE WHEN patient_id IS NULL THEN 1 END) as guest_requests,
    COUNT(CASE WHEN patient_id IS NOT NULL THEN 1 END) as patient_requests
FROM emergency_requests
WHERE requested_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
GROUP BY DATE(requested_at)
ORDER BY date DESC;

-- Request status distribution
SELECT
    status,
    COUNT(*) as count
FROM emergency_requests
GROUP BY status;
```

### Ambulance Team Status

```sql
-- Active ambulance teams
SELECT
    at.team_id,
    at.team_name,
    u.first_name,
    u.last_name,
    al.latitude,
    al.longitude,
    al.updated_at,
    CASE
        WHEN al.updated_at > DATE_SUB(NOW(), INTERVAL 1 HOUR) THEN 'Active'
        ELSE 'Inactive'
    END as status
FROM ambulance_teams at
JOIN users u ON at.user_id = u.user_id
LEFT JOIN ambulance_locations al ON at.team_id = al.team_id
ORDER BY al.updated_at DESC;
```

## ✅ Success Criteria

The emergency system is working correctly when:

1. ✅ Guest users can request emergency help (patient_id = NULL)
2. ✅ Patient users can request emergency help (patient_id = valid ID)
3. ✅ Emergency requests are saved to database
4. ✅ Ambulance teams are automatically created with location entries
5. ✅ Ambulance teams can update their GPS location
6. ✅ Frontend shows appropriate success/error messages
7. ✅ Countdown timer works correctly
8. ✅ Cancel functionality works

## 🚨 Common Issues & Solutions

### Issue: "No ambulance found" error

**Cause**: No ambulance teams in `ambulance_locations` table
**Solution**: Create ambulance team users or add location data

### Issue: Database constraint violation

**Cause**: Old database schema with NOT NULL constraint
**Solution**: Run the migration script: `database/migrate_emergency_requests.sql`

### Issue: Session not working for patient users

**Cause**: Session configuration or middleware issues
**Solution**: Check session configuration and middleware files

### Issue: Location access denied

**Cause**: Browser blocking geolocation
**Solution**: Ensure HTTPS or localhost, check browser permissions
