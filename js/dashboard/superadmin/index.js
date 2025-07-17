import { setupTabNavigation } from "./setupTabNavigation.js";
import userManagement from "./userManagement.js";
import hospitalManagement from "./hospitalManagement.js";
import profileManagement from "./profileManagement.js";
import systemOverview from "./systemOverview.js";

window.addEventListener("DOMContentLoaded", () => {
  setupTabNavigation();
  // All modules are auto-initialized in their respective files
});
