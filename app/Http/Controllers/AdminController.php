<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display users list + dashboard data.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where('email', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        $totalUsers = User::count();

        // 📊 Registration chart data (grouped by date)
        $userStats = User::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Format dates nicely (optional but better UI)
        $dates = $userStats->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('M d');
        });

        $totals = $userStats->pluck('total');

        return view('admin.index', compact(
            'users',
            'search',
            'totalUsers',
            'dates',
            'totals'
        ));
    }

    /**
     * Create new user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Delete user.
     */
    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if (Auth::id() === $user->id) {
            return redirect()
                ->route('admin.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()
            ->route('admin.index')
            ->with('success', 'User deleted successfully.');
    }
}