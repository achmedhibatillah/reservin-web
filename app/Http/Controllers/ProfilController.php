<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

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
}
