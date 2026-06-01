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

        /* Navbar */

        .navbar {
            background: #111111;
            border-bottom: 1px solid #27272a;
            padding: 18px 0;
        }

        .navbar-brand {
            color: #ffffff !important;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .navbar-brand i {
            color: #a855f7;
            margin-right: 8px;
        }

        /* Layout */

        .main-wrapper {
            padding: 50px 0;
        }

        /* Dashboard Card */

        .dashboard-card {
            background: linear-gradient(135deg, #18181b, #27272a);
            border: 1px solid #3f3f46;
            border-radius: 24px;
            padding: 35px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.45);
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            background: rgba(168, 85, 247, 0.15);
            border-radius: 50%;
            top: -90px;
            right: -80px;
        }

        .dashboard-title {
            color: #a1a1aa;
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .dashboard-number {
            font-size: 54px;
            font-weight: 700;
            margin-top: 10px;
        }

        /* Card */

        .custom-card {
            background: #18181b;
            border: 1px solid #27272a;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        /* Search */

        .search-box {
            padding: 28px;
        }

        .form-control {
            background: #09090b;
            border: 1px solid #3f3f46;
            color: white;
            border-radius: 16px;
            padding: 14px 18px;
            font-size: 15px;
        }

        .form-control:focus {
            background: #09090b;
            color: white;
            border-color: #a855f7;
            box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.15);
        }

        .form-control::placeholder {
            color: #000000;
            opacity: 1;
        }

        /* Buttons */

        .btn-primary {
            background: linear-gradient(135deg, #9333ea, #7e22ce);
            border: none;
            border-radius: 16px;
            padding: 12px 22px;
            font-weight: 600;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        .btn-success {
            border-radius: 12px;
        }

        .btn-danger {
            border-radius: 12px;
        }

        /* Table */

        .table {
            color: #f4f4f5;
            margin-bottom: 0;
        }

        .table thead {
            background: #09090b;
        }

        .table thead th {
            border: none;
            color: #71717a;
            padding: 18px;
            font-size: 13px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .table tbody tr {
            border-color: #27272a;
            transition: 0.2s;
        }

        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .table td {
            padding: 18px;
            vertical-align: middle;
        }

        /* Alerts */

        .alert-success {
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid rgba(34, 197, 94, 0.25);
            color: #bbf7d0;
            border-radius: 16px;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #fecaca;
            border-radius: 16px;
        }

        /* Pagination */

        .pagination .page-link {
            background: #18181b;
            border: 1px solid #3f3f46;
            color: #f4f4f5;
            margin: 0 5px;
            border-radius: 12px;
            padding: 10px 16px;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #9333ea, #7e22ce);
            border: none;
        }

        .pagination .page-link:hover {
            background: #27272a;
        }

        /* Footer */

        .footer {
            text-align: center;
            padding: 30px 0;
            color: #71717a;
            font-size: 14px;
        }
    </style>

</head>


</html