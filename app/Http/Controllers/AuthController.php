<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return 
        view('templates/header') . 
        view('auth/login') . 
        view('templates/footer');
    }

    public function showRegistrasiForm()
    {
        return 
        view('templates/header') . 
        view('auth/registrasi') . 
        view('templates/footer');
    }

    public function showPasswordRegistrasiForm()
    {
        if (!session()->has('customerNew')) {
            return redirect()->to('registrasi')->with('warning', 'Masukkan kembali nama lengkap dan email.');
        }
        
        $customerNew = session('customerNew');

        return 
        view('templates/header') . 
        view('auth/registrasi-password', [
            'customer' => $customerNew,
        ]) . 
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

    public function registrasi(Request $request)
    {
        $request->validate([
            'customer_fullname' => 'required|max:255',
            'customer_email' => 'required|email|max:255',
        ], [
            'customer_fullname.required' => 'Nama lengkap harus diisi.',
            'customer_fullname.max' => 'Maksimal 255 karakter.',
            'customer_email.required' => 'Email harus diisi.',
            'customer_email.email' => 'Email tidak valid.',
            'customer_email.max' => 'Maksimal 255 karakter.',
        ]);

        if ($request->has('customer_pass')) {
            $customerData = [
                'customer_fullname' => $request->customer_fullname,
                'customer_email' => $request->customer_email,
            ];
        
            $validator = Validator::make($request->all(), [
                'customer_pass' => 'required|confirmed|min:8|max:20',
            ], [
                'customer_pass.required' => 'Password harus diisi.',
                'customer_pass.confirmed' => 'Konfirmasi password harus sama.',
                'customer_pass.min' => 'Minimal 8 karakter.',
                'customer_pass.max' => 'Maksimal 20 karakter.',
            ]);
        
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('customerNew', $customerData);
            }

            Customer::addCustomer([
                'customer_fullname' => $request->customer_fullname,
                'customer_email' => $request->customer_email,
                'customer_pass' => $request->customer_pass,
            ]);

            return redirect()->to('login')->with('success', 'Anda berhasil membuat akun. Silakan login menggunakan akun yang telah Anda buat.');
        }
        

        $customer = Customer::getCustomerByEmail($request->customer_email);
        if ($customer['status'] == 'exists') {
            return redirect()->back()->with('error', 'Email sudah digunakan.')->withInput();
        }

        $customerData = [
            'customer_fullname' => $request->customer_fullname,
            'customer_email' => $request->customer_email,
        ];

        return redirect()->to('registrasi/set-password')->with('customerNew', $customerData);
    }

    public function dashboard()
    {
        return 'Autentikasi berhasil!';
    }
}
