<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



    <!-- Scripts -->
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body class="bg-light p-4">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
        <header class="grid grid-cols-2 items-center gap-2 py-2 lg:grid-cols-3">
            <div class="justify-self-start">
                <x-application-logo />
            </div>
            <div class="col-span-2 flex justify-end">
                {{-- <x-theme-switcher/> --}}
                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>
    </div>
    <div class="container d-flex justify-content-center gap-3">
        <div class="card border-0 shadow-sm rounded-3" style="width: 18rem;">
            <div class="card-body text-center">
                <h2 class="card-title font-weight-bold fs-4">Titolo</h2>
                <p class="card-text text-muted fs-5">Descrizione del prodotto.</p>
                <div class="price h4 text-dark fs-4">€99.99</div>
                <a href="#" class="btn btn-primary rounded-2 px-4 py-2 fs-5">Acquista</a>
            </div>
        </div>
        <div class="card border-0 shadow-sm rounded-3" style="width: 18rem;">
            <div class="card-body text-center">
                <h2 class="card-title font-weight-bold fs-4">Titolo</h2>
                <p class="card-text text-muted fs-5">Descrizione del prodotto.</p>
                <div class="price h4 text-dark fs-4">€99.99</div>
                <a href="#" class="btn btn-primary rounded-2 px-4 py-2 fs-5">Acquista</a>
            </div>
        </div>
    </div>

</body>

</html>
