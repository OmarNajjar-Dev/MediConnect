import { setupPasswordToggle } from './pass.js';
import { setupPasswordMatchCheck } from './validate.js';

document.addEventListener('DOMContentLoaded', () => {
  setupPasswordToggle('password', 'togglePassword');
  window.setupPasswordMatchCheck=setupPasswordMatchCheck;
});
