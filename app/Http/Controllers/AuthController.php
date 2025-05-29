<?php

namespace App\Http\Controllers;

use App\Mail\RegistrasiMail;
use App\Models\Customer;
use App\Models\Registrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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

    public function showRegistrasiInfo($registrasi_info)
    {
        if (!Registrasi::where('registrasi_info', $registrasi_info)->exists()) {
            return
            view('templates/header') . 
            view('auth/registrasi-info-fail') . 
            view('templates/footer');
        }

        $registrasiData = Registrasi::where('registrasi_info', $registrasi_info)->first();

        return 
        view('templates/header') . 
        view('auth/registrasi-info', [
            'registrasi' => $registrasiData,
        ]) . 
        view('templates/footer');
    }

    public function showPasswordRegistrasiForm($registrasi_url)
    {
        if (!Registrasi::where('registrasi_url', $registrasi_url)->exists()) {
            return redirect()->to('registrasi')->with('error', 'Url tidak valid!');
        }
        
        $customerNew = Registrasi::where('registrasi_url', $registrasi_url)->first();

        return 
        view('templates/header') . 
        view('auth/registrasi-password', [
            'customer' => $customerNew,
        ]) . 
        view('templates/footer');
    }

    public function login(Request $request)
    {
        $page = session()->has('page_redirect') ? session('page_redirect') : 'profil';

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

        $customer = Customer::getCustomerByEmailNormal($request->customer_email);
        if ($customer['status'] == 'exists') {
            return redirect()->back()->with('error', 'Email sudah digunakan.')->withInput();
        }

        $customerData = [
            'customer_fullname' => $request->customer_fullname,
            'customer_email' => $request->customer_email,
        ];

        if (Registrasi::where('registrasi_email', $request->customer_email)->exists()) {
            $registrasiData = Registrasi::where('registrasi_email', $request->customer_email)->first();
            Mail::to($registrasiData->registrasi_email)->send(new RegistrasiMail($registrasiData));
            return redirect()->to('registrasi/info-' . $registrasiData->registrasi_info);
        }

        $registrasiData = [
            'registrasi_id' => GenerateController::generateUniqueId('registrasi', 'registrasi_id'),
            'registrasi_info' => GenerateController::generateUniqueId('registrasi', 'registrasi_info', 12),
            'registrasi_url' => GenerateController::generateUniqueId('registrasi', 'registrasi_url', 40),
            'registrasi_fullname' => $request->customer_fullname,
            'registrasi_email' => $request->customer_email,
        ];

        Registrasi::create($registrasiData);
        Mail::to($registrasiData['registrasi_email'])->send(new RegistrasiMail($registrasiData));

        return redirect()->to('registrasi/info-' . $registrasiData['registrasi_info']);
        // return redirect()->to('registrasi/set-password')->with('customerNew', $customerData);
    }

    public function registrasi_password(Request $request)
    {
        $customerData = [
            'customer_fullname' => $request->registrasi_fullname,
            'customer_email' => $request->registrasi_email,
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

        $response = Customer::addCustomer([
            'customer_fullname' => $request->registrasi_fullname,
            'customer_email' => $request->registrasi_email,
            'customer_pass' => $request->customer_pass,
        ]);

        if ($response['status'] == 'error') {
            return redirect()->to('login')->with('error', 'Terjadi kesalahan saat menginput data.');
        }
        
        Registrasi::where('registrasi_email', $request->registrasi_email)->delete();

        return redirect()->to('login')->with('success', 'Anda berhasil membuat akun. Silakan login menggunakan akun yang telah Anda buat.');
    }

    public function dashboard()
    {
        return 'Autentikasi berhasil!';
    }
}
