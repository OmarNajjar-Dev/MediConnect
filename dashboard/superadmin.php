<?php

// 4. Define required role for this dashboard
$requiredRole = 'super_admin';

// 5. Protect the dashboard: redirect if user role does not match
require_once __DIR__ . "/../backend/middleware/protect-dashboard.php";

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
  <link rel="stylesheet" href="/mediconnect/css/base.css" />
  <link rel="stylesheet" href="/mediconnect/css/colors.css" />
  <link rel="stylesheet" href="/mediconnect/css/typography.css" />
  <link rel="stylesheet" href="/mediconnect/css/spacing.min.css" />
  <link rel="stylesheet" href="/mediconnect/css/sizing.min.css" />
  <link rel="stylesheet" href="/mediconnect/css/borders.css" />
  <link rel="stylesheet" href="/mediconnect/css/ring.css" />
  <link rel="stylesheet" href="/mediconnect/css/layout.css" />
  <link rel="stylesheet" href="/mediconnect/css/animations.css" />
  <link rel="stylesheet" href="/mediconnect/css/style.css" />
  <link rel="stylesheet" href="/mediconnect/css/responsive.css" />
  <link rel="stylesheet" href="/mediconnect/css/dashboard.css">

  <!-- Page Title -->
  <title>MediConnect - Bridging Healthcare & Technology</title>

</head>

