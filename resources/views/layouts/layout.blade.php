<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M4CJHRCG');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body class="bg-bg font-sans">
    <header class="bg-surface border-b border-main-border sticky top-0 left-0 z-50">
        <nav class="max-w-[1200px] mx-auto py-4 px-4 md:px-0 flex justify-between items-center">
            <div>
                <a href="/"><img src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo of achar nama" class="w-28 md:w-32"></a>
            </div>

            <ul class="hidden md:flex gap-8 font-sans">
                <li class="text-brand-red font-medium transition-colors duration-300 hover:text-brand-orange font-sans"><a href="/">Home</a></li>
                <li class="text-brand-red font-medium transition-colors duration-300 hover:text-brand-orange font-sans"><a href="{{ route('blog.index') }}">Blogs</a></li>
                <li class="text-brand-red font-medium transition-colors duration-300 hover:text-brand-orange font-sans"><a href="{{ route('order.track') }}">Track Order</a></li>
            </ul>

            <div class="flex md:hidden items-center gap-4">
                <button id="hamburger" class="md:hidden cursor-pointer">
                    <x-heroicon-o-bars-3 class="w-6 h-6 text-text-primary" />
                </button>
            </div>
        </nav>

        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 md:hidden"></div>

        <div id="mobileMenu" class="fixed top-0 right-0 h-full w-full max-w-xs transform translate-x-full transition-transform duration-300 ease-in-out z-50 bg-surface border-l border-main-border shadow-lg md:hidden">

            <div class="flex justify-end p-4">
                <button id="closeMenu" class="text-text-primary hover:text-brand-orange cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <ul class="flex flex-col gap-0 mt-10 font-sans">
                <li class="border-b border-main-border text-brand-red font-medium text-lg transition-all duration-300 hover:text-brand-orange hover:bg-surface-alt">
                    <a href="/" class="block px-6 py-4 text-sm">Home</a>
                </li>
                <li class="border-b border-main-border text-brand-red font-medium text-lg transition-all duration-300 hover:text-brand-orange hover:bg-surface-alt">
                    <a href="{{ route('blog.index') }}" class="block px-6 py-4 text-sm">Blogs</a>
                </li>
                <li class="border-b border-main-border text-brand-red font-medium text-lg transition-all duration-300 hover:text-brand-orange hover:bg-surface-alt">
                    <a href="{{ route('order.track') }}" class="block px-6 py-4 text-sm">Track Order</a>
                </li>
            </ul>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-surface mt-8 border-t border-main-border text-text-primary py-4">
        <div class="max-w-[1200px] mx-auto px-4 text-center font-sans">

            <div class="flex justify-center space-x-6 mb-4">
                <a href="https://www.facebook.com/acharnama" target="_blank" rel="noopener noreferrer" class="text-text-primary hover:text-brand-red transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook-icon lucide-facebook">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                    </svg>
                </a>

                <a href="https://www.instagram.com/1998acharnama/" target="_blank" rel="noopener noreferrer" class="text-text-primary hover:text-brand-red transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram-icon lucide-instagram">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                    </svg>
                </a>
            </div>
            &copy; {{ date('Y') }} Achar Nama. All Rights Reserved
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

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4CJHRCG"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>