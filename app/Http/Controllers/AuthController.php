<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

// class AuthController extends Controller
// {
//     public function token(Request $request)
//     {
//         $request->validate([
//             'email'    => 'required|email',
//             'password' => 'required',
//         ]);

//         return Http::asForm()->post(config('app.url').'/oauth/token', [
//             'grant_type'    => 'password',
//             'client_id'     => env('PASSPORT_CLIENT_ID'),
//             'client_secret' => env('PASSPORT_CLIENT_SECRET'),
//             'username'      => $request->email,
//             'password'      => $request->password,
//             'scope'         => '',
//         ])->json();
//     }
// }
class AuthController extends Controller
{
    public function token(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
            'email'    => 'nullable|email|required_without:username',
            'username' => 'nullable|string|required_without:email',
        ]);

        $login = $request->email ?? $request->username;

        return Http::asForm()->post(config('app.url') . '/oauth/token', [
            'grant_type'    => 'password',
            'client_id'     => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username'      => $login,
            'password'      => $request->password,
            'scope'         => '',
        ])->json();
    }
}