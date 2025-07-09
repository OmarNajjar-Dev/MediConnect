export function updateBadge(badge, unreadCount) {
  badge?.classList.toggle("hidden", unreadCount <= 0);

  if (unreadCount > 0) {
    badge.textContent = unreadCount;
  }
}
