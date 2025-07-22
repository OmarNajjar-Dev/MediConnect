export async function submitAppointment() {
  const selectedValues = document.querySelectorAll(".selected-value");
  const specialty = selectedValues[0]?.textContent.trim();
  const doctorText = selectedValues[1]?.textContent.trim(); // اسم الطبيب المعروض
  const date = selectedValues[2]?.textContent.trim();
  const time = selectedValues[3]?.textContent.trim();
  const reason = document.getElementById("reason").value.trim();
  const notes = document.getElementById("notes").value.trim();

  // ✅ استخراج doctor_id من الزر المختار في قائمة الأطباء
  let doctor = null;
  const doctorOptions = document.querySelectorAll("ul li button.select-btn");
  doctorOptions.forEach((btn) => {
    if (btn.textContent.trim() === doctorText) {
      doctor = btn.getAttribute("data-id");
    }
  });

  if (!doctor) {
    alert("Doctor ID not found. Please select a valid doctor.");
    return;
  }

  try {
    const response = await fetch("backend/api/appointments/create.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ specialty, doctor, date, time, reason, notes }),
    });

    const result = await response.json();

    if (result.success) {
      alert("✅ Appointment created successfully!");
      // يمكنك إعادة تعيين النموذج أو عمل redirect هنا
    } else {
      alert("❌ Error: " + result.message);
    }
  } catch (error) {
    alert("❌ An unexpected error occurred. " + error.message);
  }
}
