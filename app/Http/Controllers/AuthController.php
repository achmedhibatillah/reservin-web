<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        $page = session()->has('page_redirect') ? session('page_redirect') : 'profile';

        $request->validate([
            'customer_email' => 'required|email',
            'customer_pass'  => 'required', 
        ], [
            'customer_email.required' => 'Email harus diisi.',
            'customer_email.email' => 'Email tidak valid.',
            'customer_pass.required' => 'Password harus diisi.',
        ]);

        $response = Http::asForm()->post(env('API_SERVER') . 'login/user', [
            'access_token'    => env('API_ACCESS_TOKEN'),
            'customer_email'  => $request->customer_email,
            'customer_pass'   => $request->customer_pass,
        ]);

        if ($response->successful() && $response['status'] === 'success') {
            session([
                'is_user' => true,
                'customer' => $response['customer']
            ]);

            session()->forget('page_redirect');
            return redirect()->to($page);
        }

        return redirect()->back()->with('error', 'Autentikasi gagal.')->withInput();
    }

    public function dashboard()
    {
        return 'Autentikasi berhasil!';
    }
}
