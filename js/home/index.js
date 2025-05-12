import { renderHeroCards } from "./hero-cards.js";
import { renderServicesCards } from "./services-cards.js";
import { renderRatingCards } from "./rating-cards.js";
import { renderTestimonials } from "./testimonials.js";

import "../common/header.js";
import "../common/mobile-nav.js";

document.addEventListener("DOMContentLoaded", () => {
  renderHeroCards(document.getElementById("hero-cards-container"));
  renderServicesCards(document.getElementById("services-cards-container"));
  renderRatingCards(document.getElementById("rating-cards-container"));
  renderTestimonials(document.getElementById("testimonials-cards-container"));
  lucide.createIcons();
});
