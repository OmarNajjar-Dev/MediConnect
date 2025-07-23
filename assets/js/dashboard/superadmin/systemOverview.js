class SystemOverview {
  constructor() {
    this.stats = {
      totalUsers: 0,
      totalHospitals: 0,
      totalDoctors: 0,
      totalBeds: 0,
      availableBeds: 0,
    };
    this.init();
  }

  async init() {
    await this.loadSystemStats();
    this.setupRefreshInterval();
  }

  async loadSystemStats() {
    try {
      // Load all statistics in parallel
      await Promise.all([
        this.loadUserStats(),
        this.loadHospitalStats(),
        this.loadDoctorStats(),
        this.loadBedStats(),
      ]);

      this.updateStatsDisplay();
    } catch (error) {
      console.error("Error loading system stats:", error);
    }
  }

  async loadUserStats() {
    try {
      const response = await fetch("/mediconnect/backend/api/users/get-users.php");
      const data = await response.json();

      if (data.success) {
        this.stats.totalUsers = data.users.length;
      }
    } catch (error) {
      console.error("Error loading user stats:", error);
    }
  }

  async loadHospitalStats() {
    try {
      const response = await fetch(
        "/mediconnect/backend/api/hospitals/get-hospitals.php"
      );
      const data = await response.json();

      // Handle both old format (direct array) and new format (with success property)
      let hospitals = [];
      if (data.success && data.hospitals) {
        hospitals = data.hospitals;
      } else if (Array.isArray(data)) {
        hospitals = data;
      }

      this.stats.totalHospitals = hospitals.length;

      // Calculate total and available beds
      this.stats.totalBeds = hospitals.reduce((total, hospital) => {
        return total + (parseInt(hospital.available_beds) || 0);
      }, 0);

      // For demo purposes, assume 70% occupancy
      this.stats.availableBeds = Math.floor(this.stats.totalBeds * 0.3);
    } catch (error) {
      console.error("Error loading hospital stats:", error);
    }
  }

  async loadDoctorStats() {
    try {
      const response = await fetch("/mediconnect/backend/api/doctors/get-doctors.php");
      const data = await response.json();

      if (data.success) {
        this.stats.totalDoctors = data.doctors.length;
      }
    } catch (error) {
      console.error("Error loading doctor stats:", error);
    }
  }

  async loadBedStats() {
    // This is already handled in loadHospitalStats
    // but kept as separate method for potential future expansion
  }

  updateStatsDisplay() {
    // Update total users
    const totalUsersElement = document.querySelector(
      '[data-section="system-overview"] .text-2xl.font-bold.text-gray-900'
    );
    if (totalUsersElement) {
      totalUsersElement.textContent = this.stats.totalUsers;
    }

    // Update stats cards
    const statsCards = document.querySelectorAll(
      '[data-section="system-overview"] .glass-card'
    );

    statsCards.forEach((card, index) => {
      const valueElement = card.querySelector(
        ".text-2xl.font-bold.text-gray-900"
      );
      const subTextElement = card.querySelector(
        ".text-xs.text-muted-foreground"
      );

      if (!valueElement) return;

      switch (index) {
        case 0: // Total Users
          valueElement.textContent = this.stats.totalUsers;
          if (subTextElement) {
            subTextElement.textContent = `${this.stats.totalUsers} active`;
          }
          break;
        case 1: // Hospitals
          valueElement.textContent = this.stats.totalHospitals;
          if (subTextElement) {
            subTextElement.textContent = `${this.stats.totalHospitals} active`;
          }
          break;
        case 2: // Doctors
          valueElement.textContent = this.stats.totalDoctors;
          if (subTextElement) {
            subTextElement.textContent = `${this.stats.totalDoctors} active`;
          }
          break;
        case 3: // Total Beds
          valueElement.textContent = this.stats.totalBeds;
          if (subTextElement) {
            subTextElement.textContent = `${this.stats.availableBeds} available`;
          }
          break;
      }
    });
  }

  setupRefreshInterval() {
    // Refresh stats every 5 minutes
    setInterval(() => {
      this.loadSystemStats();
    }, 5 * 60 * 1000);
  }

  // Method to manually refresh stats
  async refreshStats() {
    await this.loadSystemStats();
  }
}

// Initialize and export
const systemOverview = new SystemOverview();
window.systemOverview = systemOverview;

export default systemOverview;
