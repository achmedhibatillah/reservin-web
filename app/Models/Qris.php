<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Qris extends Model
{
    public static function generateQris($data)
    {
        $response = Http::get(env('API_QRIS'), [
            'do' => 'create-invoice',
            'apikey' => env('API_KEY_QRIS'),
            'mID' => env('API_MID_QRIS'),
            'cliTrxNumber' => $data[0],
            'cliTrxAmount' => $data[1]
        ]);

        return $response->json();
    }
}
