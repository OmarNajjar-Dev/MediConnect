const daysContainer = document.getElementById("days");
const monthYear = document.getElementById("month-year");
const prevBtn = document.getElementById("prev");
const nextBtn = document.getElementById("next");
const selectedDateValue = document.getElementById("selected-date");
const dateButton = document.getElementById('appointment-date');
const calendarPopup = document.getElementById('calendar-popup');
const timeSlotButton = document.getElementById('time-slot-button');

let date = new Date();
let selectedDay = null;

function addOrdinalSuffix(n) {
  const s = ["th", "st", "nd", "rd"];
  const v = n % 100;
  return n + (s[(v - 20) % 10] || s[v] || s[0]);
}

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

  const today = new Date();
  today.setHours(0, 0, 0, 0);

  for (let i = firstDay; i > 0; i--) {
    const div = document.createElement("div");
    div.textContent = prevLastDate - i + 1;
    div.className = "h-9 w-9 text-gray-400 not-allowed not-allowed flex items-center justify-center";
    div.setAttribute("disabled", "true");
    daysContainer.appendChild(div);
  }

  for (let i = 1; i <= lastDate; i++) {
    const div = document.createElement("div");
    div.textContent = i;

    const defaultClass = "h-9 w-9 rounded-md flex items-center justify-center transition-colors";
    div.className = defaultClass;

    const cellDate = new Date(year, month, i);
    cellDate.setHours(0, 0, 0, 0);

    const isToday = cellDate.getTime() === today.getTime();
    const isPast = cellDate < today;
    const isSunday = cellDate.getDay() === 0;

    if (isToday) {
      div.classList.add("font-bold", "text-black");
    }

    if (isPast || isSunday) {
      // 🔒 Disable past dates or Sundays
      div.classList.add("text-gray-400", "cursor-not-allowed", "opacity-50");
      div.setAttribute("disabled", "true");
    } else {
      div.classList.add("hover:text-medical-600", "hover:bg-medical-50", "pointer");

      div.addEventListener("click", () => {
        if (selectedDay === div) {
          div.className = defaultClass + "hover:text-medical-600 hover:bg-medical-50 pointer";
          if (isToday) div.classList.add("font-bold", "text-black");
          selectedDay = null;
          selectedDateValue.textContent = "Pick a date";
        } else {
          if (selectedDay) {
            const prevText = selectedDay.textContent;
            selectedDay.className = defaultClass + "hover:text-medical-600 hover:bg-medical-50 pointer";
            const wasToday = +prevText === today.getDate() && month === today.getMonth() && year === today.getFullYear();
            if (wasToday) selectedDay.classList.add("font-bold", "text-black");
          }

          div.className = "h-9 w-9 rounded-md bg-medical-600 text-white pointer flex items-center justify-center transition-colors";
          selectedDay = div;

          const dateWithSuffix = `${cellDate.toLocaleString("en-US", {
            month: "long",
          })} ${addOrdinalSuffix(cellDate.getDate())}, ${cellDate.getFullYear()}`;

          selectedDateValue.textContent = dateWithSuffix;
        }
      });
    }

    daysContainer.appendChild(div);
  }
}

prevBtn.addEventListener("click", () => {
  date.setMonth(date.getMonth() - 1);
  selectedDay = null;
  selectedDateValue.textContent = "Pick a date";
  renderCalendar();
});

nextBtn.addEventListener("click", () => {
  date.setMonth(date.getMonth() + 1);
  selectedDay = null;
  selectedDateValue.textContent = "Pick a date";
  renderCalendar();
});

renderCalendar();
