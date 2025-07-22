<?php require_once __DIR__ . "/../backend/helpers/navigation-helper.php" ?>

<header class="fixed z-50 py-5 top-0 left-0 right-0 bg-transparent transition-all">
    <div class="container mx-auto flex items-center justify-between px-4">

        <!-- Logo -->
        <a href="<?= $paths['home']['index'] ?>" class="flex items-center">
            <span class="text-medical-700 text-2xl font-semibold">
                Medi<span class="text-medical-500">Connect</span>
            </span>
        </a>

        <!-- Desktop Navigation (hidden on mobile) -->
        <nav class="hidden md:flex items-center gap-4 lg:gap-8 xl:ml-28">
            <a href="<?= $paths['home']['index'] ?>" class="<?= getActiveNavClassDesktop('home', $currentPage) ?>">Home</a>
            <a href="<?= $paths['services']['doctors'] ?>" class="<?= getActiveNavClassDesktop('doctors', $currentPage) ?>">Doctors</a>
            <a href="<?= $paths['services']['hospitals'] ?>" class="<?= getActiveNavClassDesktop('hospitals', $currentPage) ?>">Hospitals</a>
            <a href="<?= $paths['services']['appointments'] ?>" class="<?= getActiveNavClassDesktop('appointments', $currentPage) ?>">Appointments</a>
        </nav>

        <!-- Right section: Auth / Dropdown / Emergency / Menu -->
        <div class="flex items-center gap-4">

            <?php if ($isLoggedIn): ?>
                <!-- User dropdown (visible if logged in) -->
                <div class="hidden md:flex items-center gap-3 mr-4">
                    <div class="dropdown relative">
                        <button class="flex items-center gap-2 md:py-2 px-2 border-none bg-transparent hover:bg-medical-50 transition-colors transition-200 cursor-pointer rounded-lg">
                            <?= generateAvatar($userProfileImage, $userName, 'w-8 h-8', 'text-sm lg:text-base') ?>
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

                            <a href="<?= $paths['dashboard']['index'] ?>" class="flex items-center gap-2 px-3 py-2 text-sm slate-600 hover:text-primary hover:bg-medical-50 transition-colors transition-200">
                                <i data-lucide="user" class="w-4 h-4"></i>Dashboard
                            </a>

                            <a href="<?= $paths['auth']['logout'] ?>" class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 w-full transition-colors transition-200">
                                <i data-lucide="log-out" class="w-4 h-4"></i>Sign Out
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Emergency button (always visible) -->
            <a href="<?= $paths['services']['emergency'] ?>" class="inline-flex items-center gap-2 bg-danger hover:bg-red-700 text-white text-sm lg:text-base font-medium px-2 lg:px-4 py-2 md:py-3 rounded-lg transition-colors transition-200">
                <i data-lucide="ambulance" class="w-4 h-4"></i>
                Emergency
            </a>

            <?php if (!$isLoggedIn): ?>
                <!-- Sign In / Sign Up (visible if not logged in) -->
                <a href="<?= $paths['auth']['login'] ?>" class="hidden md:flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all md:ml-4">
                    Sign In
                </a>

                <a href="<?= $paths['auth']['register'] ?>" class="hidden lg:flex items-center justify-center bg-primary text-white hover:bg-medical-400 h-10 px-3 rounded-lg text-sm lg:text-base font-medium whitespace-nowrap transition-all">
                    Sign Up
                </a>
            <?php endif; ?>

            <!-- Mobile menu toggle button -->
            <button id="menu-button" class="inline-flex md:hidden items-center justify-center bg-background hover:bg-medical-50 hover:text-medical-500 p-3 rounded-md border-none cursor-pointer">
                <i data-lucide="menu" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- Mobile Navigation Panel (visible only on mobile) -->
        <div id="mobile-nav" class="hidden absolute top-full left-0 right-0 bg-white/95 backdrop-blur-lg animate-slide-down shadow-lg md:hidden">
            <nav class="container mx-auto flex flex-col gap-4 px-4 py-4">
                <a href="<?= $paths['home']['index'] ?>" class="<?= getActiveNavClassMobile('home', $currentPage) ?>">Home</a>
                <a href="<?= $paths['services']['doctors'] ?>" class="<?= getActiveNavClassMobile('doctors', $currentPage) ?>">Doctors</a>
                <a href="<?= $paths['services']['hospitals'] ?>" class="<?= getActiveNavClassMobile('hospitals', $currentPage) ?>">Hospitals</a>
                <a href="<?= $paths['services']['appointments'] ?>" class="<?= getActiveNavClassMobile('appointments', $currentPage) ?>">Appointments</a>

                <!-- Mobile: Sign In / Sign Out depending on session -->
                <?php if (!$isLoggedIn): ?>
                    <div class="flex flex-col pt-2 gap-2 border-t border-solid separator">
                        <a href="<?= $paths['auth']['login'] ?>" class="inline-flex items-center justify-center bg-input text-heading border border-solid border-input hover:bg-medical-50 hover:text-medical-500 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-all">Sign In</a>
                        <a href="<?= $paths['auth']['register'] ?>" class="inline-flex items-center justify-center bg-primary text-white hover:bg-medical-400 h-9 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Sign Up</a>
                    </div>
                <?php else: ?>
                    <div class="flex flex-col pt-2 gap-2 bg-transparent border-t border-solid separator">
                        <a href="<?= $paths['dashboard']['index'] ?>" class="inline-flex items-center gap-2 justify-start text-gray-700 hover:bg-medical-50 hover:text-primary px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i data-lucide="user" class="w-4 h-4"></i> Dashboard
                        </a>
                        <a href="<?= $paths['auth']['logout'] ?>" class="inline-flex items-center gap-2 justify-start text-red-600 hover:bg-red-50 hover:text-red-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i data-lucide="log-out" class="w-4 h-4"></i> Sign Out
                        </a>
                    </div>
                <?php endif; ?>
            </nav>
        </div>

    </div>
</header>