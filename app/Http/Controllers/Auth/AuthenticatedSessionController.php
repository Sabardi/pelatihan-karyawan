<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Arahkan berdasarkan role
        $url = match ($request->user()->role) {
            'superadmin' => '/superadmin/dashboard',
            'hrd' => '/hrd/dashboard',
           'departemen' => '/department/dashboard', // Pastikan di sini mengecek 'departemen' dan mengarah ke '/department/dashboard'
            default => '/dashboard',
        };

        // return redirect()->intended($url);
        return redirect($url); // Hapus kata ->intended
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
