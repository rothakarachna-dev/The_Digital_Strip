<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-pink: #e91e63;
            --soft-pink: #fce4ec;
            --bg-pink: #fdf0f5;
            --text-dark: #333;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: var(--bg-pink);

            /* IMPORTANT: makes room for sidebar */
            display: flex;
        }

        /* ===== SIDEBAR AREA ===== */
        .sidebar {
            width: 75px;
            flex-shrink: 0;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            flex: 1;
            padding: 40px;
            min-height: 100vh;

            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .content-wrapper {
            width: 100%;
            max-width: 1100px;
        }

        /* HEADER */
        .page-header {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .admin-mini-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
            padding: 10px 20px;
            border-radius: 50px;
        }

        .admin-mini-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* CARDS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card,
        .content-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        /* FORMS */
        .form-row {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .form-row input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .btn-main {
            background: var(--primary-pink);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
        }

        /* ===== TABLE ===== */

        table {
            width: 100%;
            border-collapse: collapse;
             font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* header + cells MUST match alignment */
        th,
        td {
            text-align: left;
            padding: 18px 20px;
            vertical-align: middle;
        }

        /* header style */
        th {
            background: var(--soft-pink);
        }

        /* rows */
        tbody tr {
            border-bottom: 1px solid #f0f0f0;
        }

        tbody tr:hover {
            background: #fafafa;
        }

        /* ===== ACTION COLUMN FIX ===== */
        td.action-cell {
            text-align: left; /* IMPORTANT: match other columns */
        }

        /* remove form default behavior */
        .action-cell form {
            margin: 0;
            padding: 0;
            display: inline; /* prevents block stretching */
        }

        /* button style */
        .delete-btn {
            background: #ff5252;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 20px;
            cursor: pointer;
            display: inline-block;
            transition: 0.2s ease;
        }

        /* hover effect */
        .delete-btn:hover {
            background: #e53935;
            transform: scale(1.05);
        }

        .btn-clear {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 8px 14px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    background-color: #f9fafb;
    color: #374151;
    font-size: 0.9rem;
    text-decoration: none;
    transition: background-color 0.15s ease, border-color 0.15s ease;
}

    .btn-clear:hover {
        background-color: #f3f4f6;
        border-color: #9ca3af;
    }

    .btn-clear:focus-visible {
        outline: 2px solid #6366f1;
        outline-offset: 2px;
    }

    .btn-clear span {
        font-size: 1.1rem;
        line-height: 1;
    }

    </style>
</head>

<body>

    {{-- sidebar --}}
    @include('admin.sidebar')

    {{-- Main page content --}}
    @yield('content')

</body>
</html>