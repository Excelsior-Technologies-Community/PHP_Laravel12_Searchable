<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laravel 12 App')</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Page Content -->
    <main class="grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

</body>
</html>
