<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | @yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-bg">
    <header class="bg-surface border-b border-main-border sticky top-0 left-0 z-50">
        <div class="max-w-[1200px] mx-auto py-4 px-4 md:px-0 flex justify-between items-center">
            <div>
                <a href="/dashboard"><img src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo of acharnama" class="w-32"></a>
            </div>
            <div class="flex gap-4 items-center">
                <div class="relative max-w-[250px]">
                    <input type="text"
                        placeholder="Search..."
                        class="w-full pl-10 pr-4 py-2 text-text-secondary rounded-sm border border-main-border focus:border-brand-red outline-none transition duration-300" />
                    <x-heroicon-o-magnifying-glass class="absolute left-3 top-1/2 -translate-y-1/2 w-6 h-6 text-brand-red" />
                </div>

                <div>
                    <x-heroicon-o-bell class="w-6 h-6 text-text-primary cursor-pointer hover:text-brand-green transition-colors duration-300" />
                </div>
                <button>
                    <img src="{{ auth()->user()->image }}"
                        alt="{{ auth()->user()->name }}"
                        class="w-8 h-8 rounded-full cursor-pointer">
                </button>
            </div>
        </div>
    </header>

    <div class="flex max-w-[1200px] mx-auto mt-4 px-4 md:px-0">
        <aside class="w-64 bg-surface p-4 border border-main-border rounded-sm shadow-md mr-4 h-full sticky top-20">
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('products.index') }}" class="block py-2 px-3 text-text-primary hover:bg-brand-red hover:text-white rounded-sm transition duration-200 ease-in-out">
                            Products
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/categories" class="block py-2 px-3 text-text-primary hover:bg-brand-red hover:text-white rounded-sm transition duration-200 ease-in-out">
                            Categories
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('orders.index') }}" class="block py-2 px-3 text-text-primary hover:bg-brand-red hover:text-white rounded-sm transition duration-200 ease-in-out">
                            Orders
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/customers" class="block py-2 px-3 text-text-primary hover:bg-brand-red hover:text-white rounded-sm transition duration-200 ease-in-out">
                            Customers
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="flex-1 min-w-0">
            @yield('content')
        </main>
    </div>
</body>

</html>