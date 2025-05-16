// Pure helper to generate star icons
export function generateRatingStars(rating, classes = []) {
  const yellow = `<i data-lucide="star" class="text-star-400 fill-star-400 ${classes.join(
    " "
  )}"></i>`;
  const gray = `<i data-lucide="star" class="text-gray-300 ${classes.join(
    " "
  )}"></i>`;
  return yellow.repeat(rating) + gray.repeat(5 - rating);
}
