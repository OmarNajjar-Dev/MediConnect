import { setupTabNavigation } from "../utils/setupTabNavigation.js";
import { handleNotifications } from './notifHandler.js';

window.addEventListener("DOMContentLoaded", () => {
  setupTabNavigation();
  handleNotifications();
});
