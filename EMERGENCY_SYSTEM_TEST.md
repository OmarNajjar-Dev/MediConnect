# Emergency System Test Guide

## System Overview

The emergency system handles user interactions for emergency requests with proper state management and database synchronization.

## Critical Test Scenarios

### Test 1: Cancel from Drawer (MOST IMPORTANT)

**Steps:**

1. Click "Request Emergency Help" button
2. Drawer appears with cancel button
3. Click "Cancel" button in drawer

**Expected Results:**

- ✅ Drawer closes immediately
- ✅ Countdown stops completely (no background timers)
- ✅ Database status updated to 'Canceled'
- ✅ Status section remains hidden
- ✅ Help button section returns to original state
- ✅ ETA text shows "Estimated arrival: 10 minutes"
- ✅ Page looks exactly as it was before clicking emergency button
- ✅ No "Ambulance Arrived!" messages
- ✅ User can request emergency again normally

### Test 2: Cancel from Status Section

**Steps:**

1. Click "Request Emergency Help" button
2. Wait for drawer to close (4 seconds)
3. Click "Cancel Request" in status section

**Expected Results:**

- ✅ Same behavior as drawer cancel
- ✅ Countdown stops immediately
- ✅ UI resets completely

### Test 3: Countdown Completion

**Steps:**

1. Click "Request Emergency Help"
2. Wait for countdown to reach zero (4 minutes)

**Expected Results:**

- ✅ Database status automatically updates to 'Completed'
- ✅ Status display shows "COMPLETED"
- ✅ ETA text shows "Ambulance has arrived!"
- ✅ Success toast appears
- ✅ Session storage is cleared

### Test 4: Multiple Rapid Requests

**Steps:**

1. Click "Request Emergency Help"
2. Click "Cancel" in drawer
3. Immediately click "Request Emergency Help" again
4. Click "Cancel" again

**Expected Results:**

- ✅ Each request/cancel cycle works independently
- ✅ No leftover state from previous requests
- ✅ No memory leaks or lingering timeouts

### Test 5: Cancel During Countdown

**Steps:**

1. Click "Request Emergency Help"
2. Wait for drawer to close
3. Wait 1-2 minutes (countdown running)
4. Click "Cancel Request"

**Expected Results:**

- ✅ Countdown stops immediately
- ✅ No "Ambulance Arrived!" message appears
- ✅ UI resets completely
- ✅ Database status is 'Canceled'

## Database Verification

### Check emergency_requests table:

```sql
SELECT request_id, patient_id, status, requested_at, canceled_at, completed_at
FROM emergency_requests
ORDER BY requested_at DESC
LIMIT 10;
```

**Expected Status Values:**

- `'Pending'` - New request, countdown active
- `'Canceled'` - Request cancelled by user
- `'Completed'` - Countdown reached zero

### Check emergency_responses table:

```sql
SELECT er.request_id, er.status, er.requested_at, er.canceled_at, er.completed_at,
       resp.response_id, resp.dispatched_at
FROM emergency_requests er
LEFT JOIN emergency_responses resp ON er.request_id = resp.request_id
ORDER BY er.requested_at DESC
LIMIT 10;
```

## State Management

### Key Variables:

- `currentRequestId` - Current emergency request ID
- `requestCancelled` - Whether request was cancelled (local to each module)
- `window.emergencyRequestCancelled` - Global cancellation state
- `drawerTimeout` - Drawer auto-close timeout
- `countdownTimeout` - Countdown timer reference
- `isCountdownActive` - Whether countdown is running

### State Transitions:

1. **Request Initiated**: `requestCancelled = false`, countdown starts
2. **Request Cancelled**: `requestCancelled = true`, countdown stops
3. **Request Completed**: All state cleared, status = 'Completed'

## Success Criteria

### UI Behavior:

- ✅ Cancel button in drawer works immediately
- ✅ No lingering UI elements after cancellation
- ✅ Page returns to exact original state
- ✅ No countdown continues after cancellation
- ✅ No ambulance arrival messages after cancellation

### Database Consistency:

- ✅ Status updates correctly for all scenarios
- ✅ Both tables updated in sync
- ✅ Proper timestamps for all state changes

### State Management:

- ✅ Global state prevents race conditions
- ✅ All timeouts properly cleared
- ✅ No memory leaks
- ✅ Clean state transitions

### User Experience:

- ✅ Immediate response to cancel actions
- ✅ Clear visual feedback
- ✅ Consistent behavior across all interactions
- ✅ No confusing or lingering states

## Edge Cases Handled:

- ✅ Multiple rapid cancel attempts
- ✅ Network errors during requests
- ✅ Browser refresh during active request
- ✅ Multiple emergency requests in sequence
- ✅ Cancellation during countdown
- ✅ Page navigation during active request
