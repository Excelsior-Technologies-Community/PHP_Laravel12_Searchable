<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel Search Dashboard</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #09090b;
            color: #f4f4f5;
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
        }

        .navbar {
            background: #111111;
            border-bottom: 1px solid #27272a;
            padding: 18px 0;
        }

        .navbar-brand {
            color: #ffffff !important;
            font-size: 28px;
            font-weight: 700;
        }

        .container-wrapper {
            padding: 40px 0;
        }
    </style>

</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="/">Laravel Posts</a>
        </div>
    </nav>

    {{-- IMPORTANT: THIS FIXES YOUR BLANK PAGE --}}
    <div class="container container-wrapper">

        @yield('content')

    </div>

</body>

</html>