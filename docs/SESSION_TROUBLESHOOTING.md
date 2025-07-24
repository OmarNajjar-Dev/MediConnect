# Session Troubleshooting Guide for InfinityFree

## Problem Description

After deploying to InfinityFree, `$_SESSION['user_role']` disappears after login redirect, while `$_SESSION['user_id']` remains intact.

## Root Causes & Solutions

### 1. Session Configuration Issues

**Problem**: InfinityFree has different PHP session configurations than local environments.

**Solution**: Use the enhanced session configuration in `backend/config/session-config.php`:

- Sets appropriate session timeouts
- Configures secure cookie settings
- Handles HTTPS detection
- Uses writable session directories

### 2. Session Write Timing Issues

**Problem**: Session data might not be written before redirect.

**Solution**: Use `safeSessionStore()` function which:

- Forces session write with `session_write_close()`
- Restarts session to ensure data persistence
- Handles session state checking

### 3. Cookie Domain/Path Issues

**Problem**: Session cookies might not be set correctly for the domain.

**Solution**: The enhanced configuration:

- Sets appropriate cookie settings
- Handles HTTPS vs HTTP automatically
- Uses proper SameSite settings

### 4. Session Directory Permissions

**Problem**: Default session directory might not be writable.

**Solution**: Uses default system session directory and implements fallback system.

### 5. Fallback System

**Problem**: Session data might be lost during redirects or server issues.

**Solution**: Multi-layered fallback system:

- Primary: Session storage
- Secondary: Cookie backup
- Tertiary: Database lookup

## Implementation Steps

### Step 1: Deploy Enhanced Session Configuration with Fallback System

The following files have been updated:

- `backend/config/session-config.php` (new)
- `backend/helpers/session-fallback.php` (new)
- `backend/auth/login-handler.php`
- `backend/auth/auth.php`
- `backend/middleware/protect-dashboard.php`
- `pages/dashboard/index.php`

### Step 2: Test Session Functionality

1. Upload `simple_session_test.php` to your root directory
2. Access it via browser: `https://yourdomain.com/simple_session_test.php`
3. Check session configuration and test persistence

### Step 3: Verify Login Process

1. Login to your application
2. Access `test_login_flow.php` to verify the entire login flow
3. Check if both `user_id` and `user_role` are preserved
4. Test the fallback system if session fails

## Debugging Tools

### 1. Simple Session Test (`simple_session_test.php`)

- Basic session functionality test
- Tests session write/read
- Displays server information
- Tests session persistence

### 2. Login Flow Test (`test_login_flow.php`)

- Comprehensive login process test
- Tests the entire flow from login to dashboard
- Tests fallback system
- Shows all session and cookie data

### 3. Enhanced Logging

The updated code includes debug logging in `protect-dashboard.php`:

```php
if (!$userRole) {
    error_log("Session debug - User ID: " . $_SESSION['user_id'] . ", Required Role: " . $requiredRole);
    error_log("Session debug - All session data: " . print_r($_SESSION, true));
}
```

## Common InfinityFree Issues

### 1. HTTPS Redirect Issues

- InfinityFree might redirect HTTP to HTTPS
- Session cookies might not be preserved during redirect
- Solution: Enhanced configuration handles HTTPS detection

### 2. Session Timeout

- Default session timeout might be too short
- Solution: Set to 30 minutes with `session.gc_maxlifetime`

### 3. Cookie Settings

- Secure cookies might not work on HTTP
- Solution: Automatic HTTPS detection and appropriate cookie settings

## Testing Checklist

- [ ] Session starts correctly
- [ ] User ID is stored in session
- [ ] User role is stored in session
- [ ] Session data persists across redirects
- [ ] Dashboard access works correctly
- [ ] Role-based access control works
- [ ] Remember me functionality works

## Fallback Solutions

If the enhanced session configuration doesn't work:

### 1. Database Session Storage

Store session data in database instead of files:

```php
// Alternative approach - store role in database
$stmt = $conn->prepare("SELECT role_name FROM user_roles ur JOIN roles r ON ur.role_id = r.role_id WHERE ur.user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$role = $result->fetch_assoc()['role_name'];
```

### 2. Cookie-Based Role Storage

Store role in secure cookie as backup:

```php
// Set secure cookie with role
setcookie('user_role', $role, time() + 3600, '/', '', true, true);
```

### 3. URL Parameter (Temporary)

Pass role via URL parameter (less secure, temporary fix):

```php
// In login handler
header("Location: dashboard.php?role=" . urlencode($role));
```

## Monitoring & Maintenance

1. **Regular Testing**: Test session functionality after any deployment
2. **Error Logs**: Monitor error logs for session-related issues
3. **User Reports**: Track user reports of login/session issues
4. **Performance**: Monitor session performance impact

## Support

If issues persist:

1. Check InfinityFree error logs
2. Test with different browsers
3. Verify PHP version compatibility
4. Contact InfinityFree support for session-specific issues
