<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wallet App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- include htmx -->
    <script src="https://unpkg.com/htmx.org@1.9.3"></script>

    <nav class="bg-white shadow p-4">
        <div class="container mx-auto">
            <a href="{{ route('wallet.index') }}" class="font-bold">Wallet</a>
        </div>
    </nav>

    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
