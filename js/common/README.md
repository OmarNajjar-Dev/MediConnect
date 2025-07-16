# Universal Toast System

## Usage

### Import the toast functions:

```javascript
import {
  showErrorToast,
  showSuccessToast,
  showWarningToast,
  hideToast,
} from "./toast.js";
```

### Show different types of toasts:

```javascript
// Error toast (red)
showErrorToast("Error Title", "Error message here");

// Success toast (green)
showSuccessToast("Success!", "Operation completed successfully");

// Warning toast (yellow)
showWarningToast("Warning", "Please check your input");

// Hide toast manually
hideToast();
```

### Add to any page:

```html
<!-- Dynamic Error Toast -->
<div
  id="error-toast"
  class="hidden fixed bottom-4 right-4 z-50 max-w-xs rounded-md bg-danger p-5 text-white shadow-lg"
>
  <p id="error-title" class="font-semibold"></p>
  <p id="error-message" class="text-sm"></p>
</div>
```

## Features

- ✅ Auto-hide after 5 seconds
- ✅ Prevents overlapping toasts
- ✅ Multiple toast types (error, success, warning)
- ✅ Consistent styling across all pages
- ✅ Simple API
