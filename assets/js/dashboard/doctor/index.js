import { setupTabNavigation } from "../utils/setupTabNavigation.js";
import { initProfileManagement } from "./profileManagement.js";
import { initAppointmentManagement } from "./appointmentManagement.js";

document.addEventListener("DOMContentLoaded", () => {
  setupTabNavigation();
  initProfileManagement();
  initAppointmentManagement();
});
