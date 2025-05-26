<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $page = session()->has('page_redirect') ? session('page_redirect') : 'profile';
        
        $googleUser = Socialite::driver('google')->user();

        $user = Customer::login_google($googleUser->getId());

        if ($user['status'] == 'success') {
            session([
                'is_user' => true,
                'customer' => $user['customer']
            ]);

            session()->forget('page_redirect');
            return redirect()->to($page);
        }

        $user = Customer::addCustomer(
            [
                'customer_email' => $googleUser->getEmail(),
                'customer_fullname' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'customer_pass' => bcrypt('password-default')
            ]
        );

        return redirect()->to('login')->with('success', 'Berhasil membuat akun');
    }
}
