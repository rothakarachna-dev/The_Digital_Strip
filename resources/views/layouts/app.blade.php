<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <style>
        :root {
            --primary-pink: #e91e63;
            --soft-pink: #fce4ec;
            --bg-pink: #fdf0f5;
            --white: #ffffff;
            --text-gray: #777;
            --text-dark: #333;
        }

        body {
            background-color: var(--bg-pink);
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .main-content {
            flex-grow: 1;
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(240px,1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card,
        .content-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
        }

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
        }

        .delete-btn {
            background: #ff5252;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
        }

        table {
            width: 100%;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    @yield('content')

</body>
</html>