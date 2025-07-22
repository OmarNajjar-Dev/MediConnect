<footer class="bg-gray-50 pt-16 pb-8 border-t border-solid separator">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <div>
                <a href="<?= $paths['home']['index'] ?>" class="inline-block mb-4">
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
                        class="text-gray-500 hover:text-primary hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
                        <i data-lucide="facebook" class="h-4 w-4"></i>
                    </a>

                    <a href="#"
                        class="text-gray-500 hover:text-primary hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
                        <i data-lucide="twitter" class="h-4 w-4"></i>
                    </a>
                    <a href="#"
                        class="text-gray-500 hover:text-primary hover:bg-medical-50 rounded-full flex justify-center items-center w-10 h-10">
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
                        <a href="<?= $paths['services']['appointments'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                            Book Appointments
                        </a>
                    </li>
                    <li>
                        <a href="<?= $paths['services']['doctors'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                            Find Doctors
                        </a>
                    </li>
                    <li>
                        <a href="<?= $paths['services']['hospitals'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                            Hospital Information
                        </a>
                    </li>
                    <li>
                        <a href="<?= $paths['services']['emergency'] ?>" class="text-gray-600 hover:text-primary transition-colors">
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
                        <a href="<?= $paths['static']['about'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="<?= $paths['static']['privacy'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="<?= $paths['static']['terms'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                            Terms of Service
                        </a>
                    </li>
                    <li>
                        <a href="<?= $paths['static']['faq'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                            FAQs
                        </a>
                    </li>
                    <li>
                        <a href="<?= $paths['static']['contact'] ?>" class="text-gray-600 hover:text-primary transition-colors">
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="<?= $paths['static']['blood_bank'] ?>" class="text-gray-600 hover:text-primary transition-colors">
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