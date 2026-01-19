<?php

// namespace App\Http\Controllers\Web;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;

// class AuthWebController extends Controller
// {
//     public function showRegister()
//     {
//         return view('auth.register');
//     }

//     public function register(Request $request)
//     {
//         $response = Http::post(url('/api/auth/register'), [
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => $request->password,
//             'password_confirmation' => $request->password_confirmation,
//         ]);

//         if ($response->failed()) {
//             return back()->withErrors($response->json());
//         }

//         return redirect('/login')->with('success', 'Register success');
//     }

//     public function showLogin()
//     {
//         return view('auth.login');
//     }

//     public function login(Request $request)
//     {
//         $response = Http::post(url('/api/auth/token'), [
//             'email' => $request->email,
//             'password' => $request->password,
//         ]);

//         if ($response->failed()) {
//             return back()->withErrors(['login' => 'Invalid credentials']);
//         }

//         return view('auth.login', [
//             'token' => $response->json()
//         ]);
//     }
// }
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
class AuthWebController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // 🔐 login ด้วย web guard
        if (!Auth::attempt($request->only('email','password'))) {
            return back()->withErrors('Email หรือ Password ไม่ถูกต้อง');
        }

        // (optional) ขอ token จาก API ด้วย
        $response = Http::post(url('/api/auth/token'), [
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        $token = $response->ok() ? $response->json() : null;

        // redirect เข้า courses
        return redirect('/courses')->with('token', $token);
    }
}