<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Profil extends Model
{
    public static function getMyProfil($customer_id)
    {
        $response = Http::get(env('API_SERVER') . 'customer/detail/' . $customer_id, [
            'access_token' => env('API_ACCESS_TOKEN')
        ]);

        return $response->json();
    }

    public static function getAvatar($customer_id)
    {
        $avatarNumber = 1; // default
        $lastChar = substr($customer_id, -1); 
        $charMap = [
            '0' => 10, '1' => 1,  '2' => 2,  '3' => 3,  '4' => 4,
            '5' => 5,  '6' => 6,  '7' => 7,  '8' => 8,  '9' => 9,
            'a' => 11, 'b' => 12, 'c' => 13, 'd' => 14, 'e' => 15,
            'f' => 16, 'g' => 3,  'h' => 17, 'i' => 18, 'j' => 19,
            'k' => 20, 'l' => 21, 'm' => 22, 'n' => 23, 'o' => 24,
            'p' => 25, 'q' => 26, 'r' => 27, 's' => 28, 't' => 29,
            'u' => 30, 'v' => 31, 'w' => 32, 'x' => 33, 'y' => 34,
            'z' => 35,
    
            'A' => 36, 'B' => 37, 'C' => 38, 'D' => 39, 'E' => 40,
            'F' => 41, 'G' => 42, 'H' => 43, 'I' => 44, 'J' => 3,
            'K' => 45, 'L' => 46, 'M' => 47, 'N' => 48, 'O' => 49,
            'P' => 50, 'Q' => 51, 'R' => 52, 'S' => 53, 'T' => 54,
            'U' => 55, 'V' => 56, 'W' => 57, 'X' => 58, 'Y' => 59,
            'Z' => 60,
    
            '-' => 61, '_' => 62, '.' => 63, '@' => 64, '#' => 65
        ];
    
        if (isset($charMap[$lastChar])) {
            $avatarNumber = $charMap[$lastChar];
        }
    
        $avatarUrl = url("assets/images/static/avatar/Group-$avatarNumber.svg");
        return $avatarUrl;
    }
    
}
