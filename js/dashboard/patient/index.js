import { setupTabNavigation } from "../utils/setupTabNavigation.js";
import { initProfileManagement } from "./profileManagement.js";

document.addEventListener("DOMContentLoaded", () => {
  setupTabNavigation();
  initProfileManagement();
});
