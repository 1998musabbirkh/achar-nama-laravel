<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To Achar Nama</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-bg w-full h-screen flex justify-center items-center">
    <div class="max-w-[350px] border border-main-border p-4 rounded-sm flex flex-col gap-4">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo of achar nama" class="w-32">

        <h2 class="text-brand-red font-sans text-2xl font-bold">Welcome To Achar Nama</h2>
        <p class="text-neutral-white font-medium font-sans">Sign In</p>
        <a href="{{ route('google.login') }}" class="flex gap-2 justify-center hover:bg-neutral-light transition-colors duration-300 items-center text-text-primary font-bold border border-main-border px-4 py-2 cursor-pointer rounded-sm">
            <img src="{{ Vite::asset('resources/images/google.png') }}" alt="google icon" class="w-6 h-6">
            Continue With Google
        </a>
    </div>
</body>

</html>