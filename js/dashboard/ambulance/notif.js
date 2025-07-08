const notifications = document.querySelectorAll('.notification-card');

notifications.forEach(notification => {
  notification.addEventListener('click', () => {
    notification.classList.remove('bg-red-50', 'border-red-200');
    notification.classList.add('bg-gray-50', 'border-gray-200');

    const redDot = notification.querySelector('.red-dot');
    const newBadge = notification.querySelector('.new-badge');

    if (redDot) redDot.style.display = 'none';
    if (newBadge) newBadge.style.display = 'none';
  });
});
