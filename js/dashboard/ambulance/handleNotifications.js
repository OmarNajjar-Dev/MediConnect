// handleNotifications.js

import { updateBadge } from "./updateBadge.js";
import { markAsRead } from "./markAsRead.js";

export function handleNotifications() {
  const notifications = document.querySelectorAll(".notification-card");
  const badge = document.getElementById("notification-count");

  let unreadCount = notifications.length;

  notifications.forEach((notification) => {
    notification.addEventListener("click", () => {
      if (markAsRead(notification)) {
        unreadCount--;
        updateBadge(badge, unreadCount);
      }
    });
  });

  updateBadge(badge, unreadCount);
}
