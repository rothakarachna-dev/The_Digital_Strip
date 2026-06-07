@extends('layouts.app')

@section('content')

@if (View::exists('sidebar'))
    @include('sidebar')
@endif

<div class="main-content">

    <div class="content-wrapper">

        {{-- HEADER --}}
        <div class="page-header">
            <div>
                <span class="breadcrumb">Admin / Dashboard</span>
                <h1>User Directory</h1>
            </div>

            <div class="admin-mini-profile">
                <span>{{ Auth::user()->email }}</span>

                @if(Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Admin">
                @endif
            </div>
        </div>

        {{-- STATS --}}
        <div class="stats-grid">

            <div class="stat-card">
                <h2>Total Registered</h2>
                <p>{{ $totalUsers }}</p>
            </div>

            <div class="stat-card">
                <h2>Current View</h2>
                <p>{{ $search ? 'Filtered' : 'All Users' }}</p>
            </div>

        </div>

        {{-- GRAPH --}}
        <div class="content-card">
            <h3>User Registration Graph</h3>
            <canvas id="userChart"></canvas>
        </div>

        {{-- SEARCH --}}
        <div class="content-card">
            <h3>Search User</h3>

            <form method="GET" action="{{ route('admin.index') }}" class="form-row">

                <input type="text"
                       name="search"
                       placeholder="Search by email or username..."
                       value="{{ request('search') }}">

                <button type="submit" class="btn-main">Search</button>

                @if($search)
                    <a href="{{ route('admin.index') }}">Clear</a>
                @endif

            </form>
        </div>

        {{-- TABLE --}}
        <div class="content-card" style="padding:0;overflow:hidden;">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Registration Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($users as $user)

                    <tr>

                        <td>#{{ $user->id }}</td>

                        <td>
                            <strong>{{ $user->username }}</strong><br>
                            {{ $user->email }}
                        </td>

                        <td>
                            {{ $user->created_at->format('M d, Y') }}
                        </td>

                        {{-- ACTION COLUMN --}}
                        <td class="action-cell">
                            <form class="action-form"
                                action="{{ route('admin.users.destroy', $user->id) }}"
                                method="POST"
                                onsubmit="return confirm('Delete this user account?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-btn">
                                    Remove
                                </button>

                            </form>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="4">No users found.</td>
                    </tr>
                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- CHART --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('userChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($dates),
            datasets: [{
                label: 'User Registrations',
                data: @json($totals),
                borderColor: '#e91e63',
                backgroundColor: 'rgba(233, 30, 99, 0.2)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>

@endsection