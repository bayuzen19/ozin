<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $user = Users::where('username', '=', $request->username)->first();
        // dd($request->password);
        if ($user) {
            $compare = password_verify($request->password, $user->password);
            // dd($compare , $request->password, $user->password);
            if ($compare) {
                Session::push('role', $user->role);
                Session::push('username', $user->username);
                Session::push('fullname', $user->fullname);
                return redirect('/');
            } else {
                return back()->with('error', 'Password salah.')->withInput();
            }
        } else {
            return back()->with('error', 'Username tidak ditemukan.')->withInput();
        }
    }

    // public function authenticate(Request $request): RedirectResponse
    // {
    //     $credentials = $request->validate([
    //         'username' => ['required'],
    //         'password' => ['required']
    //     ]);

    //     // dd($credentials);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         return redirect()->intended('/');
    //     }

    //     return back()->withErrors([
    //         'username' => 'The provided credentials do not match our records.',
    //     ])->onlyInput('username');
    // }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
