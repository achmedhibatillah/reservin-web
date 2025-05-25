<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return 
        view('templates/header') . 
        view('auth/login') . 
        view('templates/footer');
    }

    public function login(Request $request)
    {
        $request->validate([
            'customer_email' => 'required|email',
            'customer_pass'  => 'required'
        ]);

        $response = Http::asForm()->post(env('API_SERVER') . 'login/user', [
            'access_token'    => env('API_ACCESS_TOKEN'),
            'customer_email'  => $request->customer_email,
            'customer_pass'   => $request->customer_pass,
        ]);

        if ($response->successful() && $response['status'] === 'success') {
            session()->set([
                'status' => 'user',
                'customer' => $response['customer']
            ]);

            // return redirect()->
        }

        return redirect()->back()->with('error', 'Autentikasi gagal.');
    }

    public function dashboard()
    {
        return 'Autentikasi berhasil!';
    }
}
