const daysContainer = document.getElementById("days");
const monthYear = document.getElementById("month-year");
const prevBtn = document.getElementById("prev");
const nextBtn = document.getElementById("next");

let date = new Date();
let selectedDay = null;

export function renderCalendar() {
  const year = date.getFullYear();
  const month = date.getMonth();

  const firstDay = new Date(year, month, 1).getDay();
  const lastDate = new Date(year, month + 1, 0).getDate();
  const prevLastDate = new Date(year, month, 0).getDate();

  daysContainer.innerHTML = "";

  monthYear.textContent = date.toLocaleString("default", {
    month: "long",
    year: "numeric",
  });

  for (let i = firstDay; i > 0; i--) {
    const div = document.createElement("div");
    div.textContent = prevLastDate - i + 1;
    div.className = "h-9 w-9 text-gray-400 not-allowed cursor-not-allowed flex items-center justify-center";
    div.setAttribute("disabled", "true");
    daysContainer.appendChild(div);
  }

  for (let i = 1; i <= lastDate; i++) {
    const div = document.createElement("div");
    div.textContent = i;

    const defaultClass =
      "h-9 w-9 rounded-md hover:text-medical-600 pointer hover:bg-medical-50 flex items-center justify-center transition-colors";
    div.className = defaultClass;

    const today = new Date();
    const isToday =
      i === today.getDate() &&
      month === today.getMonth() &&
      year === today.getFullYear();

    if (isToday) {
      div.classList.add("font-bold", "text-black");
    }

    div.addEventListener("click", () => {
      if (selectedDay === div) {
        div.className = defaultClass;
        if (isToday) div.classList.add("font-bold", "text-black");
        selectedDay = null;
      } else {
        if (selectedDay) {
          const prevText = selectedDay.textContent;
          selectedDay.className = defaultClass;
          const wasToday =
            +prevText === today.getDate() &&
            month === today.getMonth() &&
            year === today.getFullYear();
          if (wasToday) selectedDay.classList.add("font-bold", "text-black");
        }

        div.className =
          "h-9 w-9 rounded-md bg-medical-600 text-white pointer flex items-center justify-center transition-colors";
        selectedDay = div;
      }
    });

    daysContainer.appendChild(div);
  }
}

prevBtn.addEventListener("click", () => {
  date.setMonth(date.getMonth() - 1);
  selectedDay = null;
  renderCalendar();
});

nextBtn.addEventListener("click", () => {
  date.setMonth(date.getMonth() + 1);
  selectedDay = null;
  renderCalendar();
});

renderCalendar();