<body class="bg-background">

  <!-- ==================== Header ==================== -->

  <header class="fixed z-50 py-5 bg-transparent transition-all">
    <div class="container mx-auto flex items-center justify-between px-4">

      <!-- Logo -->
      <a href="<?= $paths['home'] ?>" class="flex items-center">
        <span class="text-medical-700 text-2xl font-semibold">
          Medi<span class="text-medical-500">Connect</span>
        </span>
      </a>

      <!-- Desktop Navigation (hidden on mobile) -->
      <nav class="hidden md:flex items-center gap-4 lg:gap-8 xl:ml-28">
        <a href="<?= $paths['home'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Home</a>
        <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Doctors</a>
        <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Hospitals</a>
        <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 text-sm lg:text-base font-medium hover:text-medical-600 transition-colors">Appointments</a>
      </nav>

      <!-- Right section: Emergency / Auth / Dropdown / Menu -->
      <div class="flex items-center gap-4">

        <!-- Emergency button (always visible) -->
        <a href="<?= $paths['services']['emergency'] ?>" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm lg:text-base font-medium px-2 lg:px-4 py-2 md:py-3 lg:ml-2 rounded-lg transition-colors transition-200">
          <i data-lucide="ambulance" class="w-4 h-4"></i>
          Emergency
        </a>

        <!-- User dropdown (visible if logged in) -->
        <div class="hidden md:flex items-center gap-3 md:order-last">
          <div class="dropdown relative">
            <button class="flex items-center gap-2 md:py-2 px-2 border-none bg-transparent hover:bg-medical-50 transition-colors transition-200 pointer rounded-lg">
              <div class="w-8 h-8 rounded-full bg-medical-100 flex items-center justify-center text-medical-700 text-sm lg:text-base font-medium">
                <?= strtoupper(substr($userName, 0, 2)) ?>
              </div>
              <span class="hidden lg:block text-sm lg:text-base font-medium slate-700 max-w-24 truncate">
                <?= htmlspecialchars($userName) ?>
              </span>
              <i data-lucide="chevron-down" class="w-4 h-4 slate-500"></i>
            </button>

            <!-- Dropdown menu content -->
            <div class="dropdown-content overflow-hidden hidden animate-fade-in absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-solid border-gray-100 z-50">
              <div class="px-3 py-2 border-b border-solid border-medical-100">
                <p class="text-sm font-medium slate-700"><?= htmlspecialchars($userName) ?></p>
                <p class="text-xs slate-500"><?= htmlspecialchars($userEmail) ?></p>
              </div>

              <a href="#" class="flex items-center gap-2 px-3 py-2 text-sm slate-600 hover:text-medical-600 hover:bg-medical-50 transition-colors transition-200">
                <i data-lucide="user" class="w-4 h-4"></i>Dashboard
              </a>

              <a href="<?= $paths['auth']['logout'] ?>" class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 w-full transition-colors transition-200">
                <i data-lucide="log-out" class="w-4 h-4"></i>Sign Out
              </a>
            </div>
          </div>
        </div>

        <!-- Mobile menu toggle button -->
        <button id="menu-button" class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none pointer">
          <i data-lucide="menu" class="w-4 h-4"></i>
        </button>
      </div>

      <!-- Mobile Navigation Panel (visible only on mobile) -->
      <div id="mobile-nav" class="hidden absolute bg-white/95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
        <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
          <a href="<?= $paths['home'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
          <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
          <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
          <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>

          <div class="flex flex-col pt-2 gap-2 bg-transparent border-t border-solid separator">
            <a href="#" class="inline-flex items-center gap-2 justify-start text-gray-700 hover:bg-medical-50 hover:text-medical-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
              <i data-lucide="user" class="w-4 h-4"></i> Dashboard
            </a>
            <a href="<?= $paths['auth']['logout'] ?>" class="inline-flex items-center gap-2 justify-start text-red-600 hover:bg-red-50 hover:text-red-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
              <i data-lucide="log-out" class="w-4 h-4"></i> Sign Out
            </a>
          </div>
        </nav>
      </div>

    </div>
  </header>


  <!-- ==================== Main Content ==================== -->

  <main class="pt-20 pb-16 min-h-screen bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="py-8">
        <div class="flex flex-col gap-6">

          <!-- Access Info Card -->
          <div class="rounded-lg shadow-sm border-2 border-solid border-red-200 bg-red-100 text-red-800">
            <div class="flex flex-col gap-1.5 p-6 pb-3">
              <div class="flex items-center gap-3">
                <i data-lucide="shield" class="h-6 w-6"></i>
                <div class="flex-grow">
                  <div class="flex items-center gap-2 mb-1">
                    <h3 class="text-lg font-semibold tracking-tight">Super Administrator</h3>
                    <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold text-foreground">
                      SUPER ADMIN
                    </div>
                  </div>
                  <p class="text-sm text-muted-foreground">
                    Full access to all hospitals, doctors, and administrative functions
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Dashboard Section -->
          <div class="min-h-screen bg-gray-50">
            <div class="flex flex-col gap-6 p-4 sm:p-6">

              <!-- Header -->
              <div class="flex items-center gap-3">
                <i data-lucide="shield" class="h-6 w-6 text-medical-600"></i>
                <div>
                  <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Super Admin Dashboard</h1>
                  <p class="text-sm sm:text-base text-muted-foreground">
                    Full system access - Manage all hospitals, users, and system settings
                  </p>
                </div>
              </div>

              <!-- Navigation Tabs -->
              <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 bg-muted text-muted-foreground rounded-md p-1">
                <button type="button" data-target="system-overview"
                  class="inline-flex items-center justify-center px-2 py-3 text-xs sm:text-sm font-medium rounded-sm border border-transparent transition-all pointer bg-blue-50 text-blue-700">
                  System Overview
                </button>
                <button type="button" data-target="my-profile"
                  class="inline-flex items-center justify-center px-2 py-3 text-xs sm:text-sm font-medium rounded-sm border border-transparent transition-all pointer">
                  My Profile
                </button>
                <button type="button" data-target="manage-users"
                  class="inline-flex items-center justify-center px-2 py-3 text-xs sm:text-sm font-medium rounded-sm border border-transparent transition-all pointer">
                  Manage Users
                </button>
                <button type="button" data-target="manage-hospitals"
                  class="inline-flex items-center justify-center px-2 py-3 text-xs sm:text-sm font-medium rounded-sm border border-transparent transition-all pointer">
                  Manage Hospitals
                </button>
              </div>

              <!-- System Overview Section -->
              <div data-section="system-overview" class="mt-2 flex flex-col gap-6">

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                  <!-- Total Users -->
                  <div class="glass-card border-card-soft hover:shadow-md transition-shadow rounded-lg text-card-foreground">
                    <div class="flex items-center justify-between p-6 pb-2">
                      <h3 class="text-sm font-medium text-gray-700 tracking-tight">Total Users</h3>
                      <i data-lucide="users" class="h-4 w-4 text-blue-600"></i>
                    </div>
                    <div class="px-6 pt-0 pb-6">
                      <div class="text-2xl font-bold text-gray-900">3</div>
                      <p class="text-xs text-muted-foreground mt-1">3 active</p>
                    </div>
                  </div>

                  <!-- Hospitals -->
                  <div class="glass-card border-card-soft hover:shadow-md transition-shadow rounded-lg text-card-foreground">
                    <div class="flex items-center justify-between p-6 pb-2">
                      <h3 class="text-sm font-medium text-gray-700 tracking-tight">Hospitals</h3>
                      <i data-lucide="building-2" class="h-4 w-4 text-green-600"></i>
                    </div>
                    <div class="px-6 pt-0 pb-6">
                      <div class="text-2xl font-bold text-gray-900">2</div>
                      <p class="text-xs text-muted-foreground mt-1">2 active</p>
                    </div>
                  </div>

                  <!-- Doctors -->
                  <div class="glass-card border-card-soft hover:shadow-md transition-shadow rounded-lg text-card-foreground">
                    <div class="flex items-center justify-between p-6 pb-2">
                      <h3 class="text-sm font-medium text-gray-700 tracking-tight">Doctors</h3>
                      <i data-lucide="user-check" class="h-4 w-4 text-purple-600"></i>
                    </div>
                    <div class="px-6 pt-0 pb-6">
                      <div class="text-2xl font-bold text-gray-900">1</div>
                      <p class="text-xs text-muted-foreground mt-1">1 active</p>
                    </div>
                  </div>

                  <!-- Total Beds -->
                  <div class="glass-card border-card-soft hover:shadow-md transition-shadow rounded-lg text-card-foreground">
                    <div class="flex items-center justify-between p-6 pb-2">
                      <h3 class="text-sm font-medium text-gray-700 tracking-tight">Total Beds</h3>
                      <i data-lucide="shield" class="h-6 w-6 text-orange-600"></i>
                    </div>
                    <div class="px-6 pt-0 pb-6">
                      <div class="text-2xl font-bold text-gray-900">350</div>
                      <p class="text-xs text-muted-foreground mt-1">68 available</p>
                    </div>
                  </div>
                </div>

                <!-- Welcome Card -->
                <div class="rounded-lg shadow-sm bg-medical-50 border border-solid border-medical-200 text-card-foreground">
                  <div class="flex flex-col gap-1.5 p-6">
                    <h3 class="text-2xl font-semibold tracking-tight text-medical-800">
                      Welcome to MediConnect Super Admin
                    </h3>
                    <p class="text-sm text-medical-600">
                      Monitor and manage the entire healthcare platform from this centralized dashboard.
                    </p>
                  </div>
                  <div class="px-6 pt-0 pb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                      <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span>System Status: Online</span>
                      </div>
                      <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <span>Database: Connected</span>
                      </div>
                      <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                        <span>Security: Active</span>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <!-- My Profile -->
              <div data-section="my-profile" class="hidden mt-2">
                <div class="flex flex-col gap-6">

                  <!-- Section Title -->
                  <div class="flex items-center gap-3">
                    <i data-lucide="user" class="h-6 w-6 text-medical-600"></i>
                    <div>
                      <h2 class="text-2xl font-bold text-gray-900">My Profile</h2>
                      <p class="text-muted-foreground">Manage your personal information and security settings</p>
                    </div>
                  </div>

                  <!-- Profile Picture & Personal Info -->
                  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- Profile Picture Upload -->
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                      <div class="flex flex-col gap-1.5 p-6">
                        <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center gap-2">
                          <i data-lucide="camera" class="h-5 w-5"></i>
                          Profile Picture
                        </h3>
                        <p class="text-sm text-muted-foreground">Update your profile image</p>
                      </div>
                      <div class="px-6 pb-6 flex flex-col gap-4">
                        <div class="flex flex-col gap-4 items-center">
                          <span class="relative flex shrink-0 overflow-hidden rounded-full w-24 h-24">
                            <span class="flex h-full w-full items-center justify-center rounded-full text-lg bg-medical-100 text-medical-700">
                              <?= strtoupper(substr($userName, 0, 2)) ?>
                            </span>
                          </span>
                          <div class="w-full">
                            <label for="profile-upload" class="text-sm font-medium leading-none pointer">
                              <div id="new-image-profile" class="flex items-center justify-center w-full p-3 border-2 border-dashed border-gray-300 rounded-lg hover:border-medical-400 transition-colors">
                                <div class="flex flex-col text-center">
                                  <i data-lucide="camera" class="mx-auto h-6 w-6 text-gray-400 mb-2"></i>
                                  <span class="text-sm text-gray-600">Upload new image</span>
                                </div>
                              </div>
                            </label>
                            <input type="file" id="profile-upload" accept="image/*" class="hidden">
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="rounded-lg glass-card text-card-foreground lg:col-span-2">
                      <div class="flex flex-col gap-1.5 p-6">
                        <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center gap-2">
                          <i data-lucide="user" class="h-5 w-5"></i>
                          Personal Information
                        </h3>
                        <p class="text-sm text-muted-foreground">Update your basic information</p>
                      </div>
                      <div class="px-6 pb-6 flex flex-col gap-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                          <div class="flex flex-col gap-2">
                            <label for="admin-name" class="text-sm font-medium leading-none">Full Name</label>
                            <input id="admin-name" placeholder="Enter your full name" value="System Administrator"
                              class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                          </div>
                          <div class="flex flex-col gap-2">
                            <label for="admin-email" class="text-sm font-medium leading-none">Email Address</label>
                            <input type="email" id="admin-email" placeholder="Enter your email" value="admin@mediconnect.com"
                              class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                  <!-- Change Password Section -->
                  <div class="rounded-lg glass-card text-card-foreground">
                    <div class="flex flex-col gap-1.5 p-6">
                      <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center gap-2">
                        <i data-lucide="lock" class="h-5 w-5"></i>
                        Change Password
                      </h3>
                      <p class="text-sm text-muted-foreground">Update your account password for security</p>
                    </div>
                    <div class="flex flex-col gap-4 px-6 pb-6">
                      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="flex flex-col gap-2">
                          <label for="current-password" class="text-sm font-medium leading-none">Current Password</label>
                          <input type="password" id="current-password" placeholder="Enter current password"
                            class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                        </div>
                        <div class="flex flex-col gap-2">
                          <label for="new-password" class="text-sm font-medium leading-none">New Password</label>
                          <input type="password" id="new-password" placeholder="Enter new password"
                            class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                        </div>
                        <div class="flex flex-col gap-2">
                          <label for="confirm-password" class="text-sm font-medium leading-none">Confirm Password</label>
                          <input type="password" id="confirm-password" placeholder="Confirm new password"
                            class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white">
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Save Button -->
                  <div class="flex justify-end">
                    <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors border border-solid border-transparent h-10 py-2 bg-medical-600 hover:bg-medical-700 text-white px-6 pointer">
                      <i data-lucide="save" class="h-4 w-4 mr-2"></i>
                      Save Changes
                    </button>
                  </div>

                </div>
              </div>

              <!-- Manage Users -->
              <div data-section="manage-users" class="hidden mt-2">
                <div class="flex flex-col gap-4 sm:gap-6">

                  <!-- Section Header -->
                  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-3">
                      <i data-lucide="users" class="h-6 w-6 text-medical-600"></i>
                      <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">User Management</h2>
                        <p class="text-sm text-muted-foreground">Manage all system users and their roles</p>
                      </div>
                    </div>
                    <button type="button" data-modal-trigger class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors text-white h-10 px-4 py-2 bg-medical-600 hover:bg-medical-700 pointer border border-solid border-transparent">
                      <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                      Add User
                    </button>
                  </div>

                  <!-- Filters Section -->
                  <div class="rounded-lg glass-card text-card-foreground">
                    <div class="p-4">
                      <div class="flex flex-col sm:flex-row gap-4">

                        <!-- Search Field -->
                        <div class="relative flex-grow">
                          <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 h-4 w-4"></i>
                          <input class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm pl-10 focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white" placeholder="Search users by name or email..." value="">
                        </div>

                        <!-- Role Filter -->
                        <div class="flex items-center gap-2">
                          <i data-lucide="filter" class="h-4 w-4 text-gray-500"></i>
                          <button type="button" role="combobox" class="flex h-10 items-center justify-between rounded-md border border-solid border-input bg-background px-3 py-2 text-sm w-full sm:w-48 focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white pointer">
                            <span style="pointer-events: none;">All Roles</span>
                            <i data-lucide="chevron-down" class="h-4 w-4 opacity-50"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Table Section -->
                  <div class="rounded-lg glass-card border-card-soft text-card-foreground">
                    <div class="flex flex-col gap-1.5 p-6">
                      <h3 class="font-semibold tracking-tight text-lg">All Users (3)</h3>
                    </div>
                    <div class="p-0 overflow-x-auto">
                      <table class="border-collapse w-full text-sm">
                        <thead class="border-b border-solid border-card-soft">
                          <tr class="transition-colors hover:bg-muted/50">
                            <th class="h-12 px-4 text-left font-medium text-muted-foreground min-w-37.5">Name</th>
                            <th class="h-12 px-4 text-left font-medium text-muted-foreground min-w-50">Email</th>
                            <th class="h-12 px-4 text-left font-medium text-muted-foreground">Role</th>
                            <th class="h-12 px-4 text-left font-medium text-muted-foreground hidden sm:table-cell">Hospital</th>
                            <th class="h-12 px-4 text-left font-medium text-muted-foreground hidden lg:table-cell">Department</th>
                            <th class="h-12 px-4 text-left font-medium text-muted-foreground">Status</th>
                            <th class="h-12 px-4 text-right font-medium text-muted-foreground min-w-25">Actions</th>
                          </tr>
                        </thead>

                        <tbody class="table-no-border-last">

                          <!-- Row: Doctor -->
                          <tr class="border-b border-solid border-card-soft hover:bg-gray-50">
                            <td class="p-4 font-medium">Dr. Sarah Johnson</td>
                            <td class="p-4 text-sm text-gray-600">sarah.johnson@mediconnect.com</td>
                            <td class="p-4">
                              <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-green-100 text-green-800">Doctor</div>
                            </td>
                            <td class="p-4 hidden sm:table-cell text-sm">Central Medical Center</td>
                            <td class="p-4 hidden lg:table-cell text-sm">Cardiology</td>
                            <td class="p-4">
                              <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-medical-500 hover:bg-medical-400 text-white">active</div>
                            </td>
                            <td class="p-4 text-right">
                              <div class="flex gap-1 justify-end">
                                <button class="rounded-md h-8 w-8 p-0 hover:bg-accent pointer bg-transparent border-none hover:text-medical-500"><i data-lucide="square-pen" class="h-4 w-4"></i></button>
                                <button class="rounded-md h-8 w-8 p-0 text-red-600 hover:text-red-800 hover:bg-red-50 pointer bg-transparent border-none"><i data-lucide="trash2" class="h-4 w-4"></i></button>
                              </div>
                            </td>
                          </tr>

                          <!-- Row: Staff -->
                          <tr class="border-b hover:bg-gray-50">
                            <td class="p-4 font-medium">John Smith</td>
                            <td class="p-4 text-sm text-gray-600">john.smith@mediconnect.com</td>
                            <td class="p-4">
                              <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-yellow-100 text-yellow-800">Staff</div>
                            </td>
                            <td class="p-4 hidden sm:table-cell text-sm">Westside Hospital</td>
                            <td class="p-4 hidden lg:table-cell text-sm">Front Desk</td>
                            <td class="p-4">
                              <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-medical-500 hover:bg-medical-400 text-white">active</div>
                            </td>
                            <td class="p-4 text-right">
                              <div class="flex gap-1 justify-end">
                                <button class="rounded-md h-8 w-8 p-0 hover:bg-accent pointer bg-transparent border-none hover:text-medical-500"><i data-lucide="square-pen" class="h-4 w-4"></i></button>
                                <button class="rounded-md h-8 w-8 p-0 text-red-600 hover:text-red-800 hover:bg-red-50 pointer bg-transparent border-none"><i data-lucide="trash2" class="h-4 w-4"></i></button>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Manage Hospitals -->
              <div data-section="manage-hospitals" class="hidden mt-2">
                <div class="flex flex-col gap-6">

                  <!-- Header -->
                  <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Hospital Management</h2>
                    <button
                      class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors bg-medical-500 text-white hover:bg-medical-400 h-10 px-4 py-2 pointer border border-solid border-transparent"
                      type="button">
                      <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                      Add Hospital
                    </button>
                  </div>

                  <!-- Search Field -->
                  <div class="relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 h-4 w-4"></i>
                    <input
                      class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base md:text-sm pl-10"
                      placeholder="Search hospitals..." value="">
                  </div>

                  <!-- Table -->
                  <div class="rounded-md glass-card border-card-soft">
                    <div class="relative w-full overflow-auto">
                      <table class="border-collapse w-full text-sm">
                        <thead class="border-b border-solid border-card-soft">
                          <tr class="transition-colors hover:bg-muted/50">
                            <th class="h-12 px-4 text-left font-medium text-muted-foreground">Hospital Name</th>
                            <th class="h-12 px-4 text-left font-medium text-muted-foreground">Location</th>
                            <th class="h-12 px-4 text-left font-medium text-muted-foreground">Contact</th>
                            <th class="h-12 px-4 text-left font-medium text-muted-foreground">Capacity</th>
                            <th class="h-12 px-4 text-left font-medium text-muted-foreground">Departments</th>
                            <th class="h-12 px-4 text-left font-medium text-muted-foreground">Status</th>
                            <th class="h-12 px-4 text-right font-medium text-muted-foreground">Actions</th>
                          </tr>
                        </thead>

                        <tbody class="table-no-border-last">

                          <!-- Row 1 -->
                          <tr class="border-b border-solid border-card-soft transition-colors hover:bg-muted/50">
                            <td class="p-4 font-medium">Central Medical Center</td>
                            <td class="p-4">
                              <div class="flex items-center">
                                <i data-lucide="map-pin" class="h-4 w-4 mr-1 text-gray-400"></i>
                                123 Medical Blvd, Central City
                              </div>
                            </td>
                            <td class="p-4">
                              <div class="flex items-center">
                                <i data-lucide="phone" class="h-4 w-4 mr-1 text-gray-400"></i>
                                +1 (555) 123-4567
                              </div>
                            </td>
                            <td class="p-4">
                              <div class="flex items-center">
                                <i data-lucide="building" class="h-4 w-4 mr-1 text-gray-400"></i>
                                45/200
                              </div>
                            </td>
                            <td class="p-4">
                              <div class="flex items-center">
                                <i data-lucide="users" class="h-4 w-4 mr-1 text-gray-400"></i>
                                4 depts
                              </div>
                            </td>
                            <td class="p-4">
                              <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors border border-solid border-transparent bg-medical-500 text-white hover:bg-medical-400">
                                active
                              </div>
                            </td>
                            <td class="p-4 text-right">
                              <div class="flex gap-2 justify-end">
                                <button
                                  class="rounded-md h-8 w-8 p-0 hover:bg-accent pointer bg-transparent border-none hover:text-medical-500">
                                  <i data-lucide="square-pen" class="h-4 w-4"></i>
                                </button>
                                <button
                                  class="rounded-md h-8 w-8 p-0 text-red-600 hover:text-red-800 hover:bg-red-50 pointer bg-transparent border-none"
                                  type="button">
                                  <i data-lucide="trash-2" class="h-4 w-4"></i>
                                </button>
                              </div>
                            </td>
                          </tr>

                          <!-- Row 2 -->
                          <tr class="border-b border-solid border-card-soft transition-colors hover:bg-muted/50">
                            <td class="p-4 font-medium">Westside Hospital</td>
                            <td class="p-4">
                              <div class="flex items-center">
                                <i data-lucide="map-pin" class="h-4 w-4 mr-1 text-gray-400"></i>
                                456 Healthcare Ave, West District
                              </div>
                            </td>
                            <td class="p-4">
                              <div class="flex items-center">
                                <i data-lucide="phone" class="h-4 w-4 mr-1 text-gray-400"></i>
                                +1 (555) 987-6543
                              </div>
                            </td>
                            <td class="p-4">
                              <div class="flex items-center">
                                <i data-lucide="building" class="h-4 w-4 mr-1 text-gray-400"></i>
                                23/150
                              </div>
                            </td>
                            <td class="p-4">
                              <div class="flex items-center">
                                <i data-lucide="users" class="h-4 w-4 mr-1 text-gray-400"></i>
                                3 depts
                              </div>
                            </td>
                            <td class="p-4">
                              <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors border border-solid border-transparent bg-medical-500 text-white hover:bg-medical-400">
                                active
                              </div>
                            </td>
                            <td class="p-4 text-right">
                              <div class="flex gap-2 justify-end">
                                <button
                                  class="rounded-md h-8 w-8 p-0 hover:bg-accent pointer bg-transparent border-none hover:text-medical-500">
                                  <i data-lucide="square-pen" class="h-4 w-4"></i>
                                </button>
                                <button
                                  class="rounded-md h-8 w-8 p-0 text-red-600 hover:text-red-800 hover:bg-red-50 pointer bg-transparent border-none"
                                  type="button">
                                  <i data-lucide="trash-2" class="h-4 w-4"></i>
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
  </main>


  <!-- ==================== Add User Modal ==================== -->

  <!-- Overlay -->
  <div data-dialog="overlay" class="hidden inset-0 z-50 bg-black/80"></div>

  <!-- Modal Container -->
  <div
    data-dialog="modal"
    role="dialog"
    class="hidden left-[50%] top-[50%] z-50 grid translate-center bg-white gap-4 p-6 shadow-lg transition-200 sm:rounded-lg w-full max-w-md mx-4 sm:mx-auto">

    <!-- Modal Header -->
    <div class="flex flex-col gap-1.5 text-center sm:text-left">
      <h2 class="text-lg font-semibold leading-none tracking-tight">Add New User</h2>
    </div>

    <!-- Modal Body -->
    <div class="flex flex-col gap-4">

      <!-- Name and Email Fields -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

        <div>
          <label class="text-sm font-medium leading-none" for="name">Full Name</label>
          <input id="name"
            class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base placeholder:text-muted-foreground md:text-sm outline-none focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"
            placeholder="Enter full name">
        </div>

        <div>
          <label class="text-sm font-medium leading-none" for="email">Email</label>
          <input id="email" type="email"
            class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base placeholder:text-muted-foreground md:text-sm outline-none focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"
            placeholder="Enter email address">
        </div>

      </div>

      <!-- Role Dropdown -->
      <div class="relative">
        <label for="role" class="block mb-2 text-sm text-heading font-medium">
          Role
        </label>

        <!-- Dropdown Button -->
        <button type="button"
          data-dropdown-toggle
          data-dropdown-id="role-menu"
          data-selected-value
          role="combobox"
          class="flex h-10 w-full items-center justify-between pointer rounded-sm border border-solid border-input bg-background px-3 py-2 text-base text-left focus:ring focus:ring-2 focus:ring-offset-2 focus:ring-medical-500 focus:ring-offset-white md:text-sm">
          <span>Select a role</span>
          <i data-lucide="chevron-down" class="w-4 h-4"></i>
        </button>

        <!-- Role Options -->
        <ul id="role-menu" data-dropdown-menu class="absolute z-10 mt-1.5 p-1 border border-solid border-input w-full bg-white rounded-md shadow-xl hidden">
        </ul>
      </div>

      <!-- Hospital Dropdown -->
      <div class="relative">
        <label for="hospital" class="block mb-2 text-sm text-heading font-medium">
          Hospital
        </label>

        <!-- Dropdown Toggle Button -->
        <button
          type="button"
          data-dropdown-toggle
          data-dropdown-id="hospital-menu"
          data-selected-value
          role="combobox"
          class="flex h-10 w-full items-center justify-between pointer rounded-sm border border-solid border-input bg-background px-3 py-2 text-base text-left focus:ring focus:ring-2 focus:ring-offset-2 focus:ring-medical-500 focus:ring-offset-white md:text-sm">
          <span>Select a hospital</span>
          <i data-lucide="chevron-down" class="w-4 h-4 opacity-50"></i>
        </button>

        <!-- Dropdown Menu -->
        <ul id="hospital-menu" data-dropdown-menu class="absolute z-10 mt-1.5 p-1 border border-solid border-card-soft w-full bg-white rounded-md shadow-2xl hidden">
        </ul>
      </div>

      <!-- Department Field -->
      <div>
        <label class="text-sm font-medium leading-none" for="department">Department</label>
        <input
          class="flex h-10 w-full rounded-md border border-solid border-input bg-background px-3 py-2 text-base placeholder:text-muted-foreground md:text-sm outline-none focus:ring focus:ring-2 focus:ring-medical-500 focus:ring-offset-2 focus:ring-offset-white"
          placeholder="Enter department (optional)" />
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-end gap-2 pt-4">
        <button
          data-modal-close
          class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors border border-solid border-input bg-transparent pointer hover:bg-accent hover:text-medical-500 h-10 px-4 py-2">
          Cancel
        </button>
        <button
          class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors text-white h-10 px-4 py-2 bg-medical-500 hover:bg-medical-600 border-none pointer">
          Add User
        </button>
      </div>

    </div>

    <!-- Close Button -->
    <button type="button"
      data-modal-close
      class="absolute right-4 top-4 w-5 h-5 bg-transparent border-none rounded-full opacity-70 transition-opacity hover:opacity-100 focus:ring focus:ring-2 focus:ring-medical-600 focus:ring-offset-2 focus:ring-offset-white pointer">
      <i data-lucide="x" class="h-4 w-4"></i>
      <span class="sr-only">Close</span>
    </button>

  </div>


  <!-- ==================== Footer ==================== -->

  <footer class="bg-gray-50 pt-16 pb-8 border-t border-solid separator">
    <div class="container mx-auto px-4">
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <div>
          <a href="<?= $paths['home'] ?>" class="inline-block mb-4">
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
              <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                Book Appointments
              </a>
            </li>
            <li>
              <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                Find Doctors
              </a>
            </li>
            <li>
              <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                Hospital Information
              </a>
            </li>
            <li>
              <a href="<?= $paths['services']['emergency'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
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
              <a href="<?= $paths['static']['about'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                About Us
              </a>
            </li>
            <li>
              <a href="<?= $paths['static']['privacy'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                Privacy Policy
              </a>
            </li>
            <li>
              <a href="<?= $paths['static']['terms'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                Terms of Service
              </a>
            </li>
            <li>
              <a href="<?= $paths['static']['faq'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                FAQs
              </a>
            </li>
            <li>
              <a href="<?= $paths['static']['contact'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                Contact Us
              </a>
            </li>
            <li>
              <a href="<?= $paths['static']['blood_bank'] ?>" class="text-gray-600 hover:text-medical-600 transition-colors">
                Blood Bank System
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


  <!-- ==================== External JavaScript ==================== -->

  <script type="module" src="/mediconnect/js/common/index.js"></script>
  <script type="module" src="/mediconnect/js/dashboard/superadmin/index.js"></script>

  <!-- Create Lucide Icons -->
  <script>
    lucide.createIcons()
  </script>

</body>

</html>