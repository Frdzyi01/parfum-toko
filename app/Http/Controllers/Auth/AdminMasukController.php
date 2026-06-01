<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMasukController extends Controller
{
    public function tampilkanFormMasuk()
    {
        if (Auth::check() && Auth::user()->peran === 'admin') {
            return redirect()->route('admin.dasbor');
        }
        return view('auth.admin-login');
    }

    public function masuk(Request $request)
    {
        $kredensial = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $kredensial['email'], 'password' => $kredensial['password'], 'peran' => 'admin'])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dasbor');
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami atau Anda bukan admin.',
        ])->onlyInput('email');
    }

    public function keluar(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('masuk');
    }
}
