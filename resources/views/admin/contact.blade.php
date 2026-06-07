<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Contact Messages</title>

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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-pink);
            margin: 0;
            padding: 0;
        }

        .main-content {
            padding: 60px;
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
        }

        .breadcrumb {
            color: var(--text-gray);
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }

        .page-header h1 {
            margin: 0;
            color: var(--text-dark);
            font-size: 26px;
        }

        .content-card {
            background: var(--white);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(233, 30, 99, 0.08);
        }

        .card-title {
            color: var(--primary-pink);
            font-size: 18px;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        th,
        td {
            text-align: left;
            padding: 20px;
            vertical-align: middle;
        }

        th {
            background: var(--soft-pink);
            color: var(--primary-pink);
            font-size: 12px;
            text-transform: uppercase;
            color: #000;
        }

        tbody tr {
            border-bottom: 1px solid #f9f9f9;
        }

        tr:hover td {
            background: #fffafc;
        }

        .user-info strong {
            display: block;
        }

        .user-info span {
            font-size: 13px;
            color: var(--text-gray);
        }

        .message-content {
            max-width: 450px;
            word-wrap: break-word;
        }

        .date {
            color: var(--text-gray);
            font-size: 13px;
        }

        .delete-btn {
            background: #ff5252;
            color: white;
            border: none;
            padding: 10px 22px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }

        .delete-btn:hover {
            background: #e53935;
        }

        .empty-row {
            text-align: center;
            padding: 40px;
            color: var(--text-gray);
        }
    </style>
</head>

<body>

@include('admin.sidebar')

<div class="main-content">
    <div class="content-wrapper">

        <div class="page-header">
            <span class="breadcrumb">Admin / Feedback</span>
            <h1>Contact Messages</h1>
        </div>

        <div class="content-card">

            <table>
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Message</th>
                        <th>Date Received</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>

                <tbody>

                @if($messages->count() > 0)

                    @foreach($messages as $msg)
                        <tr>
                            <td class="user-info">
                                <strong>{{ $msg->name }}</strong>
                                <span>{{ $msg->email }}</span>
                            </td>

                            <td class="message-content">
                                {!! nl2br(e($msg->message)) !!}
                            </td>

                            <td class="date">
                                {{ \Carbon\Carbon::parse($msg->created_at)->format('M d, Y | g:i A') }}
                            </td>

                            <td style="text-align:center;">
                                <form action="{{ route('admin.contact.destroy', $msg->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this message?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="delete-btn">
                                        Delete
                                    </button>

                                </form>
                            </td>
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <td colspan="4" class="empty-row">
                            No messages found in the database.
                        </td>
                    </tr>
                @endif

                </tbody>
            </table>

        </div>
    </div>
</div>

</body>
</html>