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
<!-- Universal Toast Container -->
<div
  id="toast"
  class="hidden fixed bottom-4 right-4 z-50 max-w-xs rounded-md p-5 text-white shadow-lg"
>
  <p id="toast-title" class="font-semibold"></p>
  <p id="toast-message" class="text-sm"></p>
</div>
```

## Features

- ✅ Auto-hide after 5 seconds
- ✅ Prevents overlapping toasts
- ✅ Multiple toast types (error, success, warning)
- ✅ Consistent styling across all pages
- ✅ Simple API
- ✅ Semantic HTML structure
- ✅ Type-agnostic naming convention

## Toast Types

The system automatically applies the appropriate styling based on the toast type:

- **Error**: Red background (`bg-danger`)
- **Success**: Green background (`bg-success`)
- **Warning**: Yellow background (`bg-warning`)

## Best Practices

- Use semantic IDs (`toast`, `toast-title`, `toast-message`) instead of type-specific IDs
- The toast container handles all message types dynamically
- Consistent positioning and styling across all pages
