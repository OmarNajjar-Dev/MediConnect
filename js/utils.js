// ============================
// Helper Function: generateRatingStars
// ============================
// This function generates an HTML string for rating stars.
// It accepts a rating (number from 1 to 5) and an optional array of additional classes.
// It returns yellow stars for the rating and gray stars for the remaining out of 5.
export function generateRatingStars(rating, classes = []) {
  // Yellow star icon with specified classes
  const yellowStar = `<i data-lucide="star" class="text-star-400 fill-star-400 ${classes.join(
    " "
  )}"></i>`;
  // Gray star icon with specified classes
  const grayStar = `<i data-lucide="star" class="text-gray-300 ${classes.join(
    " "
  )}"></i>`;
  return yellowStar.repeat(rating) + grayStar.repeat(5 - rating);
}
