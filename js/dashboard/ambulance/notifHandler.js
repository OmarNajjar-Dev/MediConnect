export function handleNotifications() {
  const notifications = document.querySelectorAll(".notification-card");
  const badge = document.getElementById("notification-count");

  let unreadCount = notifications.length;

  function updateBadge() {
    if (badge) {
      if (unreadCount <= 0) {
        badge.classList.add("hidden");
      } else {
        badge.textContent = unreadCount;
      }
    }
  }

  notifications.forEach((notification) => {
    notification.addEventListener("click", () => {
      // If already marked as read, skip
      if (notification.classList.contains("bg-gray-50")) return;

      // Change styles
      notification.classList.remove("bg-red-50", "border-red-200");
      notification.classList.add("bg-gray-50", "border-gray-200");

      const redDot = notification.querySelector(".red-dot");
      const newBadge = notification.querySelector(".new-badge");

      if (redDot) redDot.classList.add("hidden");
      if (newBadge) newBadge.classList.add("hidden");

      // Decrease count and update badge
      unreadCount--;
      updateBadge();
    });
  });

  // Initial badge update in case some notifications are already read
  updateBadge();
}
