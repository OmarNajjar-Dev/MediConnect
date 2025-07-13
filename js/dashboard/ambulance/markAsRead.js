export function markAsRead(notification) {
  if (notification?.classList.contains("bg-gray-50")) return false;

  notification?.classList.remove("bg-red-50", "border-red-200");
  notification?.classList.add("bg-gray-50", "border-gray-200");

  notification?.querySelector(".red-dot")?.classList.add("hidden");
  notification?.querySelector(".new-badge")?.classList.add("hidden");

  return true;
}
