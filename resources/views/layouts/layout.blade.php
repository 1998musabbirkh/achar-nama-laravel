<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-bg font-sans">
    <header class="bg-surface border-b border-main-border sticky top-0 left-0 z-50">
        <nav class="max-w-[1200px] mx-auto py-4 px-4 md:px-0 flex justify-between items-center">
            <!-- Logo -->
            <div>
                <a href="/"><img src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo of achar nama" class="w-28 md:w-32"></a>
            </div>

            <!-- Desktop Menu -->
            <ul class="hidden md:flex gap-8 font-sans">
                <li class="text-brand-green font-medium transition-colors duration-300 hover:text-brand-orange font-sans"><a href="">Home</a></li>
                <li class="text-brand-green font-medium transition-colors duration-300 hover:text-brand-orange font-sans"><a href="">Shop</a></li>
                <li class="text-brand-green font-medium transition-colors duration-300 hover:text-brand-orange font-sans"><a href="">Track Order</a></li>
                <li class="text-brand-green font-medium transition-colors duration-300 hover:text-brand-orange font-sans"><a href="">Contact</a></li>
            </ul>

            <!-- Icons & Hamburger -->
            <div class="flex items-center gap-4">
                <!-- Icons (desktop only) -->
                <ul class="flex gap-4">
                    <li><a href=""><x-heroicon-o-shopping-bag class="w-6 h-6 text-text-primary hover:text-accent-leaf transition-colors duration-300" /></a></li>
                    <li><a href=""><x-heroicon-o-user-circle class="w-6 h-6 text-text-primary hover:text-accent-leaf transition-colors duration-300" /></a></li>
                </ul>

                <!-- Hamburger (mobile only) -->
                <button id="hamburger" class="md:hidden cursor-pointer">
                    <x-heroicon-o-bars-3 class="w-6 h-6 text-text-primary" />
                </button>
            </div>
        </nav>

        <!-- Overlay -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 md:hidden"></div>

        <!-- Mobile Fullscreen Menu -->
        <div id="mobileMenu" class="fixed top-0 right-0 h-full w-full max-w-xs transform translate-x-full transition-transform duration-300 ease-in-out z-50 bg-surface border-l border-main-border shadow-lg md:hidden">

            <!-- Close Button -->
            <div class="flex justify-end p-4">
                <button id="closeMenu" class="text-text-primary hover:text-brand-orange cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Menu Items -->
            <ul class="flex flex-col gap-0 mt-10 font-sans">
                <li class="border-b border-main-border text-brand-green font-medium text-lg transition-all duration-300 hover:text-brand-orange hover:bg-surface-alt">
                    <a href="" class="block px-6 py-4 text-sm">Home</a>
                </li>
                <li class="border-b border-main-border text-brand-green font-medium text-lg transition-all duration-300 hover:text-brand-orange hover:bg-surface-alt">
                    <a href="" class="block px-6 py-4 text-sm">Shop</a>
                </li>
                <li class="border-b border-main-border text-brand-green font-medium text-lg transition-all duration-300 hover:text-brand-orange hover:bg-surface-alt">
                    <a href="" class="block px-6 py-4 text-sm">Track Order</a>
                </li>
                <li class="border-b border-main-border text-brand-green font-medium text-lg transition-all duration-300 hover:text-brand-orange hover:bg-surface-alt">
                    <a href="" class="block px-6 py-4 text-sm">Contact</a>
                </li>
            </ul>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-[1200px] mx-auto px-4 text-center">
            &copy; {{ date('Y') }} My Laravel App
        </div>
    </footer>

    <script>
        const hamburger = document.getElementById('hamburger');
        const closeMenu = document.getElementById('closeMenu');
        const mobileMenu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('overlay');

        const openMenu = () => {
            mobileMenu.classList.remove('translate-x-full');
            mobileMenu.classList.add('translate-x-0');
            overlay.classList.remove('hidden');
        };

        const closeMobileMenu = () => {
            mobileMenu.classList.remove('translate-x-0');
            mobileMenu.classList.add('translate-x-full');
            overlay.classList.add('hidden');
        };

        hamburger.addEventListener('click', openMenu);
        closeMenu.addEventListener('click', closeMobileMenu);
        overlay.addEventListener('click', closeMobileMenu);
    </script>
</body>

</html>