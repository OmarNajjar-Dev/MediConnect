/**
 * Initializes a countdown timer.
 * @param {string} launchDateStr - The launch date in ISO format, e.g., '2025-10-01T00:00:00'.
 * @param {Object} options - IDs of the DOM elements to update.
 * @param {string} options.daysId - Element ID for days.
 * @param {string} options.hoursId - Element ID for hours.
 * @param {string} options.minutesId - Element ID for minutes.
 * @param {string} options.secondsId - Element ID for seconds.
 * @param {string} options.containerId - (Optional) Element ID to clear/replace after countdown ends.
 */
export function initCountdown(launchDateStr, {
    daysId = 'days',
    hoursId = 'hours',
    minutesId = 'minutes',
    secondsId = 'seconds',
    containerId = null
} = {}) {
    const launchDate = new Date(launchDateStr).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = launchDate - now;

        if (distance <= 0) {
            if (containerId) {
                const container = document.getElementById(containerId);
                if (container) {
                    container.innerHTML = "<p class='text-lg text-gray-600'>We have launched!</p>";
                }
            }
            clearInterval(timer);
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById(daysId).textContent = days;
        document.getElementById(hoursId).textContent = hours.toString().padStart(2, "0");
        document.getElementById(minutesId).textContent = minutes.toString().padStart(2, "0");
        document.getElementById(secondsId).textContent = seconds.toString().padStart(2, "0");
    }

    updateCountdown();
    const timer = setInterval(updateCountdown, 1000);
}
