import { visionItems } from "./data/vision-data.js";
import { journeyMilestones } from "./data/journey-data.js";
import { leadershipTeam } from "./data/leadership-data.js";

import { renderVision } from "./render/render-vision.js";
import { renderJourney } from "./render/render-journey.js";
import { renderLeadership } from "./render/render-leadership.js";

document.addEventListener("DOMContentLoaded", () => {
  const visionContainer = document.getElementById("vision-cards-container");
  const journeyContainer = document.getElementById("journey-cards-container");
  const leadershipContainer = document.getElementById("leadership-cards-container");

  renderVision(visionItems, visionContainer);
  renderJourney(journeyMilestones, journeyContainer);
  renderLeadership(leadershipTeam, leadershipContainer);
  lucide.createIcons();
});
