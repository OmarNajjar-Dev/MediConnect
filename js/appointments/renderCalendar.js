const daysContainer = document.getElementById("days");
const monthYear = document.getElementById("month-year");
const prevBtn = document.getElementById("prev");
const nextBtn = document.getElementById("next");

let date = new Date();

export function renderCalendar() {
  const year = date.getFullYear();
  const month = date.getMonth();

  // First day of the month
  const firstDay = new Date(year, month, 1).getDay();

  // Last date of the month
  const lastDate = new Date(year, month + 1, 0).getDate();

  // Last day of the previous month
  const prevLastDate = new Date(year, month, 0).getDate();

  daysContainer.innerHTML = "";
  monthYear.textContent = date.toLocaleString("default", {
    month: "long",
    year: "numeric",
  });

  // Previous month's days
  for (let i = firstDay; i > 0; i--) {
    const div = document.createElement("div");
    div.textContent = prevLastDate - i + 1;
    div.style.opacity = "0.3";
    daysContainer.appendChild(div);
  }

  // Current month's days
  for (let i = 1; i <= lastDate; i++) {
    const div = document.createElement("div");
    div.textContent = i;

    if (
      i === new Date().getDate() &&
      month === new Date().getMonth() &&
      year === new Date().getFullYear()
    ) {
      div.style.background = "#007bff";
      div.style.color = "white";
      div.style.borderRadius = "50%";
    }

    daysContainer.appendChild(div);
  }
}

prevBtn.addEventListener("click", () => {
  date.setMonth(date.getMonth() - 1);
  renderCalendar();
});

nextBtn.addEventListener("click", () => {
  date.setMonth(date.getMonth() + 1);
  renderCalendar();
});

renderCalendar();
