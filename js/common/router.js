// js/common/router.js

// 1) Define your routes and the files they map to:
const routes = {
  '/':               () => fetchPage('index.html'),
  '/doctors':        () => fetchPage('doctors.html'),
  '/hospitals':      () => fetchPage('hospitals.html'),
  '/appointments':   () => fetchPage('appointments.html'),
  '/dashboard':      () => fetchPage('dashboard.html'),
  // …add any others you have…
};

// 2) Fetch & inject a page into #app
function fetchPage(path) {
  fetch(path)
    .then(res => {
      if (!res.ok) throw new Error('not-found');
      return res.text();
    })
    .then(html => {
      document.getElementById('app').innerHTML = html;
    })
    .catch(_ => show404());
}

// 3) Show your 404.html in #app
function show404() {
  fetch('404.html')
    .then(r => r.text())
    .then(html => {
      document.getElementById('app').innerHTML = html;
      document.title = '404 — Page Not Found';
    });
}

// 4) The router logic
function router() {
  const key = window.location.pathname.replace(/\/$/, '') || '/';
  const route = routes[key];
  if (route) {
    route();
  } else {
    show404();
  }
}

// 5) Programmatic navigation
export function navigate(to) {
  history.pushState(null, '', to);
  router();
}

// 6) Wire up the events
window.addEventListener('DOMContentLoaded', router);
window.addEventListener('popstate', router);

// at the bottom of js/common/router.js
document.body.addEventListener('click', e => {
  const a = e.target.closest('a[href^="/"]');
  if (!a) return;
  e.preventDefault();
  navigate(a.getAttribute('href'));
});
