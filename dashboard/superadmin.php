<?php

require_once '../backend/auth.php'; // handles autologin via cookie

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Meta Tags -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="../css/base.css" />
  <link rel="stylesheet" href="../css/colors.css" />
  <link rel="stylesheet" href="../css/typography.css" />
  <link rel="stylesheet" href="../css/spacing.min.css" />
  <link rel="stylesheet" href="../css/sizing.min.css" />
  <link rel="stylesheet" href="../css/borders.css" />
  <link rel="stylesheet" href="../css/layout.css" />
  <link rel="stylesheet" href="../css/animations.css" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/responsive.css" />

  <!-- Page Title -->
  <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

  <!-- Header Section -->
  <header class="fixed z-50 py-5 bg-transparent transition-all">
    <div class="container mx-auto flex items-center justify-between px-4">
      <a href="./" class="flex items-center">
        <span class="text-medical-700 text-2xl font-semibold">
          Medi<span class="text-medical-500">Connect</span>
        </span>
      </a>

      <!-- Desktop Navigation -->
      <nav class="hidden md:flex items-center gap-4 lg:gap-8">
        <a href="./" class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Home</a>
        <a href="./doctors.php"
          class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Doctors</a>
        <a href="./hospitals.php"
          class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Hospitals</a>
        <a href="./appointments.php"
          class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Appointments</a>
        <a href="././dashboard/superadmin.php"
          class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Dashboard</a>
      </nav>

      <!-- Header Right Section -->
      <div class="flex items-center gap-4">
        <!-- Sign In / Sign Up buttons (hidden by default) -->
        <a href="./login.php"
          class="hidden md:flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all">Sign
          In</a>
        <a href="./register.php"
          class="hidden md:flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all">Sign
          Up</a>

        <!-- Mobile Menu Button -->
        <button id="menu-button"
          class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none pointer">
          <i data-lucide="menu" class="w-4 h-4"></i>
        </button>
      </div>

      <!-- Mobile Navigation (Hidden by default) -->
      <div id="mobile-nav" class="hidden absolute bg-white-95 backdrop-blur-lg animate-slide-down shadow-lg">
        <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
          <a href="./"
            class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
          <a href="./doctors.php"
            class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
          <a href="./hospitals.php"
            class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
          <a href="./appointments.php"
            class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>
          <a href="././dashboard/superadmin.php"
            class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Dashboard</a>

          <!-- Sign In / Sign Up buttons (Mobile view) -->
          <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
            <a href="./login.php"
              class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign
              In</a>
            <a href="./register.php"
              class="inline-flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign
              Up</a>
          </div>
        </nav>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="min-h-screen pt-20 pb-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="py-8">

        <!-- Header Section -->
        <div class="mb-8 flex flex-col">
          <p class="mb-1 text-sm text-gray-600">
            Logged in as: <span class="font-medium">SUPER ADMIN</span>
          </p>
          <h1 class="text-2xl font-bold tracking-tight text-gray-900">
            Welcome back, System Administrator
          </h1>
        </div>

        <!-- Inner Content -->
        <div class="min-h-screen bg-gray-50">
          <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            <!-- Title & Subtitle -->
            <div class="mb-8">
              <div class="mb-2 flex items-center gap-3">
                <i data-lucide="shield" class="h-8 w-8 text-blue-600"></i>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                  Super Admin Control Panel
                </h1>
              </div>
              <p class="text-gray-600">
                Welcome, Super Admin. Manage all system entities and monitor platform health.
              </p>
            </div>

            <!-- Navigation Tabs -->
            <div class="flex flex-col gap-6">
              <div class="grid h-10 w-full grid-cols-3 items-center justify-center rounded-md border border-solid border-card-soft bg-white p-1 text-muted-foreground outline-none lg:grid-cols-6 pointer">

                <button
                  type="button"
                  data-target="overview"
                  class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-transparent bg-blue-50 px-3 py-1.5 text-sm font-medium text-blue-700 transition-all pointer">
                  Overview
                </button>

                <button
                  type="button"
                  data-target="hospitals"
                  class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-transparent px-3 py-1.5 text-sm font-medium transition-all pointer">
                  Hospitals
                </button>

                <button
                  type="button"
                  data-target="admins"
                  class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-transparent px-3 py-1.5 text-sm font-medium transition-all pointer">
                  Admins
                </button>

                <button
                  type="button"
                  data-target="doctors"
                  class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-transparent px-3 py-1.5 text-sm font-medium transition-all pointer">
                  Doctors
                </button>

                <button
                  type="button"
                  data-target="patients"
                  class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-transparent px-3 py-1.5 text-sm font-medium transition-all pointer">
                  Patients
                </button>

                <button
                  type="button"
                  data-target="staff-ambulance"
                  class="inline-flex items-center justify-center whitespace-nowrap rounded-sm border-none bg-transparent px-3 py-1.5 text-sm font-medium transition-all pointer">
                  Staff &amp; Teams
                </button>

              </div>

              <!-- Overview -->
              <div data-section="overview" class="flex flex-col gap-6 mt-2 outline-none">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">

                  <div class="rounded-lg bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-600">Total Hospitals</p>
                          <p class="mt-2 text-3xl font-bold text-gray-900">3</p>
                        </div>
                        <div class="flex justify-center items-center rounded-full bg-blue-50 p-3">
                          <i data-lucide="building2" class="h-6 w-6 text-blue-600"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="rounded-lg bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-600">Total Users</p>
                          <p class="mt-2 text-3xl font-bold text-gray-900">5</p>
                        </div>
                        <div class="flex justify-center items-center rounded-full bg-green-50 p-3">
                          <i data-lucide="users" class="h-6 w-6 text-green-600"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="rounded-lg bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-600">Active Doctors</p>
                          <p class="mt-2 text-3xl font-bold text-gray-900">1</p>
                        </div>
                        <div class="flex justify-center items-center rounded-full bg-purple-50 p-3">
                          <i data-lucide="user-check" class="h-6 w-6 text-purple-600"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="rounded-lg bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                      <div class="flex items-center justify-between">
                        <div>
                          <p class="text-sm font-medium text-gray-600">Available Beds</p>
                          <p class="mt-2 text-3xl font-bold text-gray-900">135</p>
                        </div>
                        <div class="flex justify-center items-center rounded-full bg-orange-50 p-3">
                          <i data-lucide="activity" class="h-6 w-6 text-orange-600"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                  <div class="rounded-lg bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                      <h3 class="mb-4 text-lg font-semibold text-gray-800">Recent Activity</h3>
                      <div class="flex flex-col gap-3">
                        <div class="flex items-center justify-between border-b border-solid border-gray-100 py-2">
                          <span class="text-sm text-gray-600">New hospital registered</span>
                          <span class="text-xs text-gray-400">2 hours ago</span>
                        </div>
                        <div class="flex items-center justify-between border-b border-solid border-gray-100 py-2">
                          <span class="text-sm text-gray-600">Doctor profile updated</span>
                          <span class="text-xs text-gray-400">4 hours ago</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                          <span class="text-sm text-gray-600">Patient registered</span>
                          <span class="text-xs text-gray-400">6 hours ago</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="rounded-lg bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                      <h3 class="mb-4 text-lg font-semibold text-gray-800">System Health</h3>
                      <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                          <span class="text-sm text-gray-600">Platform Uptime</span>
                          <span class="text-sm font-medium text-green-600">99.9%</span>
                        </div>
                        <div class="flex items-center justify-between">
                          <span class="text-sm text-gray-600">Active Hospitals</span>
                          <span class="text-sm font-medium text-blue-600">2</span>
                        </div>
                        <div class="flex items-center justify-between">
                          <span class="text-sm text-gray-600">Active Users</span>
                          <span class="text-sm font-medium text-purple-600">5</span>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <!-- Hospitals -->
              <div data-section="hospitals" class="hidden rounded-lg bg-card text-card-foreground shadow-sm">
                <div class="p-6">
                  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                      <div class="text-blue-600">
                        <i data-lucide="building2" class="h-6 w-6"></i>
                      </div>
                      <div>
                        <h2 class="text-2xl font-bold text-gray-800">Hospital Management</h2>
                        <p class="mt-1 text-gray-600">Manage all hospitals in the system</p>
                      </div>
                    </div>
                    <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 h-10 pointer whitespace-nowrap">
                      <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                      Add Hospital
                    </button>
                  </div>

                  <div class="overflow-x-auto rounded-lg border border-solid border-card-soft bg-white">
                    <div class="relative w-full overflow-auto">
                      <table class="w-full border-collapse text-sm">
                        <thead class="border-b border-solid border-card-soft">
                          <tr class="bg-gray-50 transition-colors hover:bg-muted/50">
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Hospital Name</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Location</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Phone</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Total Beds</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Available Beds</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Status</th>
                            <th class="h-12 px-4 text-right align-middle font-semibold text-gray-700">Actions</th>
                          </tr>
                        </thead>

                        <tbody class="table-no-border-last">

                          <!-- Row 1 -->
                          <tr class="border-b border-solid border-card-soft transition-colors hover:bg-gray-50">
                            <td class="p-4 py-4 align-middle">Central Medical Center</td>
                            <td class="p-4 py-4 align-middle">123 Medical Blvd, Central City</td>
                            <td class="p-4 py-4 align-middle">+1 (555) 123-4567</td>
                            <td class="p-4 py-4 align-middle">200</td>
                            <td class="p-4 py-4 align-middle">45</td>
                            <td class="p-4 py-4 align-middle">
                              <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-medical-500 px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                active
                              </div>
                            </td>
                            <td class="p-4 py-4 text-right align-middle">
                              <div class="flex justify-end gap-2">
                                <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-blue-600 transition-colors hover:bg-blue-50 hover:text-blue-800 h-9 pointer whitespace-nowrap">
                                  <i data-lucide="square-pen" class="h-4 w-4"></i>
                                </button>
                                <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800 h-9 pointer whitespace-nowrap">
                                  <i data-lucide="trash2" class="h-4 w-4"></i>
                                </button>
                              </div>
                            </td>
                          </tr>

                          <!-- Row 2 -->
                          <tr class="border-b border-solid border-card-soft transition-colors hover:bg-gray-50">
                            <td class="p-4 py-4 align-middle">Al Noor Medical Center</td>
                            <td class="p-4 py-4 align-middle">456 Healthcare Ave, North District</td>
                            <td class="p-4 py-4 align-middle">+1 (555) 987-6543</td>
                            <td class="p-4 py-4 align-middle">150</td>
                            <td class="p-4 py-4 align-middle">23</td>
                            <td class="p-4 py-4 align-middle">
                              <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-medical-500 px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                active
                              </div>
                            </td>
                            <td class="p-4 py-4 text-right align-middle">
                              <div class="flex justify-end gap-2">
                                <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-blue-600 transition-colors hover:bg-blue-50 hover:text-blue-800 h-9 pointer whitespace-nowrap">
                                  <i data-lucide="square-pen" class="h-4 w-4"></i>
                                </button>
                                <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800 h-9 pointer whitespace-nowrap">
                                  <i data-lucide="trash2" class="h-4 w-4"></i>
                                </button>
                              </div>
                            </td>
                          </tr>

                          <!-- Row 3 -->
                          <tr class="border-b border-solid border-card-soft transition-colors hover:bg-gray-50">
                            <td class="p-4 py-4 align-middle">Westside Hospital</td>
                            <td class="p-4 py-4 align-middle">789 Care Street, West Side</td>
                            <td class="p-4 py-4 align-middle">+1 (555) 456-7890</td>
                            <td class="p-4 py-4 align-middle">180</td>
                            <td class="p-4 py-4 align-middle">67</td>
                            <td class="p-4 py-4 align-middle">
                              <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-secondary px-2.5 py-0.5 text-xs font-semibold text-secondary-foreground transition-colors hover:bg-secondary/80">
                                inactive
                              </div>
                            </td>
                            <td class="p-4 py-4 text-right align-middle">
                              <div class="flex justify-end gap-2">
                                <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-blue-600 transition-colors hover:bg-blue-50 hover:text-blue-800 h-9 pointer whitespace-nowrap">
                                  <i data-lucide="square-pen" class="h-4 w-4"></i>
                                </button>
                                <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800 h-9 pointer whitespace-nowrap">
                                  <i data-lucide="trash2" class="h-4 w-4"></i>
                                </button>
                              </div>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
              </div>

              <!-- Admins -->
              <div data-section="admins" class="hidden rounded-lg bg-card text-card-foreground shadow-sm">
                <div class="p-6">
                  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                      <div class="text-blue-600">
                        <i data-lucide="user-check" class="h-6 w-6"></i>
                      </div>
                      <div>
                        <h2 class="text-2xl font-bold text-gray-800">Hospital Administrators</h2>
                        <p class="mt-1 text-gray-600">Manage hospital administrators</p>
                      </div>
                    </div>
                    <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 h-10 pointer whitespace-nowrap">
                      <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                      Add Admin
                    </button>
                  </div>

                  <div class="overflow-x-auto rounded-lg border border-solid border-card-soft bg-white">
                    <div class="relative w-full overflow-auto">
                      <table class="w-full border-collapse text-sm">
                        <thead>
                          <tr class="bg-gray-50 border-b border-solid border-card-soft transition-colors hover:bg-muted/50">
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Name</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Email</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Phone</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Role</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Hospital</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Status</th>
                            <th class="h-12 px-4 text-right align-middle font-semibold text-gray-700">Actions</th>
                          </tr>
                        </thead>

                        <tbody class="table-no-border-last">
                          <tr class="border-b border-solid border-card-soft transition-colors hover:bg-gray-50">
                            <td class="p-4 py-4 align-middle">Michael Thompson</td>
                            <td class="p-4 py-4 align-middle">michael.thompson@alnoor.com</td>
                            <td class="p-4 py-4 align-middle">+1 (555) 345-6789</td>
                            <td class="p-4 py-4 align-middle">
                              <div class="inline-flex items-center rounded-full border border-solid border-card-soft px-2.5 py-0.5 text-xs font-semibold text-foreground capitalize transition-colors">
                                hospital admin
                              </div>
                            </td>
                            <td class="p-4 py-4 align-middle">Al Noor Medical Center</td>
                            <td class="p-4 py-4 align-middle">
                              <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-medical-500 px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                active
                              </div>
                            </td>
                            <td class="p-4 py-4 text-right align-middle">
                              <div class="flex justify-end gap-2">
                                <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-blue-600 transition-colors hover:bg-blue-50 hover:text-blue-800 h-9 pointer whitespace-nowrap">
                                  <i data-lucide="square-pen" class="h-4 w-4"></i>
                                </button>
                                <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800 h-9 pointer whitespace-nowrap">
                                  <i data-lucide="trash2" class="h-4 w-4"></i>
                                </button>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
              </div>

              <!-- Doctors -->
              <div data-section="doctors" class="hidden rounded-lg bg-card text-card-foreground shadow-sm">
                <div class="p-6">
                  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                      <div class="text-blue-600">
                        <i data-lucide="user-check" class="h-6 w-6"></i>
                      </div>
                      <div>
                        <h2 class="text-2xl font-bold text-gray-800">Doctors</h2>
                        <p class="mt-1 text-gray-600">Manage all doctors in the system</p>
                      </div>
                    </div>
                    <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 h-10 pointer whitespace-nowrap">
                      <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                      Add Doctor
                    </button>
                  </div>

                  <div class="overflow-x-auto rounded-lg border border-solid border-card-soft bg-white">
                    <div class="relative w-full overflow-auto">
                      <table class="w-full border-collapse text-sm">
                        <thead>
                          <tr class="bg-gray-50 border-b border-solid border-card-soft transition-colors hover:bg-muted/50">
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Name</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Email</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Phone</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Role</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Hospital</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Status</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Specialization</th>
                            <th class="h-12 px-4 text-right align-middle font-semibold text-gray-700">Actions</th>
                          </tr>
                        </thead>

                        <tbody class="table-no-border-last">
                          <tr class="border-b border-solid border-card-soft transition-colors hover:bg-gray-50">
                            <td class="p-4 py-4 align-middle">Dr. Sarah Johnson</td>
                            <td class="p-4 py-4 align-middle">sarah.johnson@central.com</td>
                            <td class="p-4 py-4 align-middle">+1 (555) 234-5678</td>
                            <td class="p-4 py-4 align-middle">
                              <div class="inline-flex items-center rounded-full border border-solid border-card-soft px-2.5 py-0.5 text-xs font-semibold text-foreground capitalize transition-colors">
                                doctor
                              </div>
                            </td>
                            <td class="p-4 py-4 align-middle">Central Medical Center</td>
                            <td class="p-4 py-4 align-middle">
                              <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-medical-500 px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                active
                              </div>
                            </td>
                            <td class="p-4 py-4 align-middle">Interventional Cardiology</td>
                            <td class="p-4 py-4 text-right align-middle">
                              <div class="flex justify-end gap-2">
                                <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-blue-600 transition-colors hover:bg-blue-50 hover:text-blue-800 h-9 pointer whitespace-nowrap">
                                  <i data-lucide="square-pen" class="h-4 w-4"></i>
                                </button>
                                <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800 h-9 pointer whitespace-nowrap">
                                  <i data-lucide="trash2" class="h-4 w-4"></i>
                                </button>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
              </div>

              <!-- Patients -->
              <div data-section="patients" class="hidden rounded-lg bg-card text-card-foreground shadow-sm">
                <div class="p-6">
                  <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                      <div class="text-blue-600">
                        <i data-lucide="users" class="h-6 w-6"></i>
                      </div>
                      <div>
                        <h2 class="text-2xl font-bold text-gray-800">Patients</h2>
                        <p class="mt-1 text-gray-600">Manage all patients in the system</p>
                      </div>
                    </div>
                    <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 h-10 pointer whitespace-nowrap">
                      <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                      Add Patient
                    </button>
                  </div>

                  <div class="overflow-x-auto rounded-lg border border-solid border-card-soft bg-white">
                    <div class="relative w-full overflow-auto">
                      <table class="w-full border-collapse text-sm">
                        <thead class="border-b border-solid border-card-soft">
                          <tr class="bg-gray-50 transition-colors hover:bg-muted/50">
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Name</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Email</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Phone</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Role</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Hospital</th>
                            <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Status</th>
                            <th class="h-12 px-4 text-right align-middle font-semibold text-gray-700">Actions</th>
                          </tr>
                        </thead>

                        <tbody class="table-no-border-last">
                          <tr class="border-b border-solid border-card-soft transition-colors hover:bg-gray-50">
                            <td class="p-4 py-4 align-middle">Emily Davis</td>
                            <td class="p-4 py-4 align-middle">emily.davis@patient.com</td>
                            <td class="p-4 py-4 align-middle">+1 (555) 456-7890</td>
                            <td class="p-4 py-4 align-middle">
                              <div class="inline-flex items-center rounded-full border border-solid border-card-soft px-2.5 py-0.5 text-xs font-semibold text-foreground capitalize transition-colors">
                                patient
                              </div>
                            </td>
                            <td class="p-4 py-4 align-middle">Unassigned</td>
                            <td class="p-4 py-4 align-middle">
                              <div class="inline-flex items-center rounded-full border border-solid border-transparent bg-medical-500 px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                active
                              </div>
                            </td>
                            <td class="p-4 py-4 text-right align-middle">
                              <div class="flex justify-end gap-2">
                                <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-blue-600 transition-colors hover:bg-blue-50 hover:text-blue-800 h-9 pointer whitespace-nowrap">
                                  <i data-lucide="square-pen" class="h-4 w-4"></i>
                                </button>
                                <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800 h-9 pointer whitespace-nowrap">
                                  <i data-lucide="trash2" class="h-4 w-4"></i>
                                </button>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
              </div>

              <!-- Staff & Teams -->
              <div data-section="staff-ambulance" class="hidden grid gap-6">

                <!-- Staff Members -->
                <div class="rounded-lg bg-card text-card-foreground shadow-sm">
                  <div class="p-6">
                    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                      <div class="flex items-center gap-3">
                        <div class="text-blue-600">
                          <i data-lucide="users" class="h-6 w-6"></i>
                        </div>
                        <div>
                          <h2 class="text-2xl font-bold text-gray-800">Staff Members</h2>
                          <p class="mt-1 text-gray-600">Manage hospital staff</p>
                        </div>
                      </div>
                      <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 h-10 pointer whitespace-nowrap">
                        <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                        Add Staff
                      </button>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-solid border-card-soft bg-white">
                      <div class="relative w-full overflow-auto">
                        <table class="w-full border-collapse text-sm">
                          <thead class="border-b border-solid border-card-soft">
                            <tr class="bg-gray-50 border-b transition-colors hover:bg-muted/50">
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Name</th>
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Email</th>
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Phone</th>
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Role</th>
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Hospital</th>
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Status</th>
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Department</th>
                              <th class="h-12 px-4 text-right align-middle font-semibold text-gray-700">Actions</th>
                            </tr>
                          </thead>

                          <tbody class="table-no-border-last">
                            <tr class="transition-colors hover:bg-gray-50">
                              <td class="p-4 py-4 align-middle">James Wilson</td>
                              <td class="p-4 py-4 align-middle">james.wilson@central.com</td>
                              <td class="p-4 py-4 align-middle">+1 (555) 567-8901</td>
                              <td class="p-4 py-4 align-middle">
                                <div class="inline-flex items-center rounded-full border border-solid border-card-soft px-2.5 py-0.5 text-xs font-semibold text-foreground capitalize transition-colors">
                                  staff
                                </div>
                              </td>
                              <td class="p-4 py-4 align-middle">Central Medical Center</td>
                              <td class="p-4 py-4 align-middle">
                                <div class="inline-flex items-center rounded-full border border-transparent bg-medical-500 px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                  active
                                </div>
                              </td>
                              <td class="p-4 py-4 align-middle">Reception</td>
                              <td class="p-4 py-4 text-right align-middle">
                                <div class="flex justify-end gap-2">
                                  <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-blue-600 transition-colors hover:bg-blue-50 hover:text-blue-800 h-9 pointer whitespace-nowrap">
                                    <i data-lucide="square-pen" class="h-4 w-4"></i>
                                  </button>
                                  <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800 h-9 pointer whitespace-nowrap">
                                    <i data-lucide="trash2" class="h-4 w-4"></i>
                                  </button>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Ambulance Teams -->
                <div class="rounded-lg border-0 bg-card text-card-foreground shadow-sm">
                  <div class="p-6">
                    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                      <div class="flex items-center gap-3">
                        <div class="text-blue-600">
                          <i data-lucide="trash2" class="h-4 w-4"></i>
                        </div>
                        <div>
                          <h2 class="text-2xl font-bold text-gray-800">Ambulance Teams</h2>
                          <p class="mt-1 text-gray-600">Manage emergency response teams</p>
                        </div>
                      </div>
                      <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 h-10 pointer whitespace-nowrap">
                        <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                        Add Team
                      </button>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-solid border-card-soft bg-white">
                      <div class="relative w-full overflow-auto">
                        <table class="w-full border-collapse text-sm">
                          <thead class="border-b border-solid border-card-soft">
                            <tr class="bg-gray-50 transition-colors hover:bg-muted/50">
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Name</th>
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Email</th>
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Phone</th>
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Role</th>
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Hospital</th>
                              <th class="h-12 px-4 text-left align-middle font-semibold text-gray-700">Status</th>
                              <th class="h-12 px-4 text-right align-middle font-semibold text-gray-700">Actions</th>
                            </tr>
                          </thead>

                          <tbody class="table-no-border-last">
                            <tr class="border-b border-solid border-card-soft transition-colors hover:bg-gray-50">
                              <td class="p-4 py-4 align-middle">Emergency Response Team Alpha</td>
                              <td class="p-4 py-4 align-middle">team.alpha@emergency.com</td>
                              <td class="p-4 py-4 align-middle">+1 (555) 678-9012</td>
                              <td class="p-4 py-4 align-middle">
                                <div class="inline-flex items-center rounded-full border border-solid border-card-soft px-2.5 py-0.5 text-xs font-semibold text-foreground capitalize transition-colors">
                                  ambulance team
                                </div>
                              </td>
                              <td class="p-4 py-4 align-middle">Unassigned</td>
                              <td class="p-4 py-4 align-middle">
                                <div class="inline-flex items-center rounded-full border border-transparent bg-medical-500 px-2.5 py-0.5 text-xs font-semibold text-white transition-colors hover:bg-medical-400">
                                  active
                                </div>
                              </td>
                              <td class="p-4 py-4 text-right align-middle">
                                <div class="flex justify-end gap-2">
                                  <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-blue-600 transition-colors hover:bg-blue-50 hover:text-blue-800 h-9 pointer whitespace-nowrap">
                                    <i data-lucide="square-pen" class="h-4 w-4"></i>
                                  </button>
                                  <button class="inline-flex items-center justify-center gap-2 rounded-md border-none bg-transparent px-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-800 h-9 pointer whitespace-nowrap">
                                    <i data-lucide="trash2" class="h-4 w-4"></i>
                                  </button>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-50 pt-16 pb-8 border-t border-solid separator">
    <div class="container mx-auto px-4">
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <div>
          <a href="./" class="inline-block mb-4">
            <span class="text-medical-700 font-semibold text-2xl">
              Medi<span class="text-medical-500">Connect</span>
            </span>
          </a>
          <p class="text-gray-600 leading-relaxed mb-4">
            Connecting patients with healthcare professionals for better care
            and outcomes.
          </p>
          <div class="footer-socials flex gap-4 transition-all">
            <a href="#"
              class="text-gray-500 hover:text-medical-600 hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
              <i data-lucide="facebook" class="h-4 w-4"></i>
            </a>

            <a href="#"
              class="text-gray-500 hover:text-medical-600 hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
              <i data-lucide="twitter" class="h-4 w-4"></i>
            </a>
            <a href="#"
              class="text-gray-500 hover:text-medical-600 hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
              <i data-lucide="instagram" class="h-4 w-4"></i>
            </a>
          </div>
        </div>

        <div>
          <h4 class="font-medium text-lg text-heading tracking-tight mb-4">
            Services
          </h4>
          <ul class="flex flex-col gap-2">
            <li>
              <a href="./appointments.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                Book Appointments
              </a>
            </li>
            <li>
              <a href="./doctors.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                Find Doctors
              </a>
            </li>
            <li>
              <a href="./hospitals.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                Hospital Information
              </a>
            </li>
            <li>
              <a href="./emergency.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                Emergency Services
              </a>
            </li>
          </ul>
        </div>

        <div>
          <h4 class="font-medium text-lg text-heading tracking-tight mb-4">
            Quick Links
          </h4>
          <ul class="flex flex-col gap-2">
            <li>
              <a href="./about.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                About Us
              </a>
            </li>
            <li>
              <a href="./privacy.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                Privacy Policy
              </a>
            </li>
            <li>
              <a href="./terms.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                Terms of Service
              </a>
            </li>
            <li>
              <a href="./faq.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                FAQs
              </a>
            </li>
            <li>
              <a href="./contact.php" class="text-gray-600 hover:text-medical-600 transition-colors">
                Contact Us
              </a>
            </li>
          </ul>
        </div>

        <div>
          <h4 class="font-medium text-lg text-heading tracking-tight mb-4">
            Contact
          </h4>
          <ul class="flex flex-col gap-3">
            <li class="flex gap-1">
              <i data-lucide="map-pin" class="h-7 w-7 text-medical-500 pr-2"></i>
              <span class="text-gray-600">
                123 Healthcare Avenue, Medical District, City, Country
              </span>
            </li>
            <li class="flex items-center gap-3">
              <i data-lucide="phone" class="h-4 w-4 text-medical-500"></i>
              <span class="text-gray-600">+1 (555) 123-4567</span>
            </li>
            <li class="flex items-center gap-3">
              <i data-lucide="mail" class="h-4 w-4 text-medical-500"></i>
              <span class="text-gray-600">contact@mediconnect.example</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="pt-8 border-t border-solid separator text-center text-gray-600 text-sm">
        <p>&copy; 2025 MediConnect. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- External JavaScript -->
  <script type="module" src="../js/common/index.js"></script>
  <script type="module" src="../js/dashboard/superadmin/index.js"></script>

  <!-- Create Lucide Icons -->
  <script>
    lucide.createIcons()
  </script>

</body>

</html>