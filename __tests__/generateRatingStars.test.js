import { generateRatingStars } from "../js/utils/generateRatingStars.js";

describe("generateRatingStars", () => {
  it("returns correct number of yellow and gray stars", () => {
    const stars = generateRatingStars(3, []);
    expect((stars.match(/star/g) || []).length).toBe(5);
    expect(stars).toContain("text-star-400");
    expect(stars).toContain("text-gray-300");
  });
});
