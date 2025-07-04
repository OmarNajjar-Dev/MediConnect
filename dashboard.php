<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Stylesheets -->
    <link href="css/base.css" rel="stylesheet" />
    <link href="css/colors.css" rel="stylesheet" />
    <link href="css/typography.css" rel="stylesheet" />
    <link href="css/spacing.min.css" rel="stylesheet" />
    <link href="css/sizing.min.css" rel="stylesheet" />
    <link href="css/borders.css" rel="stylesheet" />
    <link href="css/layout.css" rel="stylesheet" />
    <link href="css/animations.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
    <link href="css/ring.css" rel="stylesheet" />
    <link href="css/faq.css" rel="stylesheet" />

    <!-- Page Title -->
    <title>MediConnect - Bridging Healthcare &amp; Technology</title>
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
                <a href="./doctors.html"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Doctors</a>
                <a href="./hospitals.html"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Hospitals</a>
                <a href="./appointments.php"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Appointments</a>
                <a href="./dashboard.php"
                    class="text-gray-600 text-sm font-medium hover:text-medical-600 transition-colors">Dashboard</a>
            </nav>

            <!-- Header Right Section -->
            <div class="flex items-center gap-4">
                <!-- Sign In / Sign Up buttons (hidden by default) -->
                <a href="./login.php"
                    class="hidden items-center justify-center bg-input text-heading border border-solid border-input hover:bg-accent hover:text-medical-500 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all md:flex">Sign
                    In</a>
                <a href="./register.php"
                    class="hidden items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-3 rounded-lg text-sm font-medium whitespace-nowrap transition-all md:flex">Sign
                    Up</a>

                <!-- Mobile Menu Button -->
                <button id="menu-button"
                    class="inline-flex items-center justify-center bg-background hover:bg-accent hover:text-medical-500 p-3 rounded-md border-0 pointer md:hidden">
                    <i data-lucide="menu" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Mobile Navigation (Hidden by default) -->
            <div id="mobile-nav" class="hidden absolute bg-white-95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
                <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                    <a href="./"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="./doctors.html"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                    <a href="./hospitals.html"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                    <a href="./appointments.php"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>
                    <a href="./dashboard.php"
                        class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Dashboard</a>

                    <!-- Sign In / Sign Up buttons (Mobile view) -->
                    <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
                        <a href="./login.php"
                            class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-accent hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign
                            In</a>
                        <a href="./register.php"
                            class="inline-flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign
                            Up</a>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Mobile Navigation (Hidden by default) -->
        <div id="mobile-nav" class="hidden absolute bg-white-95 backdrop-blur-lg animate-slide-down shadow-lg">
            <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                <a href="./"
                    class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Home</a>
                <a href="./doctors.html"
                    class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Doctors</a>
                <a href="./hospitals.html"
                    class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Hospitals</a>
                <a href="./appointments.php"
                    class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Appointments</a>
                <a href="./dashboard.php"
                    class="text-gray-600 hover:bg-gray-50 py-2 px-3 rounded-lg text-sm font-medium transition-colors">Dashboard</a>

                <!-- Sign In / Sign Up buttons (Mobile view) -->
                <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
                    <a href="./login.php"
                        class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-accent hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign
                        In</a>
                    <a href="./register.php"
                        class="inline-flex items-center justify-center bg-medical-500 text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign
                        Up</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20 pb-16 min-h-screen bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="py-8">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-3xl text-heading font-bold mb-2">System Administrator Dashboard</h1>
                        <p class="text-gray-600">Welcome back, System Administrator</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="rounded-full border border-solid border-input px-2.5 py-0.5 text-xs font-semibold transition-colors flex items-center gap-1">
                            <div class="w-2 h-2 rounded-full bg-danger"></div><span class="text-heading">Super Admin</span>
                        </div><button aria-expanded="false" aria-haspopup="menu" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border-none bg-transparent transition-colors disabled:pointer-events-none disabled:opacity-50 rounded-md px-3 h-8" type="button"><i data-lucide="user-check" class="w-4 h-4"></i>Switch Role<i data-lucide="chevron-down" class="w-4 h-4"></i></button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="glass-card rounded-xl p-6 animate-fade-in opacity-0" style="animation-delay:0s">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-medical-100 flex items-center justify-center mr-4"><i data-lucide="calendar" class="text-medical-600"></i></div>
                            <div>
                                <h3 class="text-lg font-medium">Appointments</h3>
                                <p class="text-2xl font-bold">12</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card rounded-xl p-6 animate-fade-in opacity-0" style="animation-delay:.1s">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-medical-100 flex items-center justify-center mr-4"><i data-lucide="users" class="text-medical-600"></i></div>
                            <div>
                                <h3 class="text-lg font-medium">Active Users</h3>
                                <p class="text-2xl font-bold">1,240</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card rounded-xl p-6 animate-fade-in opacity-0" style="animation-delay:.2s">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-medical-100 flex items-center justify-center mr-4"><i data-lucide="pill" class="text-medical-600"></i></div>
                            <div>
                                <h3 class="text-lg font-medium">Prescriptions</h3>
                                <p class="text-2xl font-bold">45</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card rounded-xl p-6 animate-fade-in opacity-0" style="animation-delay:.3s">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-medical-100 flex items-center justify-center mr-4"><i data-lucide="chart-column" class="text-medical-600"></i></div>
                            <div>
                                <h3 class="text-lg font-medium">Reports</h3>
                                <p class="text-2xl font-bold">28</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card rounded-xl p-6 animate-fade-in opacity-0" style="animation-delay:.4s">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mr-4"><i data-lucide="activity" class="text-danger bg-red-100"></i></div>
                            <div>
                                <h3 class="text-lg font-medium">Emergency Calls</h3>
                                <p class="text-2xl font-bold">7</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <div class="rounded-lg glass-card border-card-light-soft text-card-foreground animate-fade-in opacity-0">
                        <div class="flex flex-col gap-1.5 p-6 pb-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center p-2 rounded-lg bg-accent text-medical-600"><i data-lucide="calendar" class="w-5 h-5"></i></div>
                                    <div>
                                        <h3 class="font-semibold tracking-tight text-lg">Appointment Management</h3>
                                        <p class="text-sm text-muted-foreground">Manage patient appointments</p>
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">admin</div>
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">doctor</div>
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">nurse</div>
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">staff</div>
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">patient</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="flex flex-col gap-6">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold">Appointment Overview</h3><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors disabled:pointer-events-none disabled:opacity-50 bg-medical-500 border-none text-primary-foreground hover:bg-medical-400 pointer h-9 rounded-md px-3">Schedule New</button>
                                </div>
                                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm p-4">
                                        <div class="p-0">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-muted-foreground">Today's Appointments</p>
                                                    <p class="text-2xl font-bold">24</p>
                                                    <p class="text-xs text-green-600">+12%</p>
                                                </div><i data-lucide="calendar" class="text-medical-500 w-8 h-8"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm p-4">
                                        <div class="p-0">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-muted-foreground">Pending Approval</p>
                                                    <p class="text-2xl font-bold">8</p>
                                                    <p class="text-xs text-green-600">+5%</p>
                                                </div><i data-lucide="clock" class="text-medical-500 w-8 h-8"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm p-4">
                                        <div class="p-0">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-muted-foreground">Active Patients</p>
                                                    <p class="text-2xl font-bold">156</p>
                                                    <p class="text-xs text-green-600">+8%</p>
                                                </div><i data-lucide="users" class="text-medical-500 w-8 h-8"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm p-4">
                                        <div class="p-0">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-muted-foreground">This Week</p>
                                                    <p class="text-2xl font-bold">89</p>
                                                    <p class="text-xs text-green-600">+15%</p>
                                                </div><i data-lucide="trending-up" class="text-medical-500 w-8 h-8"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                                    <div class="flex flex-col gap-1.5 p-6">
                                        <h3 class="font-semibold tracking-tight text-base">Recent Appointments</h3>
                                        <p class="text-sm text-muted-foreground">Manage today's appointments</p>
                                    </div>
                                    <div class="p-6 pt-0">
                                        <div class="flex flex-col gap-3">
                                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                                <div class="flex items-center gap-3">
                                                    <div class="text-sm font-medium">09:00</div>
                                                    <div>John Doe</div>
                                                </div>
                                                <div class="flex items-center gap-2"><span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">confirmed</span><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border-none transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3">View</button></div>
                                            </div>
                                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                                <div class="flex items-center gap-3">
                                                    <div class="text-sm font-medium">10:30</div>
                                                    <div>Jane Smith</div>
                                                </div>
                                                <div class="flex items-center gap-2"><span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">pending</span><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border-none transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3">View</button></div>
                                            </div>
                                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                                <div class="flex items-center gap-3">
                                                    <div class="text-sm font-medium">14:00</div>
                                                    <div>Mike Johnson</div>
                                                </div>
                                                <div class="flex items-center gap-2"><span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">completed</span><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border-none transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3">View</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm animate-fade-in opacity-0">
                        <div class="flex flex-col gap-1.5 p-6 pb-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center p-2 rounded-lg bg-accent text-medical-600"><i data-lucide="users" class="w-5 h-5"></i></div>
                                    <div>
                                        <h3 class="font-semibold tracking-tight text-lg">User Management</h3>
                                        <p class="text-sm text-muted-foreground">Manage system users and roles</p>
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">super_admin</div>
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">admin</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="flex flex-col gap-4">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold">User Management</h3><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors disabled:pointer-events-none disabled:opacity-50 bg-medical-500 border-none text-primary-foreground hover:bg-medical-400 pointer h-9 rounded-md px-3"><i data-lucide="plus" class="w-4 h-4"></i>Add User</button>
                                </div>
                                <div class="rounded-md border">
                                    <div class="relative w-full overflow-auto">
                                        <table class="w-full caption-bottom text-sm">
                                            <thead class="[&amp;_tr]:border-b">
                                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">Name</th>
                                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">Email</th>
                                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">Role</th>
                                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">Status</th>
                                                    <th class="h-12 px-4 align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="[&amp;_tr:last-child]:border-0">
                                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                                    <td class="p-4 align-middle font-medium">Dr. Sarah Johnson</td>
                                                    <td class="p-4 align-middle">sarah@example.com</td>
                                                    <td class="p-4 align-middle">
                                                        <div class="inline-flex items-center rounded-full border border-solid border-input px-2.5 py-0.5 text-xs font-semibold transition-colors text-foreground">doctor</div>
                                                    </td>
                                                    <td class="p-4 align-middle">
                                                        <div class="inline-flex items-center rounded-full border border-solid px-2.5 py-0.5 text-xs font-semibold transition-colors border border-solid border-transparent bg-medical-500 text-primary-foreground hover:bg-medical-400">active</div>
                                                    </td>
                                                    <td class="p-4 align-middle text-right">
                                                        <div class="flex gap-2 justify-end"><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors disabled:pointer-events-none disabled:opacity-50 hover:bg-accent pointer border border-solid border-transparent bg-transparent hover:text-medical-500 h-9 rounded-md px-3"><i data-lucide="square-pen" class="w-4 h-4"></i></button><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors disabled:pointer-events-none disabled:opacity-50 hover:bg-accent pointer border border-solid border-transparent bg-transparent h-9 rounded-md px-3 text-red-600 hover:text-red-800"><i data-lucide="trash2" class="w-4 h-4"></i></button></div>
                                                    </td>
                                                </tr>
                                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                                    <td class="p-4 align-middle font-medium">Nurse Mary Wilson</td>
                                                    <td class="p-4 align-middle">mary@example.com</td>
                                                    <td class="p-4 align-middle">
                                                        <div class="inline-flex items-center rounded-full border border-solid border-input px-2.5 py-0.5 text-xs font-semibold transition-colors text-foreground">nurse</div>
                                                    </td>
                                                    <td class="p-4 align-middle">
                                                        <div class="inline-flex items-center rounded-full border border-solid px-2.5 py-0.5 text-xs font-semibold transition-colors border border-solid border-transparent bg-medical-500 text-primary-foreground hover:bg-medical-400">active</div>
                                                    </td>
                                                    <td class="p-4 align-middle text-right">
                                                        <div class="flex gap-2 justify-end"><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors disabled:pointer-events-none disabled:opacity-50 hover:bg-accent pointer border border-solid border-transparent bg-transparent hover:text-medical-500 h-9 rounded-md px-3"><i data-lucide="square-pen" class="w-4 h-4"></i></button><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors disabled:pointer-events-none disabled:opacity-50 hover:bg-accent pointer border border-solid border-transparent bg-transparent h-9 rounded-md px-3 text-red-600 hover:text-red-800"><i data-lucide="trash2" class="w-4 h-4"></i></button></div>
                                                    </td>
                                                </tr>
                                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                                    <td class="p-4 align-middle font-medium">John Patient</td>
                                                    <td class="p-4 align-middle">john@example.com</td>
                                                    <td class="p-4 align-middle">
                                                        <div class="inline-flex items-center rounded-full border border-solid border-input px-2.5 py-0.5 text-xs font-semibold transition-colors text-foreground">patient</div>
                                                    </td>
                                                    <td class="p-4 align-middle">
                                                        <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80">inactive</div>
                                                    </td>
                                                    <td class="p-4 align-middle text-right">
                                                        <div class="flex gap-2 justify-end"><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors disabled:pointer-events-none disabled:opacity-50 hover:bg-accent pointer border border-solid border-transparent bg-transparent hover:text-medical-500 h-9 rounded-md px-3"><i data-lucide="square-pen" class="w-4 h-4"></i></button><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors disabled:pointer-events-none disabled:opacity-50 hover:bg-accent pointer border border-solid border-transparent bg-transparent h-9 rounded-md px-3 text-red-600 hover:text-red-800"><i data-lucide="trash2" class="w-4 h-4"></i></button></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm animate-fade-in opacity-0">
                        <div class="flex flex-col gap-1.5 p-6 pb-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center p-2 rounded-lg bg-accent text-medical-600"><i data-lucide="chart-column" class="w-5 h-5"></i></div>
                                    <div>
                                        <h3 class="font-semibold tracking-tight text-lg">Reports &amp; Analytics</h3>
                                        <p class="text-sm text-muted-foreground">View system reports and analytics</p>
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">super_</div>
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">admin</div>
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">viewer</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="flex flex-col gap-6">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold">Reports &amp; Analytics</h3><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors disabled:pointer-events-none disabled:opacity-50 bg-medical-500 border-none text-primary-foreground hover:bg-medical-400 pointer h-9 rounded-md px-3"><i data-lucide="file-text" class="w-4 h-4"></i>Generate Report</button>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm p-4">
                                        <div class="p-0">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-muted-foreground">Total Patients</p>
                                                    <p class="text-2xl font-bold">2,847</p>
                                                    <p class="text-xs text-green-600">+15.3% from last month</p>
                                                </div><i data-lucide="trending-up" class="text-green-500 w-8 h-8"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm p-4">
                                        <div class="p-0">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-muted-foreground">Appointments</p>
                                                    <p class="text-2xl font-bold">1,234</p>
                                                    <p class="text-xs text-blue-600">+8.1% this week</p>
                                                </div><i data-lucide="chart-no-axes-column-increasing" class="text-blue-500 w-8 h-8"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm p-4">
                                        <div class="p-0">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-muted-foreground">Revenue</p>
                                                    <p class="text-2xl font-bold">$45.2K</p>
                                                    <p class="text-xs text-purple-600">+22.5% this month</p>
                                                </div><i data-lucide="file-text" class="text-purple-500 w-8 h-8"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                                    <div class="flex flex-col gap-1.5 p-6">
                                        <h3 class="font-semibold tracking-tight text-base">Available Reports</h3>
                                        <p class="text-sm text-muted-foreground">Download and view system reports</p>
                                    </div>
                                    <div class="p-6 pt-0">
                                        <div class="flex flex-col gap-3">
                                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                                <div>
                                                    <div class="font-medium">Patient Statistics</div>
                                                    <div class="text-sm text-muted-foreground">Monthly patient registration data</div>
                                                    <div class="text-xs text-muted-foreground">Last updated: 2 hours ago</div>
                                                </div>
                                                <div class="flex gap-2"><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border border-solid border-input transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3">View</button><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border-none transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3"><i data-lucide="download" class="w-4 h-4"></i></button></div>
                                            </div>
                                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                                <div>
                                                    <div class="font-medium">Revenue Report</div>
                                                    <div class="text-sm text-muted-foreground">Financial overview and billing</div>
                                                    <div class="text-xs text-muted-foreground">Last updated: 1 day ago</div>
                                                </div>
                                                <div class="flex gap-2"><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border border-solid border-input transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3">View</button><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border-none transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3"><i data-lucide="download" class="w-4 h-4"></i></button></div>
                                            </div>
                                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                                <div>
                                                    <div class="font-medium">Staff Performance</div>
                                                    <div class="text-sm text-muted-foreground">Department efficiency metrics</div>
                                                    <div class="text-xs text-muted-foreground">Last updated: 3 days ago</div>
                                                </div>
                                                <div class="flex gap-2"><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border border-solid border-input transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3">View</button><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border-none transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3"><i data-lucide="download" class="w-4 h-4"></i></button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm animate-fade-in opacity-0">
                        <div class="flex flex-col gap-1.5 p-6 pb-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center p-2 rounded-lg bg-accent text-medical-600"><i data-lucide="file-text" class="w-5 h-5"></i></div>
                                    <div>
                                        <h3 class="font-semibold tracking-tight text-lg">Medical Records</h3>
                                        <p class="text-sm text-muted-foreground">Access patient medical records</p>
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">doctor</div>
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">nurse</div>
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">patient</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="flex flex-col gap-4">
                                <div class="flex justify-between items-center">
                                    <h4 class="font-medium">Recent Records</h4><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors disabled:pointer-events-none disabled:opacity-50 bg-medical-500 border-none text-primary-foreground hover:bg-medical-400 pointer h-9 rounded-md px-3">Add Record</button>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <div class="flex justify-between items-center p-3 border rounded-lg">
                                        <div>
                                            <div class="font-medium">Consultation</div>
                                            <div class="text-sm text-muted-foreground">2023-06-15 - Dr. Johnson</div>
                                        </div><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border-none transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3">View</button>
                                    </div>
                                    <div class="flex justify-between items-center p-3 border rounded-lg">
                                        <div>
                                            <div class="font-medium">Lab Results</div>
                                            <div class="text-sm text-muted-foreground">2023-06-10 - Dr. Smith</div>
                                        </div><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border-none transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3">View</button>
                                    </div>
                                    <div class="flex justify-between items-center p-3 border rounded-lg">
                                        <div>
                                            <div class="font-medium">Prescription</div>
                                            <div class="text-sm text-muted-foreground">2023-06-05 - Dr. Wilson</div>
                                        </div><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border-none transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm animate-fade-in opacity-0">
                        <div class="flex flex-col gap-1.5 p-6 pb-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center p-2 rounded-lg bg-accent text-medical-600"><i data-lucide="pill" class="w-5 h-5"></i></div>
                                    <div>
                                        <h3 class="font-semibold tracking-tight text-lg">Pharmacy Operations</h3>
                                        <p class="text-sm text-muted-foreground">Manage prescriptions and medication inventory</p>
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">pharmacist</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="flex flex-col gap-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="p-4 bg-blue-50 rounded-lg">
                                        <p class="text-2xl font-bold text-blue-700">67</p>
                                        <p class="text-sm text-blue-600">Pending Orders</p>
                                    </div>
                                    <div class="p-4 bg-green-50 rounded-lg">
                                        <p class="text-2xl font-bold text-green-700">234</p>
                                        <p class="text-sm text-green-600">Completed Today</p>
                                    </div>
                                </div><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors disabled:pointer-events-none disabled:opacity-50 bg-medical-600 border-none text-primary-foreground hover:bg-medical-500 pointer rounded-md px-3 h-10 px-4 py-2 w-full">View All Orders</button>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm animate-fade-in opacity-0">
                        <div class="flex flex-col gap-1.5 p-6 pb-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center p-2 rounded-lg bg-accent text-medical-600"><i data-lucide="activity" class="w-5 h-5"></i></div>
                                    <div>
                                        <h3 class="font-semibold tracking-tight text-lg">Emergency Operations</h3>
                                        <p class="text-sm text-muted-foreground">Manage emergency requests and ambulance dispatch</p>
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">ambulance_team</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 pt-0">
                            <div class="flex flex-col gap-4">
                                <div class="flex justify-between items-center">
                                    <h4 class="font-medium">Active Emergencies</h4>
                                    <div class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">7 Active</div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <div class="flex justify-between items-center p-3 border rounded-lg">
                                        <div>
                                            <div class="font-medium">E001</div>
                                            <div class="text-sm text-muted-foreground">Downtown Hospital</div>
                                        </div>
                                        <div class="flex items-center gap-2"><span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">High</span><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border-none transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3">View</button></div>
                                    </div>
                                    <div class="flex justify-between items-center p-3 border rounded-lg">
                                        <div>
                                            <div class="font-medium">E002</div>
                                            <div class="text-sm text-muted-foreground">City Center</div>
                                        </div>
                                        <div class="flex items-center gap-2"><span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Medium</span><button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium border-none transition-colors bg-transparent pointer disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-medical-500 h-9 rounded-md px-3">View</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg glass-card border-card-light-soft text-card-foreground shadow-sm mb-8 animate-fade-in opacity-0">
                    <div class="flex flex-col gap-1.5 p-6 pb-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center p-2 rounded-lg bg-accent text-medical-600"><i data-lucide="settings" class="w-5 h-5"></i></div>
                                <div>
                                    <h3 class="font-semibold tracking-tight text-lg">System Settings</h3>
                                    <p class="text-sm text-muted-foreground">Configure system settings and preferences</p>
                                </div>
                            </div>
                            <div class="flex gap-1">
                                <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">super_admin</div>
                                <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors border border-solid border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs">admin</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="p-4 glass-card border-card-light-soft rounded-lg hover:bg-gray-50 pointer">
                                <div class="text-medical-600 mb-2"><i data-lucide="shield" class="w-5 h-5"></i></div>
                                <div class="font-medium text-sm">Security</div>
                                <div class="text-xs text-muted-foreground">User permissions</div>
                            </div>
                            <div class="p-4 glass-card border-card-light-soft rounded-lg hover:bg-gray-50 pointer">
                                <div class="text-medical-600 mb-2"><i data-lucide="activity" class="w-5 h-5"></i></div>
                                <div class="font-medium text-sm">System Health</div>
                                <div class="text-xs text-muted-foreground">Monitor performance</div>
                            </div>
                            <div class="p-4 glass-card border-card-light-soft rounded-lg hover:bg-gray-50 pointer">
                                <div class="text-medical-600 mb-2"><i data-lucide="users" class="w-5 h-5"></i></div>
                                <div class="font-medium text-sm">Departments</div>
                                <div class="text-xs text-muted-foreground">Manage departments</div>
                            </div>
                            <div class="p-4 glass-card border-card-light-soft rounded-lg hover:bg-gray-50 pointer">
                                <div class="text-medical-600 mb-2"><i data-lucide="settings" class="w-5 h-5"></i></div>
                                <div class="font-medium text-sm">General</div>
                                <div class="text-xs text-muted-foreground">System preferences</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="glass-card rounded-xl p-6 mb-8">
                    <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4"><a class="quick-action-dash whitespace-nowrap rounded-md text-sm font-medium disabled:pointer-events-none disabled:opacity-50 border border-solid border-input bg-background hover:bg-accent hover:text-accent-foreground px-4 h-auto py-4 flex flex-col items-center justify-center gap-2" href="/appointments">
                            <div class="text-medical-600"><i data-lucide="calendar" class="w-4 h-4"></i></div><span class="text-sm font-normal text-gray-900">Book Appointment</span>
                        </a><a class="quick-action-dash whitespace-nowrap rounded-md text-sm font-medium disabled:pointer-events-none text-heading disabled:opacity-50 border border-solid border-input bg-background hover:bg-accent px-4 h-auto py-4 flex flex-col items-center justify-center gap-2" href="/doctors">
                            <div class="text-medical-600"><i data-lucide="user" class="w-4 h-4"></i></div><span class="text-sm font-normal text-gray-900">Find Doctor</span>
                        </a><a class="quick-action-dash whitespace-nowrap rounded-md text-sm font-medium disabled:pointer-events-none text-heading disabled:opacity-50 border border-solid border-input bg-background hover:bg-accent px-4 h-auto py-4 flex flex-col items-center justify-center gap-2" href="/pharmacy">
                            <div class="text-medical-600"><i data-lucide="pill" class="w-4 h-4"></i></div><span class="text-sm font-normal text-gray-900">Order Medication</span>
                        </a><a class="quick-action-dash whitespace-nowrap rounded-md text-sm font-medium disabled:pointer-events-none text-heading disabled:opacity-50 border border-solid border-input bg-background hover:bg-accent px-4 h-auto py-4 flex flex-col items-center justify-center gap-2" href="/reports">
                            <div class="text-medical-600"><i data-lucide="file-text" class="w-4 h-4"></i></div><span class="text-sm font-normal text-gray-900">View Reports</span>
                        </a><a class="quick-action-dash whitespace-nowrap rounded-md text-sm font-medium disabled:pointer-events-none text-heading disabled:opacity-50 border border-solid border-input bg-background hover:bg-accent px-4 h-auto py-4 flex flex-col items-center justify-center gap-2" href="/hospitals">
                            <div class="text-medical-600"><i data-lucide="star" class="w-4 h-4"></i></div><span class="text-sm font-normal text-gray-900">Rate Hospitals</span>
                        </a><a class="quick-action-dash whitespace-nowrap rounded-md text-sm font-medium disabled:pointer-events-none text-heading disabled:opacity-50 border border-solid border-input bg-background hover:bg-accent px-4 h-auto py-4 flex flex-col items-center justify-center gap-2" href="/emergency">
                            <div class="text-red-600"><i data-lucide="plus" class="w-4 h-4"></i></div><span class="text-sm font-normal text-gray-900">Emergency Service</span>
                        </a></div>
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
                            class="text-gray-500 hover:text-medical-600 hover:bg-accent rounded-full flex justify-center items-center w-10 h-10">
                            <i data-lucide="facebook" class="h-4 w-4"></i>
                        </a>

                        <a href="#"
                            class="text-gray-500 hover:text-medical-600 hover:bg-accent rounded-full flex justify-center items-center w-10 h-10">
                            <i data-lucide="twitter" class="h-4 w-4"></i>
                        </a>
                        <a href="#"
                            class="text-gray-500 hover:text-medical-600 hover:bg-accent rounded-full flex justify-center items-center w-10 h-10">
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
                            <a href="./doctors.html" class="text-gray-600 hover:text-medical-600 transition-colors">
                                Find Doctors
                            </a>
                        </li>
                        <li>
                            <a href="./hospitals.html" class="text-gray-600 hover:text-medical-600 transition-colors">
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
    <script type="module" src="js/common/header.js"></script>
    <script type="module" src="js/common/mobile-nav.js"></script>

    <!-- Create Lucide Icons -->
    <script>
        lucide.createIcons()
    </script>

</body>

</html>