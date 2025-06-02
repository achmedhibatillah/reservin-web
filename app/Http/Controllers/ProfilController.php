<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Profil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = Profil::getMyProfil(session('customer')['customer_id']);
        $avatar = Profil::getAvatar($profil['customer_id']);
        
        return 
        view('templates/header') . 
        view('templates/navbar') . 
        view('profil/index', [
            'profil_page' => 'index',
            'profil' => $profil,
            'avatar' => $avatar,
        ]) . 
        view('templates/footbar') . 
        view('templates/footer');
    }

    public function riwayat($slug = null)
    {
        $profil = Profil::getMyProfil(session('customer')['customer_id']);
        $avatar = Profil::getAvatar($profil['customer_id']);

        $riwayat = Profil::getRiwayatByCustomer(session('customer')['customer_id']);
        $riwayat['total_order'] = count($riwayat['booking']);
        $riwayat['to_past'] = 0;
        $riwayat['to_ongoing'] = 0;
        $riwayat['to_upcoming'] = 0;
        $riwayat['total_pay'] = 0;
        
        if (!empty($riwayat['booking'])) {
            foreach ($riwayat['booking'] as &$x) {
                $riwayat['total_pay'] += $x['booking_price'];
        
                $start = Carbon::parse($x['booking_date'] . ' ' . $x['booking_start']);
                $end = Carbon::parse($x['booking_date'] . ' ' . $x['booking_end']);
                $now = Carbon::now();
        
                if ($now->lessThan($start)) {
                    $x['position'] = 'upcoming';
                    $riwayat['to_upcoming'] += 1;
                } elseif ($now->between($start, $end)) {
                    $x['position'] = 'ongoing';
                    $riwayat['to_past'] += 1;
                } else {
                    $x['position'] = 'past';
                    $riwayat['to_past'] += 1;
                }
            }
        }

        $view = 'profil/riwayat';
        $time_order = '';

        if ($slug !== null) {
            $view = 'profil/riwayat-filtered';
            if ($slug == 'upcoming' || $slug == 'ongoing' || $slug == 'past') {
                $time_order = $slug;
            } else {
                $view = 'profil/riwayat-detail';
                $riwayat = Booking::getBookingByCode($slug);
                if ($riwayat['status'] == 'success') {
                    $riwayat = $riwayat['data'];
                    $start = Carbon::parse($riwayat['booking_date'] . ' ' . $riwayat['booking_start']);
                    $end = Carbon::parse($riwayat['booking_date'] . ' ' . $riwayat['booking_end']);
                    $now = Carbon::now();
            
                    if ($now->lessThan($start)) {
                        $riwayat['position'] = 'upcoming';
                    } elseif ($now->between($start, $end)) {
                        $riwayat['position'] = 'ongoing';
                    } else {
                        $riwayat['position'] = 'past';
                    }
                } else {
                    return redirect()->to('riwayat');
                }
            }
        }

        return 
        view('templates/header') . 
        view('templates/navbar') . 
        view($view, [
            'profil_page' => 'riwayat',
            'profil' => $profil,
            'avatar' => $avatar,
            'riwayat' => $riwayat,
            'time_order' => $time_order,
        ]) . 
        view('templates/footbar') . 
        view('templates/footer');
    }

    public function edit_nama(Request $request)
    {
        $request->validate([
            'customer_fullname' => 'required|max:120'
        ], [
            'customer_fullname.required' => 'Bagian ini harus diisi.',
            'customer_fullname.max' => 'Maksimal 120 karakter.'
        ]);

        $response = Http::asForm()->put(env('API_SERVER') . 'customer/update-fullname', [
            'access_token'  => env('API_ACCESS_TOKEN'),
            'customer_id'   => session('customer')['customer_id'],
            'customer_fullname' => $request->customer_fullname,
        ]);
    
        if (!$response->successful()) {
            return redirect()->back()->with([
                'error' => 'Gagal mengubah password.',
            ]);
        }

        session([
            'customer' => $response->json()['newdata']
        ]);
    
        return redirect()->back()->with('success', 'Anda berhasil mengubah nama.');
    }

    public function edit_pass(Request $request)
    {
        $request->validate([
            'customer_pass_old' => 'required',
            'customer_pass' => 'required|confirmed|min:8|max:20',
            'customer_pass_confirmation' => 'required',
        ], [
            'customer_pass_old.required' => 'Bagian ini harus diisi.',
            'customer_pass.required' => 'Bagian ini harus diisi.',
            'customer_pass.min' => 'Minimal 8 karakter.',
            'customer_pass.max' => 'Maksimal 20 karakter.',
            'customer_pass.confirmed' => 'Konfirmasi password salah.',
            'customer_pass_confirmation.required' => 'Bagian ini harus diisi.',
        ]);
    
        $response = Http::asForm()->post(env('API_SERVER') . 'login/user', [
            'access_token'    => env('API_ACCESS_TOKEN'),
            'customer_email'  => session('customer')['customer_email'],
            'customer_pass'   => $request->customer_pass_old,
        ]);
    
        if (!$response->successful() || ($response['status'] ?? '') === 'error') {
            return redirect()->back()->with([
                'error' => 'Password lama salah.',
                'error-edit-pass' => true,
            ])->withInput();
        }
    
        $response = Http::asForm()->put(env('API_SERVER') . 'customer/update-pass', [
            'access_token'  => env('API_ACCESS_TOKEN'),
            'customer_id'   => session('customer')['customer_id'],
            'customer_pass' => $request->customer_pass,
        ]);
    
        if (!$response->successful()) {
            return redirect()->back()->with([
                'error' => 'Gagal mengubah password.',
            ]);
        }

        session([
            'customer' => $response->json()['newdata']
        ]);
    
        return redirect()->back()->with('success', 'Anda berhasil mengubah password.');
    }
    
    public function hapus_akun(Request $request)
    {
        $request->validate([
            'delete_confirm' => 'required'
        ], [
            'delete_confirm.required' => 'Bagian ini harus diisi.'
        ]);

        if ($request->delete_confirm !== 'hapus') {
            return redirect()->back()->withErrors([
                'delete_confirm' => 'Anda tidak mengetikkan dengan benar.'
            ])->withInput();
        }

        $response = Http::asForm()->delete(env('API_SERVER') . 'customer/delete', [
            'access_token'  => env('API_ACCESS_TOKEN'),
            'customer_id'   => session('customer')['customer_id'],
        ]);

        session()->forget('is_user');
        session()->forget('customer');

        return redirect()->to('')->with('success', 'Anda berhasil menghapus akun Anda.');
    }
}
