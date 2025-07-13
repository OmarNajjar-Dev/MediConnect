import { setupTabNavigation } from "../utils/setupTabNavigation.js";

import { handleNotifications } from "./handleNotifications.js";

window.addEventListener("DOMContentLoaded", () => {
  setupTabNavigation();
  handleNotifications();
});
