let toastTimeoutId = null;

export function showToast(title, message, type = "error", duration = 5000) {
  const toast = document.getElementById("toast");
  const titleElement = document.getElementById("toast-title");
  const messageElement = document.getElementById("toast-message");

  if (!toast || !titleElement || !messageElement) {
    console.error("Toast elements not found");
    return;
  }

  // Clear any existing timeout
  if (toastTimeoutId) {
    clearTimeout(toastTimeoutId);
  }

  // Update toast content
  titleElement.textContent = title;
  messageElement.textContent = message;

  // Update styling based on type
  toast.className = `hidden fixed bottom-4 right-4 z-50 max-w-xs rounded-md p-5 text-white shadow-lg`;

  if (type === "error") {
    toast.classList.add("bg-danger");
  } else if (type === "success") {
    toast.classList.add("bg-success");
  } else if (type === "warning") {
    toast.classList.add("bg-warning");
  } else {
    toast.classList.add("bg-danger"); // default to error
  }

  // Show toast
  toast.classList.remove("hidden");

  // Auto-hide after duration
  toastTimeoutId = setTimeout(() => {
    toast.classList.add("hidden");
    toastTimeoutId = null;
  }, duration);
}

export function showErrorToast(title, message, duration = 5000) {
  showToast(title, message, "error", duration);
}

export function showSuccessToast(title, message, duration = 5000) {
  showToast(title, message, "success", duration);
}

export function showWarningToast(title, message, duration = 5000) {
  showToast(title, message, "warning", duration);
}

export function hideToast() {
  const toast = document.getElementById("toast");
  if (toast) {
    toast.classList.add("hidden");
  }

  if (toastTimeoutId) {
    clearTimeout(toastTimeoutId);
    toastTimeoutId = null;
  }
}
