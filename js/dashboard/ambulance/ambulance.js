// Select all tab buttons by their IDs
const tabs = [
  document.getElementById('tab-trigger-emergencies'),
  document.getElementById('tab-trigger-notifications'),
  document.getElementById('tab-trigger-status')
];

tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    // Reset all tabs to gray bg and aria-selected false
    tabs.forEach(t => {
      t.classList.remove('bg-white');
      t.classList.add('bg-gray-150');
      t.setAttribute('aria-selected', 'false');
    });

    // Set clicked tab to white bg and aria-selected true
    tab.classList.remove('bg-gray-150');
    tab.classList.add('bg-white');
    tab.setAttribute('aria-selected', 'true');
  });
});
